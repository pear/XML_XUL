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
 * XML/XUL/Element.php
 *
 * Base class for all elements
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * unknown element
 */ 
define('XML_XUL_ERROR_ELEMENT_NOT_FOUND', 150);
 
/**
 * unknown attribute
 */ 
define('XML_XUL_ERROR_ATTRIBUTE_UNKNOWN', 200);
 
/**
 * attribute is no integer
 */ 
define('XML_XUL_ERROR_ATTRIBUTE_NO_INTEGER', 201);
 
/**
 * attribute is no integer
 */ 
define('XML_XUL_ERROR_ATTRIBUTE_NO_BOOLEAN', 202);
 
/**
 * attribute contains invalid value
 */ 
define('XML_XUL_ERROR_ATTRIBUTE_INVALID_VALUE', 203);
 
/**
 * XML/XUL/Element.php
 *
 * Base class for all elements
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */
class XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName;

   /**
    * namespace for XUL elements
    *
    * @access private
    * @var  string
    */
    var $_ns;

   /**
    * attributes of the element
    *
    * @access   public
    * @var      array
    */
    var $attributes   =   array();

   /**
    * childNodes of the element
    *
    * @access   public
    * @var      array
    */
    var $childNodes   =   array();

   /**
    * cdata of the element
    *
    * @access   public
    * @var      string
    */
    var $cdata;

   /**
    * stores a reference to the document that created the
    * element
    *
    * @access   private
    * @var      object XML_XUL_Document
    */
    var $_doc;

   /**
    * indicates whether the element is the root element
    *
    * @access   public
    * @var      boolean
    */
    var $isRoot = false;

   /**
    * common attributes
    *
    * These attributes are supported by all elements
    *
    * @access   private
    * @var      array
    */
    var $_commonAttribs = array(
                                'align' => array(
                                                   'required' => false,
                                                   'type'     => 'enum',
                                                   'values'   => array( 'baseline', 'center', 'end', 'start', 'stretch' )
                                                ),
                                'allowevents' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'class' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'collapsed' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'container' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'containment' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'context' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'datasources' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'debug' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'dir' => array(
                                                   'required' => false,
                                                   'type'     => 'enum',
                                                   'values'   => array( 'normal', 'reverse' )
                                                ),
                                'empty' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'equalsize' => array(
                                                   'required' => false,
                                                   'type'     => 'enum',
                                                   'values'   => array( 'alwyys', 'never' )
                                                ),
                                'flex' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'flexgroup' => array(
                                                   'required' => false,
                                                   'type'     => 'int',
                                                ),
                                'height' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'hidden' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'id' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'insertafter' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'insertbefore' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'left' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'maxheight' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'maxwidth' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'minheight' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'minwidth' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'observes' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'ordinal' => array(
                                                   'required' => false,
                                                   'type'     => 'int',
                                                ),
                                'orient' => array(
                                                   'required' => false,
                                                   'type'     => 'enum',
                                                   'values'   => array( 'vertical', 'horizontal' )
                                                ),
                                'pack' => array(
                                                   'required' => false,
                                                   'type'     => 'enum',
                                                   'values'   => array( 'center', 'start', 'end' )
                                                ),
                                'persist' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'position' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'ref' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'style' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'template' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'tooltip' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                )
                                );
    
   /**
    * flag to indicate whether xml entities should be replaced
    *
    * @access   public
    * @var      boolean
    */
    var $replaceEntities = true;
    
   /**
    * constructor
    *
    * @access   public
    * @param    array   attributes of the element
    * @param    string  cdata of the element (used by caption, et al)
    * @param    boolean autobuild flag
    */
    function XML_XUL_Element( $attributes = array(), $cdata = null, $autoBuild = true )
    {
        $this->attributes = $attributes;
        $this->cdata      = $cdata;
    }

   /**
    * set the reference to the document
    *
    * @access   public
    * @param    object XML_XUL_Document     document
    */
    function setDocument( &$doc )
    {
        $this->_doc      = &$doc;
    }

   /**
    * set the namespace
    *
    * @access   public
    * @param    string
    */
    function setNamespace( $ns )
    {
        $this->_ns = $ns;
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
    * get the element's id
    *
    * @access   public
    * @return   string  id of the element
    */
    function getId()
    {
        if (isset($this->attributes['id'])) {
            return $this->attributes['id'];
        }
        return false;
    }

   /**
    * get the element's tag name
    *
    * @access   public
    * @return   string  tag name of the element
    */
    function getElementname()
    {
        return $this->elementName;
    }

   /**
    * sets cdata of the element
    *
    * @access public
    * @param    string  data
    */
    function setCData( $data )
    {
        $this->cdata = $data;
    }

   /**
    * sets several attributes at once
    *
    * @access public
    * @param    array  attributes
    */
    function setAttributes( $attribs )
    {
        $this->attributes = array_merge($this->attributes, $attribs);
    }

   /**
    * set an attribute
    *
    * @access public
    * @param    string  attribute name
    * @param    mixed   attribute value
    */
    function setAttribute( $name, $value )
    {
        $this->attributes[$name] = $value;
    }
    
   /**
    * get an attribute
    *
    * @access public
    * @param    string  attribute name
    * @return   mixed   attribute value
    */
    function getAttribute( $name )
    {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }
        return false;
    }
    
   /**
    * add a child object
    *
    * @access   public
    * @param    object
    */
    function appendChild( &$obj )
    {
        $this->childNodes[] = &$obj;
    }

   /**
    * create a string representation of the element
    *
    * This is just an alias for serialize()
    *
    * @access public
    * @return string string representation of the element and all of its childNodes
    */
    function toXML()
    {
        return $this->serialize();
    }
    
   /**
    * serialize the element
    *
    * @access public
    * @return string string representation of the element and all of its childNodes
    */
    function serialize()
    {
        if (empty($this->_ns)) {
            $el = $this->elementName;
        } else {
            $el = sprintf( '%s:%s', $this->_ns, $this->elementName);
        }

        if (empty($this->childNodes) ) {
            if ($this->cdata !== null) {
                $content = $this->cdata;
                if ($this->replaceEntities) {
                    $content = XML_Util::replaceEntities($content);
                }
            }
        } else {
            $content = '';
            $cnt = count($this->childNodes);
            for ($i=0; $i<$cnt; $i++) {
                $content .= $this->childNodes[$i]->serialize();
            }
        }
        
        if ($this->isRoot) {
            $nsUri = 'http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul';
            if ($this->_htmlNs != null) {
                $this->attributes['xmlns:'.$this->_htmlNs] = 'http://www.w3.org/1999/xhtml';
            }
        } else {
            $nsUri = null;
        }
        
        return XML_Util::createTag(
                                    $el,
                                    $this->attributes,
                                    $content,
                                    $nsUri,
                                    false
                                );
    }

   /**
    * clone the element
    *
    * This method will return a copy of the element
    * without the id and the childNodes
    *
    * @access   public
    * @param    boolean     whether children should be cloned, too.
    * @return   object XML_XUL_Element
    */
    function &cloneElement( $recursive = false )
    {
        $atts = $this->attributes;
        unset($atts['id']);
        
        $copy = &$this->_doc->createElement($this->elementName, $atts, $this->cdata);
        if ($recursive !== true) {
            return $copy;
        }
        /**
         * copy child nodes
         */
        $cnt = count($this->childNodes);
        for ($i = 0; $i < $cnt; $i++) {
            $copy->appendChild( $this->childNodes[$i]->cloneElement( $recursive ) );
        }
        return $copy;
    }

   /**
    * get an element by its id
    *
    * You should not need to call this method directly
    *
    * @access   public
    * @param    string  id
    * @return   object XML_XUL_Element or false if the element does not exist
    */
    function &getElementById($id)
    {
        if ($this->getId() == $id) {
            return $this;
        }
        
        $cnt = count($this->childNodes);
        
        if ($cnt==0) {
            return false;
        }

        for ($i=0; $i<$cnt; $i++) {
            $result = &$this->childNodes[$i]->getElementById($id);
            if ($result === false) {
                continue;
            }
            return $result;
        }
        return false;
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
        $nodeList = array();
        if ($this->elementName == $tagname) {
            $nodeList[] = &$this;
        }

        $cnt = count($this->childNodes);

        if ($cnt==0) {
            return $nodeList;
        }

        for ($i=0; $i<$cnt; $i++) {
            $tmp = &$this->childNodes[$i]->getElementsByTagname($tagname);
            $cnt2 = count($tmp);
            for($j=0; $j<$cnt2; $j++) {
                $nodeList[] = &$tmp[$j];
            }
        }
        return $nodeList;
    }

   /**
    * validate the element's attributes
    *
    * Uses the definitions of common attributes as well as the
    * attribute definitions of the element.
    *
    * @access   public
    * @return   boolean     true on succes, PEAR_Error otherwise
    */
    function validateAttributes()
    {
        foreach ($this->attributes as $name => $value) {

            if (isset($this->_commonAttribs[$name])) {
                $def    =   $this->_commonAttribs[$name];
            } elseif (isset($this->_attribDefs[$name])) {
                $def    =   $this->_attribDefs[$name];
            } else {
                return PEAR::raiseError('Unknown attribute '.$name.'.', XML_XUL_ERROR_ATTRIBUTE_UNKNOWN);
            }

            switch ($def['type']) {
                /**
                 * must be a string
                 */
                case 'string':
                    continue;
                    break;
                /**
                 * must be an integer
                 */
                case 'int':
                case 'integer':
                    if (!preg_match('°^[0-9]+$°', $value)) {
                        return PEAR::raiseError('Attribute \''.$name.'\' must be integer.', XML_XUL_ERROR_ATTRIBUTE_NO_INTEGER);
                    }
                    break;
                /**
                 * enumerated value
                 */
                case 'enum':
                    if (!in_array($value, $def['values'])) {
                        return PEAR::raiseError('Attribute \''.$name.'\' must be one of '.implode(', ', $def['values']).'.', XML_XUL_ERROR_ATTRIBUTE_INVALID_VALUE);
                    }
                    break;
                /**
                 * boolean value
                 */
                case 'boolean':
                    if ($value != 'true' && $value != 'false') {
                        return PEAR::raiseError('Attribute \''.$name.'\' must be one either \'true\' or \'false\'.', XML_XUL_ERROR_ATTRIBUTE_NO_BOOLEAN);
                    }
                    break;
            }
        }
        return true;
    }

   /**
    * get the first child of the element
    *
    * If the element has no childNodes, null will be returned.
    *
    * @access   public
    * @return   object XML_XUL_Element
    */
    function &firstChild()
    {
        if (isset($this->childNodes[0])) {
            return $this->childNodes[0];
        }
        $child = null;
        return $child;
    }

   /**
    * get last first child of the element
    *
    * If the element has no childNodes, null will be returned.
    *
    * @access   public
    * @return   object XML_XUL_Element
    */
    function &lastChild()
    {
        $cnt = count($this->childNodes);
        if ($cnt > 0) {
            return $this->childNodes[($cnt-1)];
        }
        $child = null;
        return $child;
    }

   /**
    * add a description element
    *
    * This can be used by a lot of elements,
    * thus it has been placed in the base class.
    *
    * @access   public
    * @param    string  text for the description
    * @param    array   additional attributes
    * @return   object XML_XUL_Element_Description
    * @see      XML_XUL_Element_Description
    */
    function &addDescription($text, $atts = array())
    {
        $desc = &$this->_doc->createElement('Description', $atts, $text);
        $this->appendChild($desc);
        return $desc;
    }

   /**
    * get a debug info about the element as
    * string.
    *
    * Use this instead of a print_r on the tree.
    *
    * @access   public
    * @param    integer     nesting depth, no need to pass this
    * @return   string
    */
    function getDebug( $indent = '', $last = false )
    {
        $name = $this->getElementName();
        $id   = $this->getId();
        if ($id !== false) {
            $name .= " [id=$id]";
        }
        
        if ($last) {
            $debug   = sprintf("%s   +-%s\n", $indent, $name);
            $indent .= '      ';
        } else {
            $debug   = sprintf("%s   +-%s\n", $indent, $name);
            $indent .= '   |  ';
       }
        
        if (!empty($this->attributes)) {
            $debug .= sprintf("%s+-attributes:\n", $indent);
            foreach ($this->attributes as $key => $value) {
                $debug .= sprintf("%s|   %s => %s\n", $indent, $key, $value);
            }
        }

        if (!empty($this->cdata)) {
            $debug .= sprintf("%s+-cdata: %s\n", $indent, $this->cdata);
        } else {
            $debug .= sprintf("%s+-cdata: null\n", $indent);
        }
        
        if (!empty($this->childNodes)) {
            $debug .= sprintf("%s+-childNodes:\n", $indent);
            for ($i = 0; $i<count($this->childNodes); $i++) {
                if ($i == (count($this->childNodes)-1)) {
                    $debug .= $this->childNodes[$i]->getDebug($indent, true);
                } else {
                    $debug .= $this->childNodes[$i]->getDebug($indent);
                }
            }
        }
        if (!$last) {
            $debug .= sprintf("%s\n", $indent);
        }
        return $debug;
    }
}
?>