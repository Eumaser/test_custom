<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$db_server = "localhost";
$db_name = "crm_kcpart";
$db_user = "root"; //root
$db_passwd = ""; // empty
$connection = mysql_connect($db_server,$db_user,$db_passwd);
$db = mysql_select_db($db_name,$connection) or die("couldn't select Database");
