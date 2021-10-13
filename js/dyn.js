let offsetX;
let offsetY;

let idDrag;
let saal;
let a;
let insert_mode;

function lauadReady(){
  // idDrag = document.getElementById("dragger");
   saal = $('dropzone');
  // console.log("lauadReady found"+idDrag.innerHTML);

}

function AddNewTbl(){
  let tblName=$('newTblName').value;
  console.log("Clicked");
  console.log("Name: "+tblName +" length = "+ tblName.length);
  if(tblName.length > 0){
    a=$('tblNew');
    insert_mode = 1;
    a.innerHTML = tblName;
    console.log('this table name is '+a.innerHTML+' . floorId='+$("curFl").value);
    a.style.visibility = "visible";

    a.style.width = (50+(tblName.length*5))+'px';
  }else{
    alert("Enter the name!");
  }

}


function dragstart_handler(ev) {
  console.log("dragstart_handler yes");
  ev.dataTransfer.setData("text/html", ev.target.outerHTML);
  console.log("dragstart_handler "+ev.target.outerHTML);

  console.log("2 dragstart_handler "+ev.target.innerHTML);
  console.log("3 dragstart_handler "+ev.target.id);
  a = ev.target;
  if(a.id=='tblNew') insert_mode=1;
  else insert_mode = 2;
  ev.dataTransfer.dropEffect = "move";
  const rect = ev.target.getBoundingClientRect();
  offsetX = ev.clientX - rect.x;
  offsetY = ev.clientY - rect.y;
  console.log("x="+ev.clientX);
  console.log("y="+ev.clientY);
}

function dragover_handler(ev) {
  console.log("success dragover_handler");
 ev.preventDefault();
 ev.dataTransfer.dropEffect = "move";

}


function drop_handler(ev) {
  console.log("success drop_handler");
 ev.preventDefault();
 // Get the id of the target and add the moved element to the target's DOM



    console.log("x="+ev.clientX);
    console.log("y="+ev.clientY);

    updateSaal(insert_mode, a.innerHTML, ev.clientX, ev.clientY, a.id);
}

function updateSaal (mode, lauanimi, iX, iY, lauaid)
{

       URLparam = 'm='+mode+'&n='+encodeURIComponent(lauanimi)+'&x='+iX+'&y='+iY+'&fl='+encodeURIComponent($("curFl").value)+'&id='+encodeURIComponent(lauaid);
       console.log('updTable.php?'+URLparam);
        var req = new Request({
                       method: 'get',
                       url: 'updTable.php',
                       timeout: 30,
                       noCache: true ,
                       onSuccess: function(responseText){

                           console.log("updateSaal " + responseText  );

                            location.reload();


                      }
                    }).send(URLparam);

}

function myKeyDown(e, iWhereCursor, laudId )
{
   var keynum;

   if(window.event) keynum = e.keyCode;
   else if(e.which)  keynum = e.which;

   console.log("myKeyDown " + keynum + " where c " + iWhereCursor + " laudId = "+laudId );


   if (keynum == 13 )
   {
     console.log('After enter: Name = '+$('NAME_'+laudId).value );
        console.log("mykewdown y="+$('Y_'+laudId).value);
console.log("mykewdown y="+(parseInt($('Y_'+laudId).value )+78) );


         updateSaal(2, $('NAME_'+laudId).value, (parseInt($('X_'+laudId).value)+35), (parseInt($('Y_'+laudId).value )+68), laudId);

         //$Id = $my_db -> UpdateTable($floorId, $tblName, ($iX-20), ($iY-78), $tblId);

   }

    //mySubmit();
}
