<?php
ob_start();
session_start();

//set timezone
date_default_timezone_set('Europe/Belgrade');

//database credentials
define('DBHOST','');
define('DBUSER','');
define('DBPASS','');
define('DBNAME','');

//application address
define('DIR','http://localhost/');
define('UPLOAD','http://localhost/upload/');
define('SITEEMAIL','example@gmail.com');

try {

		//create PDO connection
		$db = new PDO("mysql:host=".DBHOST.";charset=utf8mb4;dbname=".DBNAME, DBUSER, DBPASS);
    //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);//Suggested to uncomment on production websites
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

} catch(PDOException $e) {
	//show error
    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
    exit;
}


//include the user class, pass in the database connection
include($_SERVER['DOCUMENT_ROOT'].'/classes/user.php');
include($_SERVER['DOCUMENT_ROOT'].'/includes/include.php');

$user = new User($db);
?>
