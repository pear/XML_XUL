<?PHP
/**
 * Simple example that builds two progress bars,
 * one determined and one undetermined.
 *
 * @author      Stephan Schmidt <schst@php.net>
 * @package     XML_XUL
 * @subpackage  Examples
 */

/**
 * require XML_XUL package
 */
require_once 'XML/XUL.php';
 
$doc = &XML_XUL::createDocument();

$doc->addStylesheet('chrome://global/skin/');
 
$win = &$doc->createElement('window', array('title'=> 'Example for PEAR::XML_XUL'));
$doc->addRoot($win);

$box = &$doc->createElement( 'Groupbox' );
$win->appendChild($box);

$box->setCaption( 'Using a progressmeter' );

$box->addDescription( 'Progressmeters can either be determined...' );

$meter = &$doc->createElement( 'Progressmeter', array( 'mode' => 'determined', 'value' => '30%', 'height' => 20 ) );
$box->appendChild( $meter );

$box->addDescription( '...or undetermined.' );

$meter2 = &$doc->createElement( 'Progressmeter', array( 'mode' => 'undetermined', 'height' => 20 ) );
$box->appendChild( $meter2 );

if (!isset($_GET['mode'])) {
	$_GET['mode'] = 'default';
}

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