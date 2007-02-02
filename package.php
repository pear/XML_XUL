<?php
/**
 * script to automate the generation of the
 * package.xml file.
 *
 * $Id$
 *
 * @author      Stephan Schmidt <schst@php-tools.net>
 * @package     XML_XUL
 * @subpackage  Tools
 */

/**
 * uses PackageFileManager
 */ 
require_once 'PEAR/PackageFileManager.php';

/**
 * current version
 */
$version = '0.8.3';

/**
 * current state
 */
$state = 'alpha';

/**
 * release notes
 */
$notes = <<<EOT
- Overlays support added
- fixed #2184, listbox element numbers
- Resizable columns added
EOT;

/**
 * package description
 */
$description = <<<EOT
The XML User Interface Language (XUL) is a markup language for describing user interfaces.
With XUL you can create rich, sophisticated cross-platform web applications easily.
XML_XUL provides a API similar to DOM to create XUL applications. There is a PHP object for each XUL element, and the more complex widgets like grids, trees and tabboxes can easily be created with these objects.
EOT;

$package = new PEAR_PackageFileManager();

$result = $package->setOptions(array(
    'package'           => 'XML_XUL',
    'summary'           => 'Class to build Mozilla XUL applications.',
    'description'       => $description,
    'version'           => $version,
    'state'             => $state,
    'license'           => 'PHP License',
    'filelistgenerator' => 'cvs',
    'ignore'            => array('package.php', 'package.xml', 'package2.xml'),
    'notes'             => $notes,
    'simpleoutput'      => true,
    'baseinstalldir'    => 'XML',
    'packagedirectory'  => './',
    'dir_roles'         => array('docs' => 'doc',
                                 'examples' => 'doc',
                                 'tests' => 'test',
                                 )
    ));

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}

$package->addMaintainer('amir' , 'lead', 'Amir Mohammad Saied', 'amir@php.net');
$package->addMaintainer('schst', 'lead', 'Stephan Schmidt', 'schst@php.net');

$package->addDependency('PEAR', '', 'has', 'pkg', false);
$package->addDependency('XML_Util', '0.5.2', 'ge', 'pkg', false);
$package->addDependency('XML_Parser', '1.1.0', 'ge', 'pkg', false);
$package->addDependency('php', '4.2.0', 'ge', 'php', false);

if (isset($_GET['make']) || (isset($_SERVER['argv'][1]) && $_SERVER['argv'][1] == 'make')) {
    $result = $package->writePackageFile();
} else {
    $result = $package->debugPackageFile();
}

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}
?>
