<?PHP
/**
 * Simple example that creates a XUL document with two tabs to
 * switch between to pages.
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

$tabbox = &$doc->createElement( 'Tabbox' );
$win->appendChild($tabbox);

$browser1 = &$doc->createElement('browser', array('width' => 595, 'height'=> 390, 'src' => 'http://pecl.php.net', 'id' => 'browser1'));
$browser2 = &$doc->createElement('browser', array('width' => 595, 'height'=> 390, 'src' => 'http://pear.php.net', 'id' => 'browser2'));

$tabbox->addTab( 'PECL', $browser1 );
$tabbox->addTab( 'PEAR', $browser2 );

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