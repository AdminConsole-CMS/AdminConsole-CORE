<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

?>

<div id="ac-sidebar">
        <div class="ac-sidebar-top"><h2 class="ac-brand">AdminConsole<sub> CORE</sub></h2></div>
        <div class="mobile-sidebar-oc"><a id="mobile-sidebar-oc" title="Open/Close Sidebar">Close Sidebar&nbsp;&nbsp;<i class="fas fa-times"></i></a></div>
        <div class="ac-sidebar-content">
            <div class="ac-sidebar-collapse"><a class="ac-sidebar-collapse-toggle dropdown-toggle" href="#ac-sidebar-content-item1" data-toggle="collapse" aria-expanded="false"><i class="fas fa-thumbtack"></i>&nbsp; Articles</a>
                <ul class="list-unstyled collapse" id="ac-sidebar-content-item1">
                    <li><a href="article.php">All articles</a></li>
                    <li><a href="article-new.php">Add article</a></li>
                </ul>
            </div>
            <div class="ac-sidebar-collapse"><a class="ac-sidebar-collapse-toggle dropdown-toggle" href="#ac-sidebar-content-item2" data-toggle="collapse" aria-expanded="false"><i class="fas fa-copy"></i>&nbsp; Pages</a>
                <ul class="list-unstyled collapse" id="ac-sidebar-content-item2">
                    <li><a href="page.php">All pages</a></li>
                    <li><a href="page-new.php">Add page</a></li>
                </ul>
            </div>
			 <div class="ac-sidebar-collapse"><a class="ac-sidebar-collapse-toggle dropdown-toggle" href="#ac-sidebar-content-item3" data-toggle="collapse" aria-expanded="false"><i class="fas fa-images"></i>&nbsp; Images</a>
                <ul class="list-unstyled collapse" id="ac-sidebar-content-item3">
                    <li><a href="media-library.php">Library</a></li>
                    <li><a href="media-new.php">Add images</a></li>
                </ul>
            </div>
			<div class="ac-sidebar-link">
				<a href="settings.php"><i class="fas fa-cogs"></i>&nbsp; Settings</a>
			</div>	
        </div>
        <div class="ac-sidebar-bottom">
            <div><a href="#" title="Open/Close Fullscreen" onclick="ac_openFullscreen(); ac_closeFullscreen()"><i class="fas fa-expand"></i></a></div>
            <div><a href="login.php?action=logout" title="Logout"><i class="fas fa-sign-out-alt"></i></a></div>
        </div>
    </div>