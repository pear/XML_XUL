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
 * XML/XUL/Element/Popupset.php
 *
 * Popupset element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Popupset.php
 *
 * Popupset element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_popupset.html
 * @see      XML_XUL_Element_Popup
 */
class XML_XUL_Element_Popupset extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'popupset';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                            );

   /**
    * add a new popup
    *
    * @access   public
    * @param    string  id of the popup, used in popup and context attributes of other elements
    * @param    mixed   content of the popup, can be a XML_XUL_Element or a string
    * @param    array   optional attributes for the popup
    * @return   object XML_XUL_Element_Popup
    */
    function addPopup( $id, $content, $atts = array() )
    {
        $atts['id'] = $id;
        $popup = $this->_doc->createElement( 'Popup', $atts );
        if (!is_object($content)) {
            $content = $this->_doc->createElement('Description', array(), $content);
        }
        $popup->appendChild($content);
        $this->appendChild($popup);
        return $popup;
    }
}
?>
