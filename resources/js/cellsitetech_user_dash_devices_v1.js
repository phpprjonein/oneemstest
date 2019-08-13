$(document).ready(function() {
  var allVals = [];	  
  $(document).on('change', '.selector', function(event) {
	  var tr = $(this).closest('tr');
	  var id = tr.attr('id').replace('row_',''); 
	  if($(this).is(':checked')){
		  if(jQuery.inArray(id, allVals ) == -1){ 
		  		allVals.push(id);
		  }
	  }else{
		  	allVals.splice($.inArray(id, allVals), 1);
	  }	
      $('#cbvals').val(allVals);
    });
	
  $("body").on("click", ".run_all_checks", function() {
    $thisdiv = $(this);
    $thidiv = $(".mydevicebox_" + $(this).data("deviceid"));

    var version = $(this).data("version");
    version = version
      .replace(/\(/g, "-")
      .replace(/\)/g, "-")
      .replace(/\./g, "-");

    var deviceseries = $(this).data("deviceseries");
    if (deviceseries == "ASR9K") {
      actionurl = "healthchk-asrninethousand-cellsitetech.php";
    } else if (deviceseries == "ASR3K") {
      actionurl = "healthchk-asrthreethousand-cellsitetech.php";
    } else if (deviceseries == "NCS5500") {
      actionurl = "healthchk-ncsfivefivezerozero-cellsitetech.php";
    } else if (deviceseries == "Nexus3K") {
      actionurl = "healthchk-nexus3k-cellsitetech.php";
    } else if (deviceseries == "NexusETRAN3K") {
      actionurl = "healthchk-nexusetran3k-cellsitetech.php";
    } else if (deviceseries == "StarOS") {
      actionurl = "healthchk-staros-cellsitetech.php";
    } else if (deviceseries == "SAR7705") {
      actionurl = "healthchk-nokiasevensevenzerofive-cellsitetech.php";
    } else {
      actionurl = "healthchk-cellsitetech.php";
    }
    $.ajax({
      type: "get",
      url: actionurl,
      data: {
        deviceid: $(this).data("deviceid"),
        userid: $(this).data("userid"),
        deviceseries: $(this).data("deviceseries"),
        version: version,
        "ajax-val-session": 1
      },
      beforeSend: function() {
        $("#detail_" + $thisdiv.data("deviceid") + " div").html(
          '<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>'
        );
      },
      complete: function() {
        $thisdiv.addClass("loaded");
      },
      success: function(resdata) {
        if (resdata == "redirectUser") {
          window.location.href = "index.php";
        } else {
          $("#detail_" + $thisdiv.data("deviceid") + " div").html(resdata);
        }
      }
    });
  });
  $("body").on("click", ".instant_run_all_checks", function() {
    $thisdiv = $(this);
    $thidiv = $(".mydevicebox_" + $(this).data("deviceid"));
    $.ajax({
      type: "get",
      url: "instant-healthchk-cellsitetech.php",
      data: {
        deviceid: $(this).data("deviceid"),
        userid: $(this).data("userid"),
        "ajax-val-session": 1
      },
      beforeSend: function() {
        $("#detail_" + $thisdiv.data("deviceid") + " div").html(
          '<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>'
        );
      },
      complete: function() {
        $thisdiv.addClass("loaded");
      },
      success: function(resdata) {
        if (resdata == "redirectUser") {
          window.location.href = "index.php";
        } else {
          $("#detail_" + $thisdiv.data("deviceid") + " div").html(resdata);
        }
      }
    });
  });
  $("body").on("click", "#health-chk-div-wrap .run_custom_checks", function() {
    var allVals = [];
    $(this)
      .parents("table:first")
      .children()
      .find("input[type=checkbox]:checked")
      .each(function(index) {
        allVals.push($(this).val());
      });

    if (allVals.length == 0) {
      var req_err = true;
      $("#health-chk-div-wrap #status").html("");
      $("#health-chk-div-wrap #status").css("opacity", "");
      $("#health-chk-div-wrap #status").html(
        "<strong>Error!</strong> Atleast one healthcheck should be selected."
      );
      $("#health-chk-div-wrap #status").addClass("alert-danger");
      $([document.documentElement, document.body]).animate(
        {
          scrollTop: $("#health-chk-div-wrap").offset().top - 100
        },
        500
      );
      $("#health-chk-div-wrap #status").show();
      if (req_err) {
        window.setTimeout(function() {
          $(".alert")
            .fadeTo(500, 0)
            .slideUp(500, function() {
              $(this).hide();
            });
        }, 4000);
        return false;
      }
    }

    $thisdiv = $(this);

    var version = $(this).data("version");
    version = version
      .replace(/\(/g, "-")
      .replace(/\)/g, "-")
      .replace(/\./g, "-");

    var deviceseries = $(this).data("deviceseries");
    if (deviceseries == "ASR9K") {
      actionurl = "healthchk-asrninethousand-cellsitetech-custom.php";
    } else if (deviceseries == "ASR3K") {
      actionurl = "healthchk-asrthreethousand-cellsitetech-custom.php";
    } else if (deviceseries == "NCS5500") {
      actionurl = "healthchk-ncsfivefivezerozero-cellsitetech-custom.php";
    } else if (deviceseries == "Nexus3K") {
      actionurl = "healthchk-nexus3k-cellsitetech-custom.php";
    } else if (deviceseries == "NexusETRAN3K") {
      actionurl = "healthchk-nexusetran3k-cellsitetech-custom.php";
    } else if (deviceseries == "StarOS") {
      actionurl = "healthchk-staros-cellsitetech-custom.php";
     } else if (deviceseries == "SAR7705") {
      actionurl = "healthchk-nokiasevensevenzerofive-cellsitetech-custom.php";
    } else {
      actionurl = "healthchk-cellsitetech-custom.php";
    }
    $.ajax({
      type: "get",
      url: actionurl,
      data: {
        deviceid: $(this).data("deviceid"),
        userid: $(this).data("userid"),
        category: allVals,
        deviceseries: $(this).data("deviceseries"),
        version: version,
        "ajax-val-session": 1
      },
      beforeSend: function() {
        $("#detail_" + $thisdiv.data("deviceid") + " div").html(
          '<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>'
        );
      },
      complete: function() {
        $thisdiv.addClass("loaded");
      },
      success: function(resdata) {
        if (resdata == "redirectUser") {
          window.location.href = "index.php";
        } else {
          $("#detail_" + $thisdiv.data("deviceid") + " div").html(resdata);
        }
      }
    });
  });

  $("body").on(
    "click",
    "#health-chk-div-wrap .run_preventive_checks",
    function() {
      $thisdiv = $(this);
      $.ajax({
        type: "get",
        url: "healthchk-cellsitetech-preventive.php",
        data: {
          deviceid: $(this).data("deviceid"),
          userid: $(this).data("userid"),
          "ajax-val-session": 1
        },
        beforeSend: function() {
          $("#detail_" + $thisdiv.data("deviceid") + " div").html(
            '<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>'
          );
        },
        complete: function() {
          $thisdiv.addClass("loaded");
        },
        success: function(resdata) {
          if (resdata == "redirectUser") {
            window.location.href = "index.php";
          } else {
            $("#detail_" + $thisdiv.data("deviceid") + " div").html(resdata);
          }
        }
      });
    }
  );

  var table = $("#example").DataTable({
    processing: true,
    serverSide: true,
    ajax: "swt-server-process.php?listid=" + $("#example").data("listid"),
    columnDefs: [
      {
        targets: 5,
        render: function(data, type, row, meta) {
          exploded = row["deviceIpAddr"].split("<br/>");
          var itemID = row[0];
          return (
            '<a data-ssh="' +
            $("#username").val() +
            "@PAMadmingrp@" +
            exploded[1] +
            '@pamssh.nsiam.vzwnet.com" data-sshna="' +
            $("#username").val() +
            "@PAMronlygrp@" +
            exploded[1] +
            '@pamssh.nsiam.vzwnet.com" class="link_device_name" href="#">' +
            data +
            "</a>"
          );
        }
      }
    ],
    pageLength: 25,
    dom: "Bfrtip",
    buttons: [
      {
        extend: "excelHtml5",
        text: "",
        titleAttr: "Excel",
        className: "dtexcelbtn",
        exportOptions: { columns: [2, 3, 4, 5, 6, 7, 8, 10] }
      },
      {
        extend: "pdfHtml5",
        titleAttr: "",
        className: "dtpdfbtn",
        exportOptions: { columns: [2, 3, 4, 5, 6, 7, 8, 10] }
      },
      {
        extend: "print",
        titleAttr: "",
        className: "dtprintbtn",
        exportOptions: { columns: [2, 3, 4, 5, 6, 7, 8, 10] }
      }
    ],
    language: {
      lengthMenu: "Display _MENU_ records per page",
      zeroRecords: "No records found",
      info: "Showing page _PAGE_ of _PAGES_",
      infoEmpty: "",
      infoFiltered: ""
    },
    columns: [
    	{  "className":      'batch-control',
            "orderable":      false,
            "data":           null,
            "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal'>"},	 	
      {
        className: "details-control",
        orderable: false,
        data: null,
        defaultContent: ""
      },
      { data: "id", visible: false },
      { data: "csr_site_id" },
      { data: "csr_site_name" },
      { data: "devicename" },
      { data: "deviceIpAddr" },
      { data: "market" },
      { data: "deviceseries" },
      { data: "nodeVersion" },
      { data: "status", className: "d-none" },
      { data: "lastpolled" }
    ],
    order: [[3, "asc"]],
    createdRow: function(row, data, rowIndex) {
      $(row).addClass("device_row");
      $.each($("td", row), function(colIndex) {
     	 if(colIndex == 0){
     		 if(jQuery.inArray($(this).closest('tr').attr('id').replace('row_',''), allVals ) == -1){
     			 $(this).html("<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal'>");
     		 }else{
     			 $(this).html("<input type='checkbox' id = 'batchchkbox' class='btn btn-primary selector' data-toggle='modal' checked='checked'>");
     		 }
     	 }
        if (colIndex == 1) $(this).attr("title", "Click here for health check");
        if (colIndex == 9) {
          status = $(this).text();
          $(this).attr("class", "d-none");
        }
        if (colIndex == 10 && status == 1) {
          $(this).attr("class", "device-red");
        }
      });
    }
  });

  $(".dt-buttons").append(
    '<a class="dt-button buttons-excel buttons-html5 dtexcelbtn dtexcelbtn-cs" tabindex="0" aria-controls="example"><span></span></a>'
  );

  $("#example tbody").on("click", "td.details-control", function() {
    var tr = $(this).closest("tr");
    var row = table.row(tr);
    var current_click_row = row.child.isShown();

    $("tr.device_row").each(function() {
      var orow = table.row(this);
      if (orow.child.isShown()) {
        orow.child.hide();
        $(this).removeClass("shown");
      }
    });

    if (row.child.isShown()) {
      row.child.hide();
      tr.removeClass();
    } else {
      if (!current_click_row) {
        row.child(format(tr.attr("id"))).show();
        tr.addClass("shown");
        var id = tr.attr("id").replace("row_", "");

        var deviceseries = $(this)
          .closest("tr")
          .find("td:eq(7)")
          .text();
        var version = $(this)
          .closest("tr")
          .find("td:eq(8)")
          .text();
        version = version
          .replace(/\(/g, "-")
          .replace(/\)/g, "-")
          .replace(/\./g, "-");
        var actionurl = "";

        if (deviceseries == "ASR9K") {
          actionurl = "healthchk-asrninethousand-load-table-data.php";
        } else if (deviceseries == "ASR3K") {
          actionurl = "healthchk-asrthreethousand-load-table-data.php";
        } else if (deviceseries == "NCS5500") {
          actionurl = "healthchk-ncsfivefivezerozero-load-table-data.php";
        } else if (deviceseries == "Nexus3K") {
          actionurl = "healthchk-nexus3k-load-table-data.php";
        } else if (deviceseries == "NexusETRAN3K") {
          actionurl = "healthchk-nexusetran3k-load-table-data.php";
        } else if (deviceseries == "StarOS") {
          actionurl = "healthchk-staros-load-table-data.php";
        } else if (deviceseries == "SAR7705") {
          actionurl = "healthchk-nokiasevensevenzerofive-load-table-data.php";
        } else {
          actionurl = "healthchk-load-table-data.php";
        }
        var ajs = $.ajax({
          type: "get",
          url: actionurl,
          data: {
            deviceid: id,
            userid: $("#userid").val(),
            deviceseries: deviceseries,
            version: version,
            "ajax-val-session": 1
          },
          beforeSend: function() {
            $("#detail_" + id).html(
              '<div class="text-center overlay box-body">Running Health Checks. Takes several minutes... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>'
            );
          },
          complete: function() {
            $("#detail_" + id).addClass("loaded");
          },
          success: function(resdata) {
            if (resdata == "redirectUser") {
              window.location.href = "index.php";
            } else {
              $("#detail_" + id).html(resdata);
            }
          }
        });
      }
    }
  });

  $(document).on("click", ".dtexcelbtn-cs", function(event) {
    var sortInfo = $("#example")
      .dataTable()
      .fnSettings().aaSorting;
    location.href =
      "xls-export-process.php?case=healthcheck&userid=" +
      $("#userid").val() +
      "&listid=" +
      $("#listid").val() +
      "&search=" +
      $(".dataTables_filter input").val() +
      "&column=" +
      sortInfo[0][0] +
      "&dir=" +
      sortInfo[0][1];
    return false;
  });



  $(document).on("click", ".link_device_name", function(event) {
	    var myModal = $("#Modal_Device_Name");
	    $("#Modal_Device_Name .modal-title").html("SSH Command");
	    //$('#Modal_Device_Name .modal-body').html($(this).data('ssh'));
	    exploded = $(this).closest('tr').find('td:eq(4)').html();
	    exploded = exploded.split("<br>");
	    
	    $("#Modal_Device_Name .modal-body").html(
	      '<div class="table-responsive"><table class="table"><tr><td><input type="text" class="form-control" size="100" name="textbox" id="textboxp1" readonly value="' +
	        $(this)
	          .data("ssh")
	          .replace(/:/gi, "-") +
	        '" ></td><td><button class="btn btn-default" onclick="copyToClipboard(\'textboxp1\')">Copy</button></td><td><a target="blank" class="align-text-bottom link_device_name_popup" href="ssh://' + $(this).data("ssh").replace(/:/gi, "-") + '">Open&nbsp;SSH</a></td></tr></table></div>'
	    );
	    $("#Modal_Device_Name .modal-body").append(
	      '<div class="table-responsive"><table class="table"><tr><td><input type="text" class="form-control" size="100" name="textbox" id="textboxp2" readonly value="' +
	        $(this)
	          .data("sshna")
	          .replace(/:/gi, "-") +
	        '" ></td><td><button class="btn btn-default" onclick="copyToClipboard(\'textboxp2\')">Copy</button></td><td><a target="blank" class="link_device_name_popup" href="ssh://' + $(this).data("ssh").replace(/:/gi, "-") + '">Open&nbsp;SSH</a></td></tr></table></div>'
	    );
	    myModal.modal("show");
	    return false;
	  });

	$(document).on('click', '#multi-device-healthcheck', function(event) {
		var req_err = false;
		var allVals = $('#cbvals').val().split(',');
		$('#multidevicehc #status').html('');
		$('#multidevicehc #status').css("opacity","");
    	
    	if(allVals.length > 5){
    		$('#multidevicehc #status').append("<strong>Error!</strong> Can't select more than 5 Devices");
        	req_err = true;	
    	}
		if(req_err){ 
			$('#multidevicehc #status').show();
			$('#multidevicehc #status').addClass('alert-danger');
			window.scrollTo(0, 0);
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide(); 
		        });
		    }, 4000);
			return false;
		}
		$('.device_row').removeClass('device_row_green device_row_red');
		$.each(allVals, function( index, value ) {
			  var version = $('#row_'+value).find("td:eq(8)").text();;
			  version = version
			      .replace(/\(/g, "-")
			      .replace(/\)/g, "-")
			      .replace(/\./g, "-");
			  var deviceseries = $('#row_'+value).find("td:eq(7)").text();
			      if (deviceseries == "ASR9K") {
			        actionurl = "healthchk-asrninethousand-cellsitetech.php";
			      } else if (deviceseries == "ASR3K") {
			        actionurl = "healthchk-asrthreethousand-cellsitetech.php";
			      } else if (deviceseries == "NCS5500") {
			        actionurl = "healthchk-ncsfivefivezerozero-cellsitetech.php";
			      } else if (deviceseries == "Nexus3K") {
			        actionurl = "healthchk-nexus3k-cellsitetech.php";
			      } else if (deviceseries == "NexusETRAN3K") {
			        actionurl = "healthchk-nexusetran3k-cellsitetech.php";
			      } else if (deviceseries == "StarOS") {
			        actionurl = "healthchk-staros-cellsitetech.php";
			      } else if (deviceseries == "SAR7705") {
			        actionurl = "healthchk-nokiasevensevenzerofive-cellsitetech.php";
			      } else {
			        actionurl = "healthchk-cellsitetech.php";
			      }
			      //alert(version + ' - ' + deviceseries + ' - ' + actionurl + ' - ' + value);
			      
			      $.ajax({
			          type: "get",
			          url: actionurl,
			          data: {
			            'deviceid': value,
			            'userid': $('#userid').val(),
			            'deviceseries': deviceseries,
			            'version': version,
			            'ajax-val-session': 1,
			            'resultversion':'short',
			            
			          },
			          success: function(resdata) {
			            if (resdata == "redirectUser") {
			              window.location.href = "index.php";
			            } else {
		            		if(resdata == 'Reached'){
		            			$('#row_'+value).addClass('device_row_green');
		            		}else{
		            			$('#row_'+value).addClass('device_row_red');
		            		}
			            }
			          }
			        });
		});
		return false;
		//if(confirm("Are you sure, do you want to do healthcheck of selected devices ?")){
		
		$.ajax({
            type:"post",
            url:"multi-device-hc-process.php?loadtype=healthchecknew",
            data: {'loadtype':'healthcheck', 'devices':allVals}, 
            success: function(resdata){
            	var obj = jQuery.parseJSON( resdata );
            	console.log(obj.result);

            	$.each(obj.result, function(idx, obj) {
            		//alert(obj.deviceid + '  ' + obj.error);
            		$('#row_'+obj.deviceid).removeClass('device_row_green device_row_red');
            		if(obj.error == 'Reached'){
            			$('#row_'+obj.deviceid).addClass('device_row_green');
            		}else{
            			$('#row_'+obj.deviceid).addClass('device_row_red');
            		}
            	});
            }
        });
		

		//}
	return false;
}); 
  
  
  $(document).on("click", ".paginate_button", function(event) {
	  allVals = []
	  $('#cbvals').val('');
	  return false;
  });
  $(document).on("click", ".auditLog", function(event) {
    var myModal = $("#healthpageModel");
    $("#healthpage .modal-body").html("");
    var sel = $(this)
      .closest("tr")
      .attr("id");
    $.post("api-test.php", { type: "api-ajax" }).done(function(data) {
      $("#" + sel + " button").removeClass("btn");
      $("#" + sel + " button").removeClass("btn-danger");
      $("#" + sel + " button").removeClass("btn-success");
      var obj = jQuery.parseJSON(data);
      if (obj.result == true) {
        myModal.find(".modal-body").html("<h3>Successful</h3>");
        $("#" + sel + " button").addClass("btn-success");
      } else {
        myModal.find(".modal-body").html("<h3>Failed</h3>");
        $("#" + sel + " button").addClass("btn-danger");
      }
      $("#healthpage #healthpageModel").modal("show");
    });
    return false;
  });

  $(document).on("click", "#backuprestore tbody td.details-control", function(
    event
  ) {
    var table = $("#backuprestore").DataTable();
    var tr = $(this).closest("tr");
    var row = table.row(tr);
    var current_click_row = row.child.isShown();

    $("tr.device_row").each(function() {
      var orow = table.row(this);
      if (orow.child.isShown()) {
        orow.child.hide();
        $(this).removeClass("shown");
      }
    });

    if (row.child.isShown()) {
      row.child.hide();
      tr.removeClass();
    } else {
      if (!current_click_row) {
        row.child(format(tr.attr("id"))).show();
        tr.addClass("shown");
        var id = tr.attr("id").replace("row_", "");
        var ajs = $.ajax({
          type: "get",
          data: {
            deviceid: id,
            userid: $("#userid").val(),
            devicename: $(this)
              .closest("tr")
              .find("td:eq(1)")
              .text(),
            region: $(this)
              .closest("tr")
              .find("td:eq(4)")
              .text(),
            market: $(this)
              .closest("tr")
              .find("td:eq(5)")
              .text()
          },
          data: { deviceid: id, userid: $("#userid").val() },
          beforeSend: function() {
            $("#detail_" + id).html(
              '<div class="text-center overlay box-body">Running Health Checks. Takes several minutes...<div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>'
            );
          },
          complete: function() {
            $("#detail_" + id).addClass("loaded");
          },
          success: function(resdata) {
            $("#detail_" + id).html(resdata);
          }
        });
      }
    }
  });
});
$(document).keydown(function(event) {
  if (event.keyCode == 27) {
    $("#mycmdModal")
      .find("button.close")
      .trigger("click");
  }
});
function format(d) {
  var id = d.replace("row_", "");
  return "<div id='detail_" + id + "'></div>";
}
function copyToClipboard(id) {
  /* Get the text field */
  var copyText = document.getElementById(id);
  /* Select the text field */
  copyText.select();
  /* Copy the text inside the text field */
  document.execCommand("copy");
  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}