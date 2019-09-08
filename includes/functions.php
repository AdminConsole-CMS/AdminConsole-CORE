<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

function include_css() {
$css = "";
$handle = "";
$file = "";
// open the "css" directory
if ($handle = opendir('includes/css')) {
    // list directory contents
    while (false !== ($file = readdir($handle))) {
        // only grab file names
        if (is_file('includes/css/' . $file)) {
            // insert HTML code for loading Javascript files
            $css .= '<link rel="stylesheet" href="includes/css/' . $file .
                '" type="text/css" media="all" />' . "\n";
        }
    }
    closedir($handle);
    echo $css;
	}
}

function include_js() {

$js = "";
$handle = "";
$file = "";
if ($handle = opendir('includes/js')) {
    
    while (false !== ($file = readdir($handle))) {
        // only grab file names
        if (is_file('includes/js/' . $file)) {
            // insert HTML code for loading Javascript files
            $js .= '<script src="includes/js/' . $file . '" type="text/javascript"></script>' . "\n";
        }
    }
    closedir($handle);
    echo $js;
	}		
}

?>