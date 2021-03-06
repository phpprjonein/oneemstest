$(document).ready(function() { 

  setHeight();

        var default_pagelen = 14;
        if( $('#hidd_list_type').val() == 'market') {
          default_pagelen = 25;
        }
         var table =  $('#cellsitetech_user_devices').DataTable( {
          "processing": true,
          "lengthChange": true,
          "lengthMenu": [ 5, 10, 11, 12, 14, 15, 20, 25, 30, 50, 75, 100 ],
          "pageLength": default_pagelen,
          "serverSide": true, 
          "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}],
          "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "No records found",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "",
            "infoFiltered": ""
            },
          "ajax":"cellsitetech-user-list-server-process.php?list_for="+$('#hidd_list_for').val()+"&list_type="+$('#hidd_list_type').val(),
             "columns": [
            {  "className":  'device_row',
                "orderable":      false,
                "data":           null,
                "defaultContent": '<i class="fa fa-arrows-alt" aria-hidden="true"></i>'},
                { "data": "id", "visible": false  },     
                { "data": "csr_site_tech_name" },            
                { "data": "csr_site_id" },
                { "data": "csr_site_name" }, 
                { "data": "devicename" },
                { "data": "deviceIpAddr" }
        ],
        
        "order": [[2, 'asc']],
        "createdRow": function (row, data, rowIndex) {
             // var r = row;
             // $(row).addClass('device_row'); 
             $(row).attr('data-devicename', data.devicename);
             $(row).attr('data-deviceid', data.id);

        }           
      });
 
      $('#cellsitetech_user_devices').on( 'click', 'tbody tr',function(){
          $(this).toggleClass('drag_selected');

          $('tr.drag_selected').draggable({
          cursor: "move",
                cursorAt: {
                  top: -2,
                  left: -2
                },
                helper: function(event) {
                  var str = "<div></div>";
                  var indderdiv ='';
                  $('tr.drag_selected').each(function(e){
                    indderdiv += "<div class='box' style='border:1px solid gray; background-color:lightblue;width:200px'><i data-deviceid='"+ $(this).data('deviceid')+"' data-devicename='"+ $(this).data('devicename')+"' class='fa fa-plus'></i> &nbsp; " + $(this).data('devicename')  +  "</div>";
                  });
                  return $(str).html(indderdiv);
                
                }
          });
      });

      $('#cellsitetech_user_devices').on('mouseover', 'tbody', function (){      

          /*Droppable option enabled for My Device List box in MyList section*/
        $("#deviceslist.droppable").droppable({
          drop: function(event, ui) { 

           var tr_item = ui.helper.children();

           var deviceslist_item = $(this);
           
            

          tr_item.each(function(e){

            var dragged_records =  $(this).find('i');
            if (!deviceslist_item.find('tr').hasClass('del_' + dragged_records.data('deviceid'))) {

                deviceslist_item.find('#mydevicestbl').append(reconstruct(dragged_records)); 
                add_item_my_devices($('#hidd_userid').val(),$('#hidd_mylistid').val(), dragged_records.data('deviceid'))
            
             

             }  
           });
          }
        });
      });




  /* Accordian ajax call for switch details */
  $('.device_details').click(function(e) {
    $thisdiv = $(this);
    if (!$(this).hasClass('loaded')) {
      $.ajax({
        type: "get",
        url: "ajaxer/mycityswitchlist.php",
        data: {
          deviceid: $(this).data('deviceid'),
          userid: $(this).data('userid')
        },
        beforeSend: function() {
          $thisdiv.next('div').html(
            '<div class="text-center overlay box-body">Loading... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>'
          );
        },
        complete: function() {
          $thisdiv.addClass('loaded');
        },
        success: function(resdata) {
          setTimeout(function() {
            $thisdiv.next('div').html(resdata);
          }, 200);
        }
      });
    }
  });
 


  $('#usrmyfavlstfrm').submit(function () {
    var str = $('#addlist').val();
    if (/^[a-zA-Z0-9- ]*$/.test(str) == false) {
      alert('Your String Contains illegal Characters.');
      return false;
    }
  });

  $(window).resize(function() {
    setHeight();
  });

   
  $('#switch_item_name').on('change', function(){
      $('#srch-term').val('');
      $('#switch_list_form').submit();
  });

  $(document).on("mouseover", "body", function() {
    $("#switchlist .draggable").draggable({
      cursor: "move",
      cursorAt: {
        top: 15,
        left: 15
      },
      helper: function(event){
        return $("<div class='btn btn-warning btn-small'><i class='fa fa-times'></i>&nbsp;&nbsp;" + $(this).data('listname') + "</div>");
      }

    });

    $('#myswitchlist_delete').droppable({
      /*classes: {
        "ui-droppable-active": "ui-state-active",
        "ui-droppable-hover": "ui-state-hover"
      },*/
      drop: function( event, ui ) {
      }
    });
    $("#myswitchlist_delete.droppable").droppable({ 
      /*classes: {
        "ui-droppable-active": "ui-state-active",
        "ui-droppable-hover": "ui-state-hover"
      },*/
      drop: function(event, ui) {   
        switchlistdel( $('#hidd_userid').val() , ui.draggable.data('listid'));
      }
    });

// My Device List Section
    $("#mydevicestbl .draggable").draggable({
      cursor: "move",
       
      cursorAt: {
        top: 15,
        left: 15
      },
      helper: function(event){
        return $("<div class='btn btn-warning btn-small'><i class='fa fa-times'></i>&nbsp;&nbsp;" + $(this).data('deviceid') + "</div>");
      }

    });

    $("#mylist_delete").droppable({ 
    	/*
      classes: {
        "ui-droppable-active": "ui-state-active",
        "ui-droppable-hover": "ui-state-hover"
      },*/
      drop: function(event, ui) { 
      switchesdel($('#hidd_userid').val(), ui.draggable.data('listid')  ,  ui.draggable.data('deviceid')); 
      }
    });

    /**
    *  Drag and Drop devices to my device list box
    */
    /*Draggable option enaled for Device List box accordion container */
    $("#container_mycityswitches .draggable").draggable({
      cursor: "move",
      cursorAt: {
        top: -2,
        left: -2
      },
      helper: function(event) {
        return $(
          "<div class='box' style='border:1px solid gray; background-color:lightblue;width:200px'><i class='fa fa-plus'></i> &nbsp; " +
          $(this).data('devicename') +
          "</div>");
      }
    });

    
  });

  $(".map_region").click(function(marketid) {
    $("#marketname").val($(this).data('market')); 
    $("#market-region").text($(this).data('market')); 
    if($("#hidd_mylistid").length > 0){
    	$(location).attr("href","cellsitetech-dashboard.php?markets=" + $(this).data('market') + "&switchlistid=" + $("#hidd_mylistid").val()+"&action=editmylist");
    }else{
    	$(location).attr("href","cellsitetech-dashboard.php?markets=" + $(this).data('market'))
    }
  });

    // if ($.session.get('map_show_status') !== undefined) {
    //   if ($.session.get('map_show_status') == 'show') {
    //     show_hide_map_n_result('show');
    //   }
    //   else {
    //     show_hide_map_n_result('hide');
    //   }
    // }
    // else {
    //    show_hide_map_n_result('show');
    // }
  
  
  
  
  
  $("#dash-switches a").click(function(){
		$("#dash-switches .btn").html($(this).text());
		if($('#hidd_list_type').val() != 'market'){
			$('#hidd_list_for').val($(this).text());
		}
	  var selswitch = $('#dash-switches button').text();
		
      var default_pagelen = 14;
      if( $('#hidd_list_type').val() == 'market') {
        default_pagelen = 25;
      }
      var table =  $('#cellsitetech_user_devices').DataTable( {
          "processing": true,
          "lengthChange": true,
          "destroy": true,
          "lengthMenu": [ 5, 10, 11, 12, 14, 15, 20, 25, 30, 50, 75, 100 ],
          "pageLength": default_pagelen,
          "serverSide": true, 
          "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}],
          "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "No records found",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "",
            "infoFiltered": ""
            },
          "ajax":"cellsitetech-user-list-server-process.php?list_for="+$('#hidd_list_for').val()+"&list_type="+$('#hidd_list_type').val()+"&selswitch="+selswitch,
             "columns": [
            {  "className":  'device_row',
                "orderable":      false,
                "data":           null,
                "defaultContent": '<i class="fa fa-arrows-alt" aria-hidden="true"></i>'},
                { "data": "id", "visible": false },    
                { "data": "csr_site_tech_name" },            
                { "data": "csr_site_id" },
                { "data": "csr_site_name" }, 
                { "data": "devicename" },
                { "data": "deviceIpAddr" }
        ],
        
        "order": [[2, 'asc']],
        "createdRow": function (row, data, rowIndex) {
             // var r = row;
             // $(row).addClass('device_row'); 
             $(row).attr('data-devicename', data.devicename);
             $(row).attr('data-deviceid', data.id);

        }           
      });
	});
  
  
  
  
  
});

function reconstruct($item) {   

  return "<tr class=del_" + $item.data('deviceid') + ">" + "<td class='col-md-4'><i data-listid='" +  $('#hidd_mylistid').val() + "' data-deviceid='" + $item.data('deviceid') + "' data-devicename='" +  $item.data('devicename') + "' class='fa fa-arrows-alt draggable'></i>&nbsp;" + $item.data('deviceid') + "</td>" +
    "<td 'col-md-8'>" +  $item.data('devicename') + "</td></tr>";
}

function add_item_my_devices(userid, switchlistid, deviceid) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: 'usrfavlistedit.php',
    data: {
      'switchlistid': switchlistid,
      'deviceid': deviceid,
      'userid': userid,
      'operation': 'add'
    },
    success: function(data) { 
      var len = data.length;
      for (var i = 0; i < len; i++) {     
        var tr_str = "<tr class=del_" + data[i].nodeid + ">" + "<td align='center'>" + data[i].nodeid +
          "</td>" + "<td align='center'>" + '<i class="fa fa-trash" onclick="switchesdel(' +
          userid + ',' + switchlistid + ',' + data[i].nodeid + ');" width="22" height="22">' +
          "</td>" + "</tr>";
        $("#mydevicestbl").append(tr_str);
      }
    }
  });
}


function switchlistdel(userid, switchlistid) {
  if (confirm('Are you sure you want to delete list?')) {
    $.ajax({
      type: "POST",
      url: 'usrfavlistdel.php',
      data: {
        'switchlistid': switchlistid,
        'userid': userid
      },
      success: function() {
        $(location).attr("href", 'cellsitetech-dashboard.php'); 
      }
    });
  }
}

function switchesdel(userid, listid, switchid) { 
  if (confirm('Are you sure you want to delete device?')) {
    $.ajax({
      type: "POST",
      url: 'usrfavswitchdel.php',
      data: {
        'userid': userid,
        'listid': listid,
        'switchid': switchid
      },
      success: function() {
        $('.del_' + switchid).remove();
      }
    })
  }
}

function hideMap() {

  $( "#cellsitetech_user_devices_length" ).find('select').val('25').trigger('change')
  show_hide_map_n_result('hide');
  setHeight();
  // $.session.set('map_show_status', 'hide');
}

function showMap() {
  $( "#cellsitetech_user_devices_length" ).find('select').val('14').trigger('change')
  show_hide_map_n_result('show');
  setHeight();
  // $.session.set('map_show_status', 'show');
}


function show_hide_map_n_result(show_status) {

  if (show_status == 'show'){
    $('.sec_without_map').hide();
    $('.sec_with_map').show();    
  }
  else {
    $('.sec_with_map').hide();
    $('.sec_without_map').show();
  }
}
/**
    *  Drag and Drop devices to my device list box
    */
    /*Draggable option enaled for Device List box accordion container */
    $("#container_mymarketswitches .draggable").draggable({
      cursor: "move",
      cursorAt: {
        top: -2,
        left: -2
      },
      helper: function(event) {
        return $(
          "<div class='box' style='border:1px solid gray; background-color:lightblue;width:200px'><i class='fa fa-plus'></i> &nbsp; " +
          $(this).data('devicename') +
          "</div>");
      }
    });


function setHeight() {

    $('.myswlist tbody').height(function(index, height) {
      // alert($(this).offset().top);

    return window.innerHeight - $(this).offset().top + 215;
    }); 

 
} 