<?PHP
/**
 * Simple example that creates a XUL docuemt
 * with a browser and adds buttons to change the URL
 * displayed in the browser.
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
 
$win = $doc->createElement('window', array('title'=> 'Example for PEAR::XML_XUL'));
$doc->addRoot($win);

$box = $doc->createElement('box', array('align' => 'center', 'orient' => 'vertical'));
$win->appendChild($box);

$browser = $doc->createElement('browser', array('width' => 800, 'height'=> 500, 'src' => 'http://pear.php.net', 'id' => 'myBrowser'));
$box->appendChild($browser);

$box->addDescription('Please use buttons to control the browser.');

$box2 = $doc->createElement('box', array('align' => 'center', 'orient' => 'horizontal'));

$pear = $doc->createElement('button', array('label' => 'Goto PEAR', 'tooltiptext' => 'Click here to go to PEAR', 'onclick'=>'document.getElementById(\'myBrowser\').setAttribute(\'src\', \'http://pear.php.net\')'));
$php  = $doc->createElement('button', array('label' => 'Goto PHP.net', 'tooltiptext' => 'Click here to go to PHP.net', 'onclick'=>'document.getElementById(\'myBrowser\').setAttribute(\'src\', \'http://www.php.net\')'));
$pecl = $doc->createElement('button', array('label' => 'Goto PECL', 'tooltiptext' => 'Click here to go to PECL', 'onclick'=>'document.getElementById(\'myBrowser\').setAttribute(\'src\', \'http://pecl.php.net\')'));

$box->appendChild($box2);
$box2->appendChild($pear);
$box2->appendChild($php);
$box2->appendChild($pecl);

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
