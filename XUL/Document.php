<?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
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
 * XML/XUL/Document.php
 *
 * Document object
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * uses XML_Util to create document
 */
 require_once 'XML/Util.php';
 
/**
 * no filename given
 */
 define( 'XML_XUL_DOCUMENT_ERROR_NO_FILENAME', 100 );
 
/**
 * file not writeable
 */
 define( 'XML_XUL_DOCUMENT_ERROR_NOT_WRITEABLE', 101 );

/**
 * XML/XUL/Document.php
 *
 * Document object
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */
class XML_XUL_Document
{
   /**
    * filename
    *
    * @access private
    * @var  string
    */
    var $_filename;

   /**
    * namespace for XUL elements
    *
    * @access private
    * @var  string
    */
    var $_ns;

   /**
    * encoding for the document
    *
    * @access private
    * @var  string
    */
    var $_encoding;

   /**
    * namespace for XHTML elements
    *
    * @access private
    * @var  string
    */
    var $_htmlNs;

   /**
    * stylesheets that should be included
    *
    * @access   private
    * @var      array
    */
    var $_stylesheets   =   array();

   /**
    * filename of the DTD
    *
    * @access private
    * @var  string
    */
    var $_dtd;

   /**
    * root element
    *
    * Should be a window or dialog element
    *
    * @access   private
    * @var      object XML_XUL_Element
    */
    var $root;
    
   /**
    * flag to indicate whether element attributes should validate
    *
    * @access   private
    * @var      boolean
    */
    var $_autoValidate  =   false;

   /**
    * constructor
    *
    * @access   public
    * @param    string  filename
    * @param    string  namespace for XUL elements
    * @param    string  encoding of the document
    */
    function XML_XUL_Document( $filename = null, $ns = null, $encoding = null )
    {
        $this->_filename = $filename;
        $this->_ns       = $ns;
        $this->_encoding = $encoding;
    }

   /**
    * set the namespace for XHTML element
    *
    * @access   public
    * @param    string
    */
    function setHtmlNamespace( $ns )
    {
        $this->_htmlNs = $ns;
    }

   /**
    * add a stylesheet
    *
    * @access   public
    * @param    string  uri of the stylesheet
    */
    function addStylesheet( $uri )
    {
        array_push($this->_stylesheets, $uri);
    }
    
   /**
    * set the URI of the DTD
    *
    * @access   public
    * @param    string  uri of the dtd
    */
    function setDTD( $uri )
    {
        $this->_dtd = $uri;
    }
    
   /**
    * enable validation
    *
    * @access   public
    * @param    boolean
    */
    function enableValidation( $enable = true )
    {
        $this->_autoValidate = $enable;
    }
    
   /**
    * add the root element
    *
    * @access   public
    * @param    object  root element
    */
    function addRoot( &$el )
    {
        $el->isRoot  = true;
        $el->setNamespace( $this->_ns );
        if ($this->_htmlNs != null) {
            $el->setHtmlNamespace($this->_htmlNs);
        }
        
        $this->root = &$el;
    }
    
   /**
    * send the document to the output stream
    *
    * Use this method to display the document in Mozilla.
    *
    * @access   public
    */
    function send()
    {
        header( 'Content-type: application/vnd.mozilla.xul+xml' );
        echo $this->serialize();
    }

   /**
    * write the document to a file
    *
    * You may specify a filename to override the filename passed in
    * the constructor.
    *
    * @access   public
    * @param    string  filename
    */
    function save( $filename = null )
    {
        if ($filename == null) {
            $filename = $this->_filename;
        }

        if (empty($filename)) {
            return PEAR::raiseError(
                                     'No filename specified to write document to.',
                                     XML_XUL_ERROR_NO_FILENAME
                                    );
        }

        $fp =   @fopen( $filename, 'wb' );
        if( !$fp )
        {
            return PEAR::raiseError(
                                     'Could not write destination file.',
                                     XML_XUL_ERROR_NOT_WRITEABLE
                                    );
        }
        flock( $fp, LOCK_EX );
        fputs( $fp, $this->serialize() );
        flock( $fp, LOCK_UN );
        fclose( $fp );

        return true;
    }

   /**
    * serialize the document
    *
    * @access public
    * @return string
    */
    function serialize()
    {
        $doc = XML_Util::getXMLDeclaration('1.0', $this->_encoding) . "\n";

        /**
         * add the DTD
         */
        if ($this->_dtd != null) {
            if (is_object($this->root)) {
                $root = $this->root->getTagname();
            } else {
                $root = '';
            }
            $doc .= XML_Util::getDocTypeDeclaration( $root, $this->_dtd ) . "\n";
        }
        
        /**
         * add styles
         */
        $cnt = count($this->_stylesheets);
        for ($i=0; $i<$cnt; $i++) {
            $doc .= sprintf('<?xml-stylesheet href="%s" type="text/css"?>', $this->_stylesheets[$i]) . "\n";
        }
        
        $doc .= $this->root->serialize();
        
        return $doc;
    }

   /**
    * create any XUL element
    *
    * @access   public
    * @param    string  element name
    * @param    array   attributes
    * @param    string  character data, mainly used for description element
    * @return   object XML_XUL_Element
    */
    function &createElement( $name, $attributes = array(), $cdata = null, $replaceEntities = true)
    {
        $classname = sprintf( 'XML_XUL_Element_%s', $name );
        $file      = sprintf( 'XML/XUL/Element/%s.php', ucfirst($name) );
        if (!@include_once $file) {
            $el = &new XML_XUL_Element( $attributes, $cdata );
            $el->elementName = strtolower( $name );
        } else {
            $el = &new $classname( $attributes, $cdata );
        }

        $el->setNamespace($this->_ns);
        $el->setDocument($this);
        $el->replaceEntities = $replaceEntities;

        if ($this->_autoValidate) {
            $result = $el->validateAttributes();
            if (PEAR::isError($result)) {
                return $result;
            }
        }
        
        return $el;
    }

   /**
    * create any HTML ELement
    *
    * @access   public
    * @param    string  element name
    * @param    array   attributes
    * @param    string  character data, mainly used for description element
    * @return   object XML_XUL_Element_Html
    */
    function &createHtmlElement( $name, $attributes = array(), $cdata = null )
    {
        require_once 'XML/XUL/Element/Html.php';

        $el    =   &new XML_XUL_Element_Html( $attributes, $cdata );
        $el->setElementName($name);
        $el->setNamespace($this->_htmlNs);
        $el->setDocument($this);
        
        return $el;
    }

   /**
    * create HTML block by supplying raw HTML code
    *
    * @access   public
    * @param    string  html
    * @return   object XML_XUL_Element_Html
    */
    function &createHtmlRaw( $html )
    {
        require_once 'XML/XUL/Element/Html.php';

        $el    =   &new XML_XUL_Element_Html();
        $el->setDocument($this);
        $el->setRawHtml($html);
        
        return $el;
    }

   /**
    * get an element by its id
    *
    * @access   public
    * @param    string  id
    * @return   object XML_XUL_Element
    */
    function &getElementById( $id )
    {
        return $this->root->getElementById( $id );
    }

   /**
    * get a nodelist of elements by their tagname
    *
    * @access   public
    * @param    string  id
    * @return   array   array containing XML_XUL_Element objects
    */
    function &getElementsByTagname($tagname)
    {
        return $this->root->getElementsByTagname( $tagname );
    }

   /**
    * get debug info about the document as
    * string.
    *
    * Use this instead of a print_r on the tree.
    *
    * @access   public
    * @return   string
    */
    function getDebug()
    {
        $debug  = "XML_XUL_Document\n";
        $debug .= " +-namespace      : {$this->_ns}\n";
        $debug .= " +-html namespace : {$this->_htmlNs}\n";
        if (!empty($this->_stylesheets)) {
            $debug .= " +-stylesheets    : {$this->_stylesheets[0]}\n";
            for ($i=1; $i<count($this->_stylesheets);$i++) {
                $debug .= " |                  {$this->_stylesheets[$i]}\n";
            }
        }
        $debug .= " +childNodes\n";
        $debug .= $this->root->getDebug(' ', true);
        return $debug;
    }

   /**
    * show debug info about the document.
    *
    * Use this instead of a print_r on the tree.
    *
    * @access   public
    * @uses     getDebugInfo()
    */
    function showDebug()
    {
        echo $this->getDebug();
    }
}
?>