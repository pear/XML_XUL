<?PHP
/**
 * Simple example that creates a XUL menu
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

$box = $doc->createElement('Toolbox', array('flex' => '1'));
$win->appendChild($box);

$bar = $doc->createElement('Menubar', array('id' => 'myBar'));
$box->appendChild( $bar );

$menu = $bar->addMenu(array('id' => 'file', 'label' => 'File'));
$menu->addItem(array('label' => 'Open'));
$menu->addItem(array('label' => 'Save'));

$sub = $menu->addSubmenu(array('label' => 'Save as...'));
$sub->addItem(array('label' => 'XML'));
$sub->addItem(array('label' => 'Plain Text'));

$menu->addSeparator();
$menu->addItem(array('label' => 'Exit'));

$menu2 = $bar->addMenu(array('id' => 'edit', 'label' => 'Edit'));
$menu2->addItem(array('label' => 'Copy'));
$menu2->addItem(array('label' => 'Paste'));

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
