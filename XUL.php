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
 * XML/XUL.php
 *
 * package to create XUL documents
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 */

/**
 * uses PEAR error handling
 */
 require_once 'PEAR.php';
 
/**
 * XML/XUL.php
 *
 * package to create XUL documents
 *
 * To create a new document you have to call
 * createDocument() statically:
 *
 * <code>
 * require_once 'XML/XUL.php';
 *
 * $doc = &XML_XUL::createDocument( 'myXUL.xml', 'myNs' );
 * </code>
 *
 * The document object provides methods to create and
 * add any element you like:
 *
 * <code>
 * $win = &$doc->createElement('window', array('title'=> 'Example for PEAR::XML_XUL'));
 * $doc->addRoot($win);
 * </code>
 *
 * @package  XML_XUL
 * @author   Stephan Schmidt <schst@php.net>
 * @static
 */
class XML_XUL
{
   /**
    * return API version
    *
    * @access   public
    * @static
    * @return   string  $version API version
    */
    function apiVersion()
    {
        return "0.1";
    }

   /**
    * create a XUL document
    *
    * @access   public
    * @param    string  filename
    * @param    string  namespace for XUL elements
    */
    function &createDocument( $filename = null, $ns = null )
    {
        require_once 'XML/XUL/Document.php';

        $doc = &new XML_XUL_Document( $filename, $ns );
        return $doc;
    }

   /**
    * load a XUL document from file
    *
    * @access   public
    * @param    string  filename
    */
    function &loadFile( $filename )
    {
        require_once 'XML/XUL/Parser.php';

        $parser = &new XML_XUL_Parser();
        $doc    = $parser->loadFile( $filename );
        return $doc;
    }

   /**
    * load a XUL document from a string
    *
    * @access   public
    * @param    string  filename
    */
    function &loadString( $filename, $ns = null )
    {
        require_once 'XML/XUL/Parser.php';

        $parser = &new XML_XUL_Parser();
        $doc    = $parser->loadString( $filename );
        return $doc;
    }
}
?>