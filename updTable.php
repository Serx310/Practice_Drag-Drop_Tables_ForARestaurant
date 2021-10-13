<?php
require_once 'settings.php';
require_once 'database.php';

$my_set = new Ob_table_Settings();
$my_db =  new myDB( $my_set->host, $my_set->username,  $my_set->password , $my_set->database );

$floorId = "0";
$ierror = 0;

if ( (isset ($_REQUEST['m'])) && ( strlen($_REQUEST['m'])>0 )  ){
  $mode = $_REQUEST['m'];
}else{
  $ierror++;
}

if ( (isset ($_REQUEST['n'])) && ( strlen($_REQUEST['n'])>0 )  ){
  $tblName = $_REQUEST['n'];
}else{
  $ierror++;
}

if ( (isset ($_REQUEST['x'])) && ( strlen($_REQUEST['x'])>0 )  ){
  $iX = $_REQUEST['x'];
}else{
  $ierror++;
}

if ( (isset ($_REQUEST['y'])) && ( strlen($_REQUEST['y'])>0 )  ){
  $iY = $_REQUEST['y'];
}else{
  $ierror++;
}

if ( (isset ($_REQUEST['fl'])) && ( strlen($_REQUEST['fl'])>0 )  ){
  $floorId = $_REQUEST['fl'];
}else{
  $ierror++;
}

if ( (isset ($_REQUEST['id'])) && ( strlen($_REQUEST['id'])>0 )  ){
  $tblId = $_REQUEST['id'];
}else{
  $ierror++;
}



if($ierror == 0)
{
  if ($mode==1) {
    $Id = $my_db -> InsertTable($floorId, $tblName, ($iX-35), ($iY-68));
  }
  else if($mode==2){
    $Id = $my_db -> UpdateTable($floorId, $tblName, ($iX-35), ($iY-68), $tblId);
  }

  echo "ok!";
}else{
  echo "error!";
}


?>
