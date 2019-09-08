<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt files in the main directory.
*/

/* MySQL hostname */
define("AC_DB_HOST", "localhost");

/* MySQL database username */
define("AC_DB_USERNAME", "root");

/* MySQL database password */
define("AC_DB_PASSOWRD", "");

/* AdminConsole database name */
define("AC_DB_NAME", "accore");

/* Database Charset to use in creating database tables. */
define("AC_DB_CHARSET", "utf8");

/* AdminConsole database table prefix.*/
$table_prefix  = '';



/* Connection to database */
$conn = new mysqli(AC_DB_HOST, AC_DB_USERNAME, AC_DB_PASSOWRD, AC_DB_NAME);

if ($conn->connect_error) {
	die ("Connection failed:".$conn->connect_error);
}

/* Charset of database */
mysqli_set_charset($conn,AC_DB_CHARSET);


$ac_username = "Admin";
$ac_password = "";

$admin_console_version = "0.9";

?>