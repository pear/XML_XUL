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
 * XML/XUL/Element/Tree.php
 *
 * Tree element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Tree.php
 *
 * Tree element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_tree.html
 * @example  example_tree.php
 */
class XML_XUL_Element_Tree extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'tree';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'multiple' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'datasources' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'enableColumnDrag' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'containment' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'sortResource' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'sortDirection' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'border' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'seltype' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'sortActive' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'flags' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'context' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'persist' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'hidecolumnpicker' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                )
                            );

   /**
    * columns
    *
    * @access   private
    * @var      integer
    */
    var $_columns;

   /**
    * set the amount of columns
    *
    * @access    public
    * @param    integer    number of columns
    */
    function setColumns( $columns )
    {
        $this->_columns = $columns;
        $this->childNodes[0] = &$this->_doc->createElement('Treecols');
        
        $atts = func_get_args();
        array_shift($atts);
        
        for ($i=0; $i<$columns; $i++) {
            if (!isset($atts[$i])) {
                $atts[$i] = array();
            }
            $this->childNodes[0]->appendChild( $this->_doc->createElement('Treecol', $atts[$i]));
        }
    }

   /**
    * add an item
    *
    * @access    public
    * @param    array   elements for the cells
    * @return   object XML_XUL_Element_Treeitem
    */
    function &addItem( $cells )
    {
        /**
         * tree has no childNodes
         */
        if (!isset($this->childNodes[1])) {
            $this->childNodes[1] = &$this->_doc->createElement('Treechildren');
        }

        $item = &$this->_doc->createElement('Treeitem');
        $row  = &$this->_doc->createElement('Treerow');
        
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