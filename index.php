<?php

require_once 'settings.php';
require_once 'database.php';
require_once 'tableinfo.php';

$my_set = new Ob_table_Settings();

$my_db =  new myDB( $my_set->host, $my_set->username,  $my_set->password , $my_set->database );

if ( (isset ($_REQUEST['op'])) && ( $_REQUEST['op']=='delTbl' ) &&

 (isset ($_REQUEST['tblId'])) && ( strlen($_REQUEST['tblId'])>0 ) )
{
  $my_db -> DeleteTable($_REQUEST['tblId']);
}

$aFloorList = $my_db -> GetFloorList();


if ( (isset ($_REQUEST['fl'])) && ( strlen($_REQUEST['fl'])>0 )  ){
  $currentFloorId = $_REQUEST['fl'];
}else{
  if($aFloorList['count']>0){
    $currentFloorId = $aFloorList[0]['ID'];
  }else{
    echo "Error! There are no floors.";
  }

}

$aTableList = $my_db -> GetTableList($currentFloorId);
$tbl_info = new TableInfo();
$tbl_info	-> setData($aTableList);
// echo $tbl_info -> getHTML();
$image = $my_db -> GetImage($currentFloorId);

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

echo '<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<link rel="stylesheet" href="css/styles.css" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/dyn.js"> </script>
<script type="text/javascript" src="js/MooTools-Core-1.6.0.js"> </script>
</head>
<body text="#000000" onload=lauadReady()>';


echo '<table border="0">';
echo '<tr> <td> ';
for ($i=0;  $i < $aFloorList['count'] ; $i++)  {
  if($aFloorList[$i]['ID']==$currentFloorId){
    echo '<b>'.$aFloorList[$i]['NAME'].'</b>';
  }else{
    echo '<a href="index.php?fl='.$aFloorList[$i]['ID'].'" style="text-decoration: none; color: green;">';
    echo $aFloorList[$i]['NAME'];
    echo '</a>';
  }

  echo '&nbsp;&nbsp;&nbsp;';

}
echo ' </td> </tr>';
echo '<tr> <td style="height: 45px; padding: 10px;"><input type="text" id="newTblName" value = "" /> ';
echo '<input type="hidden" id="curFl" value = "'.$currentFloorId.'" />';
echo '<div id="addTbl" class="AddButton" onclick="AddNewTbl();">';
echo '+</div>';
echo '<div id="tblNew" class="table" ';
echo ' draggable="true" ondragstart="dragstart_handler(event)" style="top:37px; left:300px; visibility: hidden;">';
echo 'NEW</div> </td> </tr>';
echo '<tr> <td>';

$tbl_info	-> setOffset(80);
echo $tbl_info -> getTableHTML($currentFloorId);
echo '</td> </tr>';
echo '<tr> <td>';
echo $tbl_info -> getHTML();
echo '</td> </tr>';
echo '</table>';
echo "</body> </html>";
?>
