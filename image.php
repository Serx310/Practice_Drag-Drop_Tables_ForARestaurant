<?php
require_once 'settings.php';
require_once 'database.php';


if ( (isset ($_REQUEST['fl'])) && ( strlen($_REQUEST['fl'])>0 )  ){
  $floorId = $_REQUEST['fl'];
}else{
  header("HTTP/1.0 404 Not Found");
  exit;
}

$my_set = new Ob_table_Settings();
$my_db = new myDB( $my_set->host, $my_set->username,  $my_set->password , $my_set->database );
$img = $my_db -> GetImgBLOB($floorId);


if(empty($img)){
  header("HTTP/1.0 404 Not Found");
  echo "ERROR!";
}else {
    header('Content-type: image/jpeg');
    echo $img;
}


?>
