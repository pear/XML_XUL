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
 * XML/XUL/Element/Button.php
 *
 * Button element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Button.php
 *
 * Button element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_button.html
 */
class XML_XUL_Element_Button extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'button';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'accesskey' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'dir' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'disabled' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'dlgType' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'group' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'image' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'label' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'orient' => array(
                                                   'required' => false,
                                                   'type'     => 'enum',
                                                   'values'   => array( 'vertical', 'horizontal' )
                                                ),
                                'type' => array(
                                                   'required' => false,
                                                   'type'     => 'enum',
                                                   'values'   => array( 'checkbox', 'menu', 'menubutton', 'radio' )
                                                ),
                                'value' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                            );
}
?>