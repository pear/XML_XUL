<?PHP
/**
 * Simple example that shows the two ways
 * to embedd HTML in a XUL document.
 *
 * @author      Stephan Schmidt <schst@php.net>
 * @package     XML_XUL
 * @subpackage  Examples
 */

/**
 * require XML_XUL package
 */
require_once 'XML/XUL.php';
 
$doc = &XML_XUL::createDocument( );

$doc->addStylesheet('chrome://global/skin/');
$doc->setHtmlNamespace('html');
 
$win = &$doc->createElement('Window', array('title'=> 'Example for PEAR::XML_XUL'));
$doc->addRoot($win);

/**
 * create HTML like you would create XUL
 */
$p   = &$doc->createHtmlElement( 'p', array(), 'This is HTML.' );
$win->appendChild($p);

/**
 * create HTML from a raw string
 */
$html   = &$doc->createHtmlRaw( '<html:p>This is also HTML, including a <html:a href="http://pear.php.net">link</html:a>.</html:p>' );
$win->appendChild($html);

if ($_GET['mode'] == 'debug') {
    require_once 'XML/Beautifier.php';
    $fmt = &new XML_Beautifier( array( 'indent' => '  ' ) );
    echo '<pre>';
    echo htmlspecialchars( $fmt->formatString($doc->serialize()) );
    echo '</pre>';
} elseif ($_GET['mode'] == 'source') {
    highlight_file( __FILE__ );
} else {
    $doc->send();
}
?>