<?PHP
/**
 * Simple example that creates a XUL document with two
 * input fields.
 *
 * @author      Stephan Schmidt <schst@php.net>
 * @package     XML_XUL
 * @subpackage  Examples
 */

/**
 * require XML_XUL package
 */
require_once 'XML/XUL.php';
 
$doc = XML_XUL::createDocument();

$doc->addStylesheet('chrome://global/skin/');
 
$win = $doc->createElement('window', array('title'=> 'Example for PEAR::XML_XUL'));
$doc->addRoot($win);

$box = $doc->createElement( 'Groupbox', array( 'orient' => 'vertical' ) );
$win->appendChild($box);
$box->setCaption('Using input fields');

$box2 = $doc->createElement('Hbox');
$box2->appendChild( $doc->createElement( 'Label', array( 'value' => 'Please enter your name:', 'control' => 'name' ) ) );
$box2->appendChild( $doc->createElement( 'Textbox', array( 'id' => 'name', 'size' => 20 ) ) );

$box3 = $doc->createElement('Hbox');
$box3->appendChild( $doc->createElement( 'Label', array( 'value' => 'Please enter your comment:', 'control' => 'comment' ) ) );
$box3->appendChild( $doc->createElement( 'Textbox', array( 'id' => 'comment', 'size' => 20, 'multiline' => 'true' ) ) );

$box->appendChild( $box2 );
$box->appendChild( $box3 );

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
