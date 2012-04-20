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
 
$doc = XML_XUL::createDocument(null, 'xul');
$doc->setHtmlNamespace('html');

$doc->addStylesheet('chrome://global/skin/');
$doc->addStylesheet('chrome://global/test/');
 
$win = $doc->createElement('Window', array('title'=> 'Example for PEAR::XML_XUL', 'id' => 'foo'));
$doc->addRoot($win);

$gbox = $doc->createElement('Groupbox', array('orient'=>'vertical'));
$gbox->setCaption('Using Listboxes');

$gbox->appendChild( $doc->createElement( 'Description', array(), 'This is a simple listbox.' ) );

$win->appendChild($gbox);


$lb1 = $doc->createElement('Listbox', array('rows' => 3, 'id' => 'heroes'));
$lb1->addItem( 'Superman', 'supes' );
$lb1->addItem( 'Batman', 'bats' );
$gbox->appendChild($lb1);

$gbox->appendChild( $doc->createElement( 'Description', array(), 'This is a listbox with several columns.' ) );

$lb2 = $doc->createElement('Listbox');
$lb2->setHeaders( array(
                        'Superhero',
                        'Name',
                        array( 'label' => 'Surname', 'sortable' => 'true' )
                       )
                );
$lb2->setColumns( 3, array( 'flex' => 2, 'style' => 'background-color:#dddddd;' ), array( 'flex' => 1 ), array( 'flex' => 1 ) );

$lb2->addItem( array( 'Superman', 'Clark', 'Kent' ), 'supes' );
$lb2->addItem( array( 'Green Lantern', 'Kyle', 'Rayner' ), 'gl' );
$lb2->addItem( array( 'The Flash', 'Wally', 'West' ), 'flash' );

$gbox->appendChild($lb2);

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
    echo '<pre>';
    $doc->showDebug();
    echo '</pre>';
}
?>
