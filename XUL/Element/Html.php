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
 * XML/XUL/Element/Html.php
 *
 * Html element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Html.php
 *
 * Class that is used to include HTML content in the
 * XUL document.
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_Html.html
 * @example  example_html.php
 */
class XML_XUL_Element_Html extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = '';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                            );

   /**
    * raw html code
    *
    * @access   private
    * @var      array
    */
    var $_rawHtml = null;

   /**
    * set the element name
    *
    * @access   public
    * @param    string  element name
    */
    function setElementName($name)
    {
        $this->elementName = $name;
    }

   /**
    * set raw HTML
    *
    * @access   public
    * @param    string  html
    */
    function setRawHtml($html)
    {
        $this->_rawHtml = $html;
    }

   /**
    * serialize the element
    *
    * @access public
    * @return string string representation of the element and all of its childNodes
    */
    function serialize()
    {
        if ($this->_rawHtml!=null) {
            return $this->_rawHtml;
        }
        return XML_XUL_Element::serialize();
    }
}
?>