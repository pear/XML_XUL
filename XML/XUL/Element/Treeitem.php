<?PHP
/* vim: set expandtab tabstop=4 shiftwidth=4: */
// +----------------------------------------------------------------------+
// | PHP Version 5                                                       |
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
 * XML/XUL/Element/Treeitem.php
 *
 * Treeitem element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Treeitem.php
 *
 * Treeitem element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_treeitem.html
 */
class XML_XUL_Element_Treeitem extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'treeitem';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'rdf:type' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'container' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'open' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                )
                            );

   /**
    * add an item
    *
    * @access    public
    * @param    array   elements for the cells
    * @return   object XML_XUL_Element_Treeitem
    */
    function addItem( $cells )
    {
        /**
         * treeitem has no childNodes
         */
        if (!isset($this->childNodes[1])) {
            $this->childNodes[1] = $this->_doc->createElement('Treechildren');
            $this->setAttribute( 'container', 'true' );
        }

        $item = $this->_doc->createElement('Treeitem');
        $row  = $this->_doc->createElement('Treerow');
        
        $item->appendChild($row);
        
        $cnt  = count($cells);
        for ($i=0; $i<$cnt; $i++) {
            if (!is_object($cells[$i])) {
                if (!is_array($cells[$i])) {
                    $cells[$i] = array( 'label' => $cells[$i] );
                }
                $cells[$i] = $this->_doc->createElement( 'Treecell', $cells[$i] );
            }
            $row->appendChild( $cells[$i] );
        }
        $this->childNodes[1]->appendChild($item);
        return $item;
    }


}
?>
