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
 * XML/XUL/Element/Listbox.php
 *
 * Listboxheader element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Listbox.php
 *
 * Listbox element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_listbox.html
 * @example  example_listbox.php
 */
class XML_XUL_Element_Listbox extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'listbox';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'datasources' => array(
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
                                'rows' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'seltype' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'ref' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
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
    * If you need to specify attributes for the different
    * columns you may pass array of attributes for each column
    * as parameter 2 to X, where X is the number of columns you
    * have set.
    *
    * @access    public
    * @param    integer    number of columns
    */
    function setColumns( $columns )
    {
        $this->_columns = $columns;
        $columnObj = $this->_doc->createElement('Listcols');
        
        $atts = func_get_args();
        array_shift($atts);
        
        for ($i=0; $i<$columns; $i++) {
            if (!isset($atts[$i])) {
                $atts[$i] = array();
            }
            $columnObj->appendChild( $this->_doc->createElement('Listcol', $atts[$i]));
        }
        $this->appendChild($columnObj);
    }

   /**
    * set the headers
    *
    * The headers should at least contain the label of the column, but
    * you may also set any other attribute that is supported by
    * XML_XUL_Element_Listheader.
    *
    * @access    public
    * @param    array    array containing all headers
    */
    function setHeaders( $headers )
    {
        $headerObj = $this->_doc->createElement('Listhead');
        
        for ($i=0; $i<count($headers); $i++) {
            if (!is_array($headers[$i])) {
                $headers[$i] = array(
                                        'label' => $headers[$i]
                                    );
            }
            $headerObj->appendChild( $this->_doc->createElement('Listheader', $headers[$i]));
        }
        $this->appendChild($headerObj);
    }

   /**
    * add an item
    *
    * @access    public
    * @param    mixed   label of the item, can be a string or an array if the box has several columns
    * @param    string  value for the item
    * @param    array   attributes for the listitem
    * @param    array   attributes for the listcell, if the list has more than one column
    */
    function addItem( $label, $value, $atts = array(), $cellAtts = array() )
    {
        /**
         * no columns have been set
         */
        if ($this->_columns == null) {
            $atts['label'] = $label;
            $atts['value'] = $value;
            $obj = $this->_doc->createElement( 'Listitem', $atts );
        } else {
            $atts['value'] = $value;
            $obj = $this->_doc->createElement( 'Listitem', $atts );
            for ($i=0; $i<$this->_columns; $i++) {
                $cellAtts['label'] = $label[$i];
                $obj->appendChild( $this->_doc->createElement( 'Listcell', $cellAtts ) );
            }
        }
        $this->appendChild($obj);
    }
}
?>
