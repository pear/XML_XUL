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
 * XML/XUL/Element/Tabbox.php
 *
 * Tabbox element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Tabbox.php
 *
 * Tabbox element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_tabbox.html
 * @example  example_tabs.php
 */
class XML_XUL_Element_Tabbox extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'tabbox';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                            );

   /**
    * attributes of the element
    *
    * @access   private
    * @var      array
    */
    var $_tabs   =   array();

   /**
    * add a tab
    *
    * @access    public
    * @param    string  label for the tab
    * @param    mixed   optional content for the tab, must be a XML_XUL_Element or null
    * @param    array   optional attributes for the tab
    * @param    array   optional attributes for the tabpanel
    * @return   object XML_XUL_Element_Tabpanel     the tabpanel that has been created
    */
    function &addTab( $label, $content = null, $tabAttributes = array(), $panelAttributes = array() )
    {
        $tabAttributes['label']    =    $label;
        $tab   = &$this->_doc->createElement( 'Tab', $tabAttributes );
        $panel = &$this->_doc->createElement( 'Tabpanel', $tabAttributes );

        if (is_object($content)) {
            $panel->appendChild($content);
        }
        
        if (!isset($this->childNodes[0])) {
            $tabs = &$this->_doc->createElement( 'Tabs' );
            $this->appendChild( $tabs );
            $panels = &$this->_doc->createElement( 'Tabpanels' );
            $this->appendChild( $panels );
        }

        $this->childNodes[0]->appendChild($tab);
        $this->childNodes[1]->appendChild($panel);
    
        return $panel;
    }
}
?>