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
 * XML/XUL/Element/Splitter.php
 *
 * Splitter element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Splitter.php
 *
 * Splitter element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_splitter.html
 * @example  example_splitter.php
 * @see      XML_XUL_Element_Grippy
 */
class XML_XUL_Element_Splitter extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'splitter';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'persist' => array(
                                                   'required' => false,
                                                   'type'     => 'boolean',
                                                ),
                                'state' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                )
                            );

   /**
    * tells the splitter to add  grippy
    *
    * @access   public
    * @param    array   attributes of the grippy
    */
    function useGrippy( $atts = array() )
    {
        $this->appendChild( $this->_doc->createElement( 'Grippy', $atts ) );
    }

}
?>
