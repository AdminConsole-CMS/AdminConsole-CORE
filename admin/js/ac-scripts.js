/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

$(document).ready(function () {

    $('#sidebar-collapse').on('click', function () {
        $('#ac-sidebar').toggleClass('active');
        $('#ac-navbar').toggleClass('active');
        $('#ac-content').toggleClass('active');
        $('.navbar-collapse-icon').toggleClass('active');
    });

});

$(document).ready(function () {

    $('#mobile-sidebar-oc').on('click', function () {
        $('#ac-sidebar').toggleClass('active');
        $('#ac-navbar').toggleClass('active');
        $('#ac-content').toggleClass('active');
        $('.navbar-collapse-icon').toggleClass('active');
    });

});

var elem = document.documentElement;

function ac_openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) {
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) {
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) {
    elem.msRequestFullscreen();
  }
}

function ac_closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) {
    document.msExitFullscreen();
  }
}