<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

?>

<div id="ac-navbar">
        <nav class="navbar navbar-dark navbar-expand-lg">
            <div class="container-fluid"><a id="sidebar-collapse" class="navbar-collapse-icon"><i class="fas fa-arrow-left"></i></a>
                <div class="ac-logo"></div><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="../index.php" target="blank"><i class="fas fa-globe"></i>&nbsp;Visit&nbsp;Site</a></li>
                    </ul>
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false"><img src="img/ac1.png">&nbsp;<?php if (isset($_SESSION["AC-ADMIN-USERNAME"])){echo $_SESSION["AC-ADMIN-USERNAME"];} ?></a>
                            <div class="dropdown-menu dropdown-menu-right" role="menu"><a class="dropdown-item" role="presentation" href="../ac-login.php?action=logout"><i class="fas fa-sign-out-alt"></i>&nbsp; Log Out</a></div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>