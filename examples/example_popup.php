<?PHP
/**
 * Simple example that creates a XUL document with
 * a popup
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

$box = &$doc->createElement( 'Groupbox', array( 'orient' => 'horizontal' ) );
$win->appendChild($box);

$box->setCaption('Using popups');
$box->appendChild( $doc->createElement( 'Button', array('label' => 'Left click', 'id' => 'myButton', 'popup' => 'myPopup') ) );
$box->appendChild( $doc->createElement( 'Button', array('label' => 'Right click', 'id' => 'myButton2', 'context' => 'myPopup') ) );

$set = &$doc->createElement( 'Popupset' );
$win->appendChild($set);

$popup = &$doc->createElement( 'Popup', array( 'id' => 'myPopup' ) );
$popup->addDescription('This is just some text, but you could place anything in a popup.');
$set->appendChild($popup);

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