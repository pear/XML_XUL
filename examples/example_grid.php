<?PHP
/**
 * Simple example that creates a XUL Grid
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

$gbox =  &$doc->createElement('Groupbox', array('orient'=>'vertical'));
$gbox->setCaption('Displaying tabular data with the Grid Element');

$gbox->appendChild( $doc->createElement( 'Description', array(), 'A grid can be used to display any tabular data, simple text or any XUL elements.' ) );

$win->appendChild($gbox);


$grid = &$doc->createElement('Grid');
$grid->setColumns(3, array( 'flex' => 2 ), array( 'flex' => 1 ), array( 'flex' => 1 ));

$gbox->appendChild($grid);

/**
 * adding any type of elements
 */
$headers = array(
                    $doc->createElement( 'Description', array( 'style' => 'font-weight:bold;' ), 'Superhero' ),
                    $doc->createElement( 'Description', array( 'style' => 'font-weight:bold;' ), 'Name' ),
                    $doc->createElement( 'Description', array( 'style' => 'font-weight:bold;' ), 'Surname' )
                );
$grid->addRow($headers);

/**
 * adding one row of text
 */
$supes = array( 'Superman', 'Clark', 'Kent' ); 
$grid->addRow($supes);

/**
 * adding several rows
 */
$jla = array(
                array( 'Aquaman', 'Arthur', 'Curry' ),
                array( 'Martian Manhunter', 'J\'onn', 'J\'onnz' ),
                array( 'The Flash', 'Wally', 'West' ),
                array(
                    $doc->createElement( 'Textbox', array( 'id' => 'hero' ) ),
                    $doc->createElement( 'Textbox', array( 'id' => 'name' ) ),
                    $doc->createElement( 'Textbox', array( 'id' => 'surname' ) ),
                     )
             );
$grid->addRows($jla);

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