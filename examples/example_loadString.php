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

$xul = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
        <window id="win" title="Example for PEAR::XML_XUL" xmlns="http://www.mozilla.org/keymaster/gatekeeper/there.is.only.xul">
          <groupbox id="box1">
            <caption label="Loading from a string"/>
            <progressmeter height="20" mode="undetermined" />
          </groupbox>
        </window>';
 
$doc = XML_XUL::loadString($xul);
$win = $doc->getElementById('win');


$box1 = $doc->getElementById('box1');
$box2 = $box1->cloneElement(true);
$box2->setCaption('Cloned recursive');

$box3 = $box1->cloneElement();
$box3->setCaption('Cloned non-recursive');

$win->appendChild($box2);
$win->appendChild($box3);

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
