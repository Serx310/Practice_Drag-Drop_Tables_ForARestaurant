<?php
class myDb
{

  var $m_mysqli = null;
  var $m_row = 0;
  var $m_sth = null;

  function __construct ( $phost="", $pusername="", $ppassword = "", $pdatabase="" )
  {
	         $this->m_mysqli = new mysqli($phost, $pusername, $ppassword, $pdatabase );
           if (!$this->m_mysqli->set_charset("utf8"))
           {
                  echo "db error utf8:".
                  $this->m_mysqli->error;

           }
  }

  function GetFloorList(){
    $iCount = 0;

     $aRet['count'] =  $iCount;

     $sSql = "SELECT ID, NAME, IMAGE FROM FLOORS order by NAME";



     $this->m_sth = $this->m_mysqli->query( $sSql );

    while  ( $row = $this->m_sth->fetch_assoc()  )
    {
       // print_r ([$iCount+1]);
       $aRet [$iCount] ['ID']          =   $row['ID'];
       $aRet[$iCount]['NAME']     =   $row['NAME'];
       // $aRet[$iCount]['IMAGE']        =   $row['IMAGE'];

       $iCount ++;
    }

     $aRet['count'] =  $iCount;

      return $aRet;
  }

  function GetTableList ( $floorId = '0' )
     {
         $iCount = 0;

          $aRet['count'] =  $iCount;

          $sSql = "SELECT ID, NAME, X, Y, FLOOR FROM PLACES WHERE FLOOR = ".$this->MyVarchar($floorId)." order by NAME";



          $this->m_sth = $this->m_mysqli->query( $sSql );

         while  ( $row = $this->m_sth->fetch_assoc()  )
         {
            // print_r ([$iCount+1]);
            $aRet [$iCount] ['ID']          =   $row['ID'];
            $aRet[$iCount]['NAME']     =   $row['NAME'];
            $aRet[$iCount]['X']        =   $row['X'];
            $aRet[$iCount]['Y']        =   $row['Y'];

            $iCount ++;
         }

          $aRet['count'] =  $iCount;

           return $aRet;
     }


function InsertTable($floorId, $tblName, $iX, $iY){
  $id = $this->getUUID();
  $sSql = "INSERT INTO PLACES (ID, NAME, X, Y, FLOOR) VALUES (".$this->MyVarchar($id).", ".$this->MyVarchar($tblName).", ";
  $sSql .= $iX.", ".$iY.", ".$this->MyVarchar($floorId).")";
  echo $sSql;

  if(! $this->m_mysqli->query( $sSql ) )
        {
           echo "[oberror: ".$sSql."<br>".$this->m_mysqli->error."]";
           $id = -1;
        }
  return $id;
}

function updateTable($floorId, $tblName, $iX, $iY, $tblId){

  $sSql = "UPDATE PLACES SET NAME=".$this->MyVarchar($tblName).", X=".$iX.", Y=".$iY." WHERE ID=".$this->MyVarchar($tblId).";";
  echo $sSql;

  if(! $this->m_mysqli->query( $sSql ) )
        {
           echo "[oberror: ".$sSql."<br>".$this->m_mysqli->error."]";
           $tblId = -1;
        }
  return $tblId;
}

function getUUID()
    {
        $id = -1;
         $sSql = "select UUID() as ID";

         $this->m_sth = $this->m_mysqli->query( $sSql );

         if ( !$this->m_sth )
         { echo "[oberror: ".$sSql."<br>".$this->m_mysqli->error."]";

          }
         else if  ( $row = $this->m_sth->fetch_assoc()  )   $id = $row['ID'];

         return $id;
}

function DeleteTable($tblId){
  $del = "DELETE FROM PLACES WHERE ID=".$this->MyVarchar($tblId)."";
  if(! $this->m_mysqli->query( $del ) )
        {
           echo "[oberror: ".$sSql."<br>".$this->m_mysqli->error."]";
        }
}


function MyVarchar ( $sIn )
    {
        if ( ( isset($sIn ) ) && ( strlen ($sIn ) > 0 )   )
        {

            $sOut = "'".$this->m_mysqli->real_escape_string($sIn)."'";
        }
        else return 'null';

       return  $sOut;
    }

    function obsqlsafe  ( $sIn )
    {
         return     $this->m_mysqli->real_escape_string( $sIn );
    }

function GetImage($floorId){

   $sSql = "SELECT IMAGE FROM FLOORS where ID =".$this->MyVarchar($floorId);

   $this->m_sth = $this->m_mysqli->query( $sSql );

  if  ( $row = $this->m_sth->fetch_assoc()  )
  {
     file_put_contents('saal.jpg', $row['IMAGE']);
  }

}

function GetImgBLOB($floorId){

   $sSql = "SELECT IMAGE FROM FLOORS where ID =".$this->MyVarchar($floorId);

   $this->m_sth = $this->m_mysqli->query( $sSql );

  if  ( $row = $this->m_sth->fetch_assoc()  )
  {
     return $row['IMAGE'];
  }

}

}
 ?>
