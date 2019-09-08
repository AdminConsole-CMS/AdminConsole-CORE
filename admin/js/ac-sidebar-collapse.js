/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
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