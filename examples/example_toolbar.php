<?PHP
/**
 * Simple example that creates a XUL toolbar
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
 
$win = &$doc->createElement('Window', array('title'=> 'Example for PEAR::XML_XUL'));
$doc->addRoot($win);

$gbox =  &$doc->createElement('Groupbox', array('orient'=>'horizontal', 'height' => 50));
$win->appendChild($gbox);


$gbox->setCaption('Building a toolbar');

$box = &$doc->createElement( 'Toolbox', array( 'flex' => 1 ) );

$bar = &$box->addToolbar( array( 'id' => 'bar1' ) );
$bar->addButton( array( 'label' => 'Click!' ) );
$bar->addButton( array( 'label' => 'Another Button' ) );
$bar->addSeparator();
$bar->addButton( array( 'label' => 'Load' ) );
$bar->addButton( array( 'label' => 'Save' ) );

$bar2 = &$box->addToolbar( array( 'id' => 'bar2' ) );
$bar2->addButton( array( 'label' => 'Button 1' ) );
$bar2->addButton( array( 'label' => 'Button 2' ) );
$bar2->addButton( array( 'label' => 'Button 3' ) );
$bar2->addButton( array( 'label' => 'Button 4' ) );

$gbox->appendChild( $box );

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