<?PHP
/**
 * Simple example that creates a XUL Tree
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

$gbox = $doc->createElement('Groupbox', array('orient'=>'horizontal', 'height' => 500));
$win->appendChild($gbox);


$gbox->setCaption('The World of Super-Heroes');

$tree = $doc->createElement( 'Tree', array( 'flex' => 1 ) );
$tree->setColumns( 3,
                        array(
                                'id'  => 'hero',
                                'label' => 'Superhero',
                                'flex'  => 2,
                                'primary' => 'true'
                              ),
                        array(
                                'id'  => 'name',
                                'label' => 'Name',
                                'flex'  => 1
                              ),
                        array(
                                'id'  => 'surname',
                                'label' => 'Surname',
                                'flex'  => 1
                              )
                 );

$tree->addItem(array( 'Green Arrow', 'Oliver', 'Queen' ));

$jla = $tree->addItem(array( 'JLA' ));

$jla->addItem(array( 'The Flash', 'Wally', 'West' ));
$jla->addItem(array( 'Superman', 'Clark', 'Kent' ));

$reserves = $jla->addItem(array( 'Reserves' ));
$reserves->addItem(array( 'Nightwing', 'Dick', 'Grayson' ));
                 
$gbox->appendChild( $tree );

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
