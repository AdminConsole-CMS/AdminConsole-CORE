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
            <div class="ac-sidebar-collapse"><a class="ac-sidebar-collapse-toggle dropdown-toggle" href="#ac-sidebar-content-item1" data-toggle="collapse" aria-expanded="false"><i class="fas fa-thumbtack"></i>&nbsp; Posts</a>
                <ul class="list-unstyled collapse" id="ac-sidebar-content-item1">
                    <li><a href="post.php"><i class="fas fa-eye"></i>&nbsp; See posts</a></li>
                    <li><a href="post-new.php"><i class="fas fa-plus"></i>&nbsp; Add posts</a></li>
                </ul>
            </div>
            <div class="ac-sidebar-collapse"><a class="ac-sidebar-collapse-toggle dropdown-toggle" href="#ac-sidebar-content-item2" data-toggle="collapse" aria-expanded="false"><i class="fas fa-copy"></i>&nbsp; Pages</a>
                <ul class="list-unstyled collapse" id="ac-sidebar-content-item2">
                    <li><a href="page.php"><i class="fas fa-eye"></i>&nbsp; See pages</a></li>
                    <li><a href="page-new.php"><i class="fas fa-plus"></i>&nbsp; Add pages</a></li>
                </ul>
            </div>
        </div>
        <div class="ac-sidebar-bottom">
            <div><a href="#" title="Open/Close Fullscreen" onclick="ac_openFullscreen(); ac_closeFullscreen()"><i class="fas fa-expand"></i></a></div>
            <div><a href="../ac-login.php?action=logout" title="Log Out"><i class="fas fa-sign-out-alt"></i></a></div>
        </div>
    </div>