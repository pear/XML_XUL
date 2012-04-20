<?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 5                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Stephan Schmidt <schst@php.net>                             |
// +----------------------------------------------------------------------+

/**
 * XML/XUL/Parser.php
 *
 * Parser that is able to parse XUL documents
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * use XML_Parser to parse the document
 */
require_once 'XML/Parser.php';
 
/**
 * XML/XUL/Parser.php
 *
 * Parser that is able to parse XUL documents.
 *
 * Currently the parser does not support namespaces, as XML_Parser
 * has no namespace support. This will hopefully change in future
 * releases.
 *
 * This parser is in an early stage, as it currently has not support
 * for stylesheets or xml:space.
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @todo     implement namespaces
 * @todo     add support for xml:space attribute
 * @todo     add error management
 * @todo     add support for namespaces using a defaultHandler
 */
class XML_XUL_Parser extends XML_Parser
{
   /**
    * tag stack
    *
    * @access private
    * @var    array
    */
    var $_tagStack = array();

   /**
    * cdata
    *
    * @access private
    * @var    array
    */
    var $_cdata = array();

   /**
    * depth
    *
    * @access private
    * @var    integer
    */
    var $_depth = 0;

   /**
    * document object
    *
    * @access private
    * @var    object XML_XUL_Document
    */
    var $_doc;

   /**
    * constructor
    *
    * @access public
    */
    function __construct()
    {
        $this->folding = false;
    }

   /**
    * parse a file
    *
    * @access public
    * @param  string  filename of the file to parse
    * @return object XML_XUL_Document
    */
    function loadFile( $filename )
    {
        require_once 'XML/XUL/Document.php';

        $this->_doc = new XML_XUL_Document( $filename );

        $this->XML_Parser();
        $this->setInputFile($filename);
        $result = $this->parse();
        if ($this->isError($result)) {
            return $result;
        }
        return $this->_doc;
    }
    
   /**
    * parse a string
    *
    * @access public
    * @param  string    string to parse
    * @return object XML_XUL_Document
    */
    function loadString( $string )
    {
        require_once 'XML/XUL/Document.php';

        $this->_doc = new XML_XUL_Document();

        $this->XML_Parser();
        $result = $this->parseString($string);
        if ($this->isError($result)) {
            return $result;
        }
        return $this->_doc;
    }

   /**
    * start element handler
    *
    * @access   public
    * @param  object $parser  XML parser object
    * @param  string $element XML element
    * @param  array  $attribs attributes of XML tag
    * @return void
    */
    function startHandler( $parser, $name, $atts )
    {
        array_push($this->_tagStack, array(
                                            'name'       => $name,
                                            'atts'       => $atts,
                                            'childNodes' => array()
                                        )
                );
        $this->_depth++;

        $this->_cData[$this->_depth] = '';
    }

   /**
    * end element handler
    *
    * @access   public
    * @param  object $parser  XML parser object
    * @param  string $element XML element
    * @return void
    */
    function endHandler( $parser, $name )
    {
        $cdata = $this->_cData[$this->_depth];
        $this->_depth--;
        $def = array_pop($this->_tagStack);

        $el  = &$this->_doc->createElement($def['name'], $def['atts'], $cdata);
        
        for ($i = 0; $i < count($def['childNodes']); $i++) {
            $el->appendChild($def['childNodes'][$i]);
        }
        
        $parent = array_pop($this->_tagStack);
        if (is_array($parent)) {
            array_push($parent['childNodes'], $el);
            array_push($this->_tagStack, $parent);
        } else {
            $this->_doc->addRoot($el);
        }
        return true;
    }

    /**
     * Handler for character data
     *
     * @access protected
     * @param  object XML parser object
     * @param  string CDATA
     * @return void
     */
    function cdataHandler($parser, $cdata)
    {
        $cdata = trim($cdata);
        if (empty($cdata)) {
            return true;
        }
        $this->_cData[$this->_depth] .= $cdata;
    }
}
