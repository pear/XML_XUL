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
 
$doc    = &XML_XUL::createDocument();

$tb     = &$doc->createElement( 'Textbox', array( 'id' => 'name', 'size' => 20, 'align' => 'bar' ) );
$doc->addRoot($tb);

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

    $result = $tb->validateAttributes();

    echo    'Validating attributes of the textbox:';

    echo    "<pre>";
    var_dump($result);
    echo    "</pre>";
}
?>