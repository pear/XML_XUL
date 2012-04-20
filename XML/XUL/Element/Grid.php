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
 * XML/XUL/Element/Grid.php
 *
 * Grid element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Grid.php
 *
 * Grid element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_grid.html
 * @example  example_grid.php
 */
class XML_XUL_Element_Grid extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'grid';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
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
        $this->childNodes[0] = $this->_doc->createElement('Columns');
        
        $atts = func_get_args();
        array_shift($atts);
        
        for ($i=0; $i<$columns; $i++) {
            if (!isset($atts[$i])) {
                $atts[$i] = array();
            }
            $this->childNodes[0]->appendChild( $this->_doc->createElement('Column', $atts[$i]));
        }
    }

   /**
    * add a row of data
    *
    * @access    public
    * @param    array   array containing the cells
    * @param    array   attributes for the row tag
    */
    function addRow( $row, $atts = array() )
    {
        if (!isset($this->childNodes[1])) {
            $this->childNodes[1] = $this->_doc->createElement('Rows');
        }
        $rowObj = $this->_doc->createElement('Row', $atts);
        for ($i=0; $i<$this->_columns; $i++) {
            if (!is_object($row[$i])) {
                $row[$i] = $this->_doc->createElement('Description', array(), $row[$i]);
            }
            $rowObj->appendChild($row[$i]);
        }
        $this->childNodes[1]->appendChild($rowObj);
    }

   /**
    * add several rows of data
    *
    * @access    public
    * @param    array   array containing the rows
    * @param    array   attributes for the row tag
    */
    function addRows( $rows, $atts = array() )
    {
        for ($i=0; $i<count($rows); $i++) {
            $this->addRow($rows[$i], $atts);
        }
    }
}
?>
