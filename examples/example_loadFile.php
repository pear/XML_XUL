<?PHP
/**
 * Simple example that showcases how to validate the
 * attributes of a textbox.
 *
 * @author      Stephan Schmidt <schst@php.net>
 * @package     XML_XUL
 * @subpackage  Examples
 */

/**
 * require XML_XUL package
 */
require_once 'XML/XUL.php';
 
$doc = &XML_XUL::loadFile('xul/example1.xul');

$box = &$doc->getElementById('box');
$browser = &$doc->getElementById('pear');

$browser2 = $browser->cloneElement();

$browser2->setAttribute( 'src', 'http://php.net' );

$box->appendChild( $browser2 );

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