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
 * XML/XUL/Element/Window.php
 *
 * Window element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * needs the element base class
 */
 require_once 'XML/XUL/Element.php';
 
/**
 * XML/XUL/Element/Window.php
 *
 * Window element
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @link     http://www.xulplanet.com/references/elemref/ref_window.html
 */
class XML_XUL_Element_Window extends XML_XUL_Element
{
   /**
    * element name
    *
    * @access public
    * @var  string
    */
    var $elementName = 'window';

   /**
    * attribute defintions
    *
    * @access   private
    * @var      array
    */
    var $_attribDefs = array(
                                'windowtype' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'titlepreface' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'onload' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'onunload' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'titlemodifier' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'title' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'onclose' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'titlemenuseparator' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'contenttitlesetting' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'y' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'x' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'screenY' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                                'screenX' => array(
                                                   'required' => false,
                                                   'type'     => 'string',
                                                ),
                            );
   /**
    * add external javascript
    *
    * @access   public
    * @param    string      src of the script
    * @param    string      type of the script
    */
    function addScript( $src, $type = 'application/x-javascript' )
    {
        $this->appendChild( $this->_doc->createElement( 'Script', array( 'src' => $src, 'type' => $type ) ) );
    }
}
?>
