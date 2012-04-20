<?PHP
/**
 * Simple example that creates a XUL splitter.
 *
 * Splitters allow users the resize the content in the
 * XUL application
 *
 * @author      Stephan Schmidt <schst@php.net>
 * @package     XML_XUL
 * @subpackage  Examples
 */

/**
 * require XML_XUL package
 */
require_once 'XML/XUL.php';
 
$doc = XML_XUL::createDocument( );

$doc->addStylesheet('chrome://global/skin/');
 
$win = $doc->createElement('Window', array('title'=> 'Example for PEAR::XML_XUL'));
$doc->addRoot($win);

$gbox = $doc->createElement('Groupbox', array('orient'=>'horizontal'));
$win->appendChild($gbox);


$gbox->setCaption('Using a splitter');

$gbox->appendChild( $doc->createElement( 'Description', array( 'width' => 200 ), 'A splitter allows a user to resize content. It is often used with a Grippy, that tiny little thing that you can click.' ) );

$splitter = $doc->createElement( 'Splitter', array( 'collapse' => 'before' ) );
$splitter->appendChild( $doc->createElement( 'Grippy' ) );
$gbox->appendChild( $splitter );

$gbox->appendChild( $doc->createElement( 'Iframe', array( 'src' => 'http://pear.php.net', 'height' => 400, 'width' => 250 ) ) );

$splitter2 = $doc->createElement( 'Splitter', array( 'collapse' => 'before' ) );
$splitter2->useGrippy();
$gbox->appendChild( $splitter2 );

$gbox->appendChild( $doc->createElement( 'Iframe', array( 'src' => 'http://bugs.php.net', 'height' => 400, 'width' => 250 ) ) );

if (!isset($_GET['mode'])) {
	$_GET['mode'] = 'default';
}

if ($_GET['mode'] == 'debug') {
    require_once 'XML/Beautifier.php';
    $fmt = new XML_Beautifier( array( 'indent' => '  ' ) );
    echo '<pre>';
    echo htmlspecialchars( $fmt->formatString($doc->serialize()) );
    echo '</pre>';
} elseif ($_GET['mode'] == 'source') {
    highlight_file( __FILE__ );
} else {
    $doc->send();
}
?>
