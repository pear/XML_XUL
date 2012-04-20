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
 * XML/XUL/Element/Menu.php
 *
 * Menu element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Menu.php
 *
 * Menu element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_menu.html
 * @example  example_menu.php
 */
class XML_XUL_Element_Menu extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'menu';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'label' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'accesskey' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'disabled' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'image' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                            );

   /**
    * prepare the menupopup
    *
    * @access   public
    * @param    array   attributes of the popup
    * @return   object  XML_XUL_Element_Menupopup
    */
    function preparePopup( $pop = array() )
    {
        if (isset($this->childNodes[0])) {
            return $this->childNodes[0];
        }
        $pop = $this->_doc->createElement('Menupopup', $pop);
        $this->appendChild($pop);
        return $pop;
    }

   /**
    * add a new menu item
    *
    * @access   public
    * @param    array   attributes of the item
    * @return   object  XML_XUL_Element_Menuitem
    */
    function addItem( $item = array() )
    {
        if (!is_object($this->childNodes[0])) {
            $this->preparePopup();
        }
        
        if (!is_object($item)) {
            $item = $this->_doc->createElement( 'Menuitem', $item );
        }
        $this->childNodes[0]->appendChild( $item );
        return $item;
    }

   /**
    * add a sub menu
    *
    * @access   public
    * @param    array   attributes of the menu
    * @return   object  XML_XUL_Element_Menu
    */
    function addSubmenu( $menu = array() )
    {
        if (!is_object($this->childNodes[0])) {
            $this->preparePopup();
        }
        
        if (!is_object($menu)) {
            $menu = $this->_doc->createElement( 'Menu', $menu );
        }
        $this->childNodes[0]->appendChild( $menu );
        return $menu;
    }

   /**
    * add a menu separator
    *
    * @access   public
    * @param    array   attributes of the item
    * @return   object  XML_XUL_Element_Menuseparator
    */
    function addSeparator( $sep = array() )
    {
        if (!is_object($this->childNodes[0])) {
            $this->preparePopup();
        }
        
        if (!is_object($sep)) {
            $sep = $this->_doc->createElement( 'Menuseparator', $sep );
        }
        $this->childNodes[0]->appendChild( $sep );
        return $sep;
    }
}
?>
