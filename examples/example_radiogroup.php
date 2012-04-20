<?PHP
/**
 * Simple example that creates a XUL Radiogroup
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


$gbox->setCaption('Using radiogroups');

$radiog = $doc->createElement('Radiogroup');

$gbox->appendChild( $radiog );

$radiog->addRadio( 'This is foo', 'foo' );
$radiog->addRadio( 'This is bar', 'bar' );
$radiog->addRadio( 'This is selected', array( 'value' => 'foo', 'selected' => 'true' ) );

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
