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
 * XML/XUL/Element/Treecol.php
 *
 * Treecol element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Treecol.php
 *
 * Treecol element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_treecol.html
 */
class XML_XUL_Element_Treecol extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'treecol';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'sort' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'resource' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'primary' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'sortSeparators' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'label' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'sortActive' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'sortDirection' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'hideheader' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'accesskey' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'type' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                )
                            );
}
?>