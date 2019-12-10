<?php

/*
 * AdminConsole CORE is released under the GNU General Public License.
 * LICENSE.txt file in the main directory.
*/

/* MySQL hostname */
define("AC_DB_HOST", "HERE YOUR VALUE");

/* MySQL database username */
define("AC_DB_USERNAME", "HERE YOUR VALUE");

/* MySQL database password */
define("AC_DB_PASSWORD", "HERE YOUR VALUE");

/* AdminConsole database name */
define("AC_DB_NAME", "HERE YOUR VALUE");

/* Database Charset to use in creating database tables. */
define("AC_DB_CHARSET", "utf8");

/* AdminConsole database table prefix.*/
$table_prefix  = 'ac_';
$table_prefix  .= 'HERE YOUR VALUE';

/* Connection to database */
$conn = new mysqli(AC_DB_HOST, AC_DB_USERNAME, AC_DB_PASSWORD, AC_DB_NAME);

if ($conn->connect_error) {
	die ("Connection failed:".$conn->connect_error);
}

/* Charset of database */
mysqli_set_charset($conn,AC_DB_CHARSET);

include 'ac-version.php';

?>