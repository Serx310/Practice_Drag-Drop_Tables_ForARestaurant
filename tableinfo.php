
<?php

require_once 'settings.php';
require_once 'database.php';



class TableInfo{
  var $m_lang;
  var $m_floor;
  var $m_aTblDetails = array();
  var $m_vOffset = 0;



  function setData($a){
    $this->m_aTblDetails = $a;
  }

  function setLang($l){
    $this->m_lang = $l;
  }
  function setOffset($v){
    $this->m_vOffset = $v;
  }
  function setFloor($f){
    $this->m_floor = $f;
  }

  function getHTML(){



      $sHtMl = '<table border="1" cellspacing="0" cellpadding="3">

      <tr>
      <th>'.$this->m_lang->tblNum.'</th>

      <th>'.$this->m_lang->name.'</th>

      <th>X</th>

      <th>Y</th>

      <th>'.$this->m_lang->operation.'</th>

      </tr>';

      for ($i=0; $i < $this->m_aTblDetails['count']; $i++) {
        // code...
        $sHtMl .= '<tr>';
        $sHtMl .= '<td align="center">' . ($i+1) . '</td>';
        /*$sHtMl .= '<td>' . $this->m_aTblDetails[$i]['ID'].'</td>';*/
        $sHtMl .= '<td> <input type="text" id="NAME_'.$this->m_aTblDetails[$i]['ID'].'" value ="'.htmlspecialchars( $this->m_aTblDetails[$i]['NAME']).'" style="text-align:center;" onkeydown="myKeyDown(event, 1,\'' .$this->m_aTblDetails[$i]['ID']. '\');" autocomplete="off" /></td>';
        $sHtMl .= '<td> <input type="text" id="X_'.$this->m_aTblDetails[$i]['ID'].'" value = '.$this->m_aTblDetails[$i]['X'].' style="text-align:center;" onkeydown="myKeyDown(event, 2,\'' .$this->m_aTblDetails[$i]['ID']. '\');" autocomplete="off"/></td>';
        $sHtMl .= '<td> <input type="text" id="Y_'.$this->m_aTblDetails[$i]['ID'].'" value = '.$this->m_aTblDetails[$i]['Y'].' style="text-align:center;" onkeydown="myKeyDown(event, 3,\'' .$this->m_aTblDetails[$i]['ID']. '\');" autocomplete="off"/></td>';
        $sHtMl .= '<td align="center"> <a href="index.php?op=delTbl&tblId='.$this->m_aTblDetails[$i]['ID'].'&fl='.$this->m_floor.'" style="text-decoration: none; color: red;">'.$this->m_lang->del.'</a></td>';
        $sHtMl .= '</tr>';
      }
      $sHtMl .= '<tr> <td align="center" colspan = "5"><a href="index.php?op=delAllTbl&fl='.$this->m_floor.'" style="text-decoration: none; color: red;">'.$this->m_lang->delAll.' </a></td></tr>';
      $sHtMl .= '</table>';
    return $sHtMl;
  }
  function getTableHTML($currentFloorId){
      $sHTML = '<div class="dropper" id="dropzone" ondrop="drop_handler(event)" ondragover="dragover_handler(event)" style="background-image: url(image.php?fl='.$currentFloorId.')">';

         for($i=0; $i < $this->m_aTblDetails['count']; $i++){
           	$sHTML .= '<div id="'.$this->m_aTblDetails[$i]["ID"].'" class="table" ';
            $sHTML .= ' draggable="true" ondragstart="dragstart_handler(event)" style="top:'.($this->m_aTblDetails[$i]["Y"]+$this->m_vOffset).'px; left:'.$this->m_aTblDetails[$i]["X"].'px;';
            $sHTML .= 'width: '.(50+strlen($this->m_aTblDetails[$i]["NAME"])*5).'px;">';
            $sHTML .= $this->m_aTblDetails[$i]["NAME"].'</div>';
         }
      $sHTML .= '</div>';
    return $sHTML;
 }
}
?>
