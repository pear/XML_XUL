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
 * XML/XUL/Element/Browser.php
 *
 * Browser element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Browser.php
 *
 * Browser element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_browser.html
 * @example  example_browser.php
 */
class XML_XUL_Element_Browser extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'browser';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'src' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'name' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'content' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'onclick' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'type' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'disablehistory' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'disablesecurity' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                            );
}
?>