<?PHP
/**
 * Simple example that creates a XUL document and modifies
 * the elements after they have been created
 *
 * @author      Stephan Schmidt <schst@php.net>
 * @package     XML_XUL
 * @subpackage  Examples
 */

/**
 * require XML_XUL package
 */
require_once 'XML/XUL.php';
 
$doc = &XML_XUL::createDocument( null, 'myNs' );

$doc->addStylesheet('chrome://global/skin/');
 
$win = &$doc->createElement('window', array('title'=> 'Example for PEAR::XML_XUL'));
$doc->addRoot($win);

$box = &$doc->createElement( 'Groupbox', array( 'orient' => 'horizontal' ) );
$win->appendChild($box);

$box->setCaption( 'Using DOM in PHP to modify an element' );

for( $i = 1; $i <= 5; $i++ )
{
    $box->appendChild( $doc->createElement( 'Button', array('label' => "Button $i", 'id' => "btn$i") ) );
}

$btn3 = &$doc->getElementById('btn3');
$btn6 = &$btn3->cloneElement();
$btn3->setAttribute( 'label', 'Modified after creation' );

$box->appendChild($btn6);

$win->addDescription( 'These buttons have been created with a "for" loop in PHP and button 3 has been changed after the creation.' );
$win->addDescription( 'Furthermore the last button is a clone of button 3 before it has been modified.' );

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