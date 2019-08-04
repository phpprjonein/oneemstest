$(document).ready(function() {
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
    //alert('ONE ' + $('#sso_session_life').val());
    /*  Only when SSO is active or for SSO idle time out testing needs to be uncommented
		if($('#sso_session_life').val() <= Math.trunc($.now()/1000)){
        	window.location.href = 'index.php';
        }
		*/
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
    //alert('TWO ' + $('#sso_session_life').val());
    /*  Only when SSO is active or for SSO idle time out testing needs to be uncommented
        if($('#sso_session_life').val() <= Math.trunc($.now()/1000)){
        	window.location.href = 'index.php';
        }
		*/
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
    //alert('THREE ' + $('#sso_session_life').val());
    /*  Only when SSO is active or for SSO idle time out testing needs to be uncommented
        if($('#sso_session_life').val() <= Math.trunc($.now()/1000)){
        	window.location.href = 'index.php';
        }
		*/
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
      //alert('FOUR ' + $('#sso_session_life').val());
      /*  Only when SSO is active or for SSO idle time out testing needs to be uncommented
        if($('#sso_session_life').val() <= Math.trunc($.now()/1000)){
        	window.location.href = 'index.php';
        }
		*/
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
        targets: 4,
        render: function(data, type, row, meta) {
          //console.log(row['deviceIpAddr']);
          exploded = row["deviceIpAddr"].split("<br/>");
          //console.log(exploded[0]);
          // $('#username').val('njbbcpnebh');
          //$('#username').val('debarle');
          //return '<a target="blank" href="ssh://' + $('#username').val() + '@'+exploded[0]+'">'+data +'</a>';
          //return data;

          var itemID = row[0];
          //return '<a target="blank" href="/cfcs/blah.cfc?item_id=' + itemID + '">' + data + '</a>';
          //	return '<a target="blank" href="ssh://' + $('#username').val() + '@10.198.238.19">' + 	data +'</a>';
          // ssh debarle@PAMadmin@AKROOH20T1A-C-PI-9999-01@pamssh-stage.nsiam.vzwnet.com
          //return '<a target="blank" href="ssh://' + $('#username').val() + '@10.202.96.191">' + 	data +'</a>';
          //return '<a target="blank" class="link_device_name" href="ssh://' + $('#username').val() + '@PAMadmingrp@2001-4888-2a31-b000-386-400-0-5@pamssh-stage.nsiam.vzwnet.com">' + data +'</a>'; //Correct -New format
          //return '<a data-ssh="ssh://' + $('#username').val() + '@'+exploded[1]+'" class="link_device_name" href="#">' + data +'</a>'; //Correct -New format
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
          ); //Correct -New format
          // return '<a target="blank" href="ssh://' + $('#username').val() + '@PAMadmin-AKROOH20T1A-C-PI-9999-01-pamssh-stage.nsiam.vzwnet.com:22">' + data +'</a>';
          //return '<a target="blank" href="ssh://' + $('#username').val() + '@PAMadmin#AKROOH20T1A-C-PI-9999-01#pamssh-stage.nsiam.vzwnet.com">' + data +'</a>';
          //return '<a target="blank" href="chrome-extension://iodihamcpbpeioajjeobimgagajmlibd/html/nassh.html#">'+ data + '</a>';
        }
      },{
        targets: 5,
        render: function(data, type, row, meta) {
          exploded = row["deviceIpAddr"].split("<br/>");
          return (
            '<a class="link_device_ips" href="ssh://' + $('#username').val() + '@'+ exploded[0] +'">' +
            exploded[0] +
            '</a><br><a class="link_device_ips" href="ssh://' + $('#username').val() + '@'+ exploded[1] +'">' +
            exploded[1] +
            '</a>'
          );       }
      }
    ],
    pageLength: 25,
    //"dom": 'lBfrtip',
    dom: "Bfrtip",
    //"buttons": [{extend: 'collection',text: 'Export', buttons: ['excel','pdf','print']}],
    /* "buttons": [ 'excel','pdf','print'],
            "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "No records found",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "",
            "infoFiltered": ""
            },
*/
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
      //{"render": function (data, type, full, meta) { return '<a href="ab.aspx?emp_id=' + data + '">"' + data + '"</a>'; } },
      { data: "market" },
      { data: "deviceseries" },
      { data: "nodeVersion" },
      { data: "status", className: "d-none" },
      { data: "lastpolled" }
      /*{
                "className":      'center',
                "orderable":      false,
                "data":           null,
                "defaultContent": "<button type='button' class='btn btn-sm auditLog' data-toggle='modal'>Audit Log</button>",
    			} */
    ],
    order: [[1, "asc"]],
    // Per-row function to iterate cells
    createdRow: function(row, data, rowIndex) {
      $(row).addClass("device_row");
      $.each($("td", row), function(colIndex) {
        if (colIndex == 0) $(this).attr("title", "Click here for health check");
        if (colIndex == 8) {
          status = $(this).text();
          $(this).attr("class", "d-none");
        }
        if (colIndex == 9 && status == 0) {
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
      // alert(orow.child.isShown());
      if (orow.child.isShown()) {
        // This row is already open - close it
        orow.child.hide();
        $(this).removeClass("shown");
      }
    });

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide();
      tr.removeClass();
    } else {
      // Open this row
      // alert(tr.attr('id'));
      if (!current_click_row) {
        row.child(format(tr.attr("id"))).show();
        tr.addClass("shown");
        var id = tr.attr("id").replace("row_", "");

        var deviceseries = $(this)
          .closest("tr")
          .find("td:eq(6)")
          .text();
        var version = $(this)
          .closest("tr")
          .find("td:eq(7)")
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
        //alert('FIVE ' + $('#sso_session_life').val());
        /*  Only when SSO is active or for SSO idle time out testing needs to be uncommented
                  if($('#sso_session_life').val() <= Math.trunc($.now()/1000)){
                  	window.location.href = 'index.php';
                  }
				  */
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
        /*ajs = $.ajax({
                      type:"get",
                      url:"healthchk-cellsitetech.php",
                      data: {deviceid:id, userid:$('#userid').val()},
                      beforeSend: function(){
                          $('#detail_'+id).html('<div class="text-center overlay box-body">Loading... <div class="fa fa-refresh fa-spin" style="font-size:24px; text-align:center;"></div></div>');
                      },
                      complete: function() {
                          $('#detail_'+id).addClass('loaded');
                      },
                      success: function(resdata){
                          $('#detail_'+id).html(resdata);
                      }
                  });*/
      }
    }
  });

  $(document).on("click", ".dtexcelbtn-cs", function(event) {
    var sortInfo = $("#example")
      .dataTable()
      .fnSettings().aaSorting;
    //console.log(sortInfo[0][0] + '         ' + sortInfo[0][1]);
    //console.log("xls-export-process.php?userid=" + $('#userid').val() + "&listid=" + $('#listid').val() + "&search=" + $('.dataTables_filter input').val() + "&column=" + sortInfo[0][0] + "&dir=" + sortInfo[0][1]);
    //return false;
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

  if ($("#backuprestore").length > 0) {
    //$('#ip-mgt-utils div').hide();
    $("#ip-mgt-utils #ajax_loader").show();
    var table = $("#backuprestore").DataTable({
      processing: true,
      serverSide: true,
      ajax: "switchtech-server-backuprestoreprocess.php",
      pageLength: 25,
      dom: "Bfrtip",
      buttons: [
        {
          extend: "excelHtml5",
          text: "",
          titleAttr: "Excel",
          className: "dtexcelbtn"
        },
        { extend: "pdfHtml5", titleAttr: "", className: "dtpdfbtn" },
        { extend: "print", titleAttr: "", className: "dtprintbtn" }
      ],
      language: {
        lengthMenu: "Display _MENU_ records per page",
        zeroRecords: "No records found",
        info: "Showing page _PAGE_ of _PAGES_",
        infoEmpty: "",
        infoFiltered: ""
      },
      columns: [
        {
          className: "details-control",
          orderable: false,
          data: null,
          defaultContent: ""
        },
        { data: "devicename" },
        { data: "csr_site_id" },
        { data: "csr_site_name" },
        { data: "region" },
        { data: "market" },
        { data: "deviceseries" },
        { data: "nodeVersion" },
        {
          className: "center",
          data: null,
          defaultContent:
            "<button type='button' id = 'backupbtn' class='btn btn-primary' data-toggle='modal' data-target='#backupModal' data-remote='remote-page.html'>Backup </button>"
          // "defaultContent":   "<input id='btnDetails' class='btn btn-success' width='25px' value='Get Details' />"
        }
      ],
      order: [[1, "asc"]],
      createdRow: function(row, data, rowIndex) {
        $(row).addClass("device_row");
        $.each($("td", row), function(colIndex) {
          if (colIndex == 0)
            $(this).attr("title", "Click here for health check");
        });
      }
    });
  }

  $("#backup-restore-list-dt-filter a").click(function() {
    $("#backup-restore-list-dt-filter .btn").html($(this).text());
    var listname = "";
    if ($(this).text() != "My List") {
      listname = $(this).text();
    }

    var table = $("#backuprestore").DataTable({
      processing: true,
      serverSide: true,
      ajax: "switchtech-server-backuprestoreprocess.php?listname=" + listname,
      pageLength: 25,
      dom: "Bfrtip",
      destroy: true,
      buttons: [
        {
          extend: "excelHtml5",
          text: "",
          titleAttr: "Excel",
          className: "dtexcelbtn"
        },
        { extend: "pdfHtml5", titleAttr: "", className: "dtpdfbtn" },
        { extend: "print", titleAttr: "", className: "dtprintbtn" }
      ],
      language: {
        lengthMenu: "Display _MENU_ records per page",
        zeroRecords: "No records found",
        info: "Showing page _PAGE_ of _PAGES_",
        infoEmpty: "",
        infoFiltered: ""
      },
      columns: [
        {
          className: "details-control",
          orderable: false,
          data: null,
          defaultContent: ""
        },
        { data: "devicename" },
        { data: "csr_site_id" },
        { data: "csr_site_name" },
        { data: "region" },
        { data: "market" },
        { data: "deviceseries" },
        { data: "nodeVersion" },
        {
          className: "center",
          data: null,
          defaultContent:
            "<button type='button' id = 'backupbtn' class='btn btn-primary' data-toggle='modal' data-target='#backupModal' data-remote='remote-page.html'>Backup </button>"
        }
      ],
      order: [[1, "asc"]],
      createdRow: function(row, data, rowIndex) {
        $(row).addClass("device_row");
        $.each($("td", row), function(colIndex) {
          if (colIndex == 0)
            $(this).attr("title", "Click here for health check");
        });
      }
    });
  });

  $(document).on("click", "#back_res #restorebtn", function(event) {
    //alert('Restore button is clicked');
    //$('#myModal #bkup-fileid').html($(this).closest('tr').find("td:eq(0)").text() + '<br/><h6><b><span id ="restoremoddet"> Taken at: ' + $(this).closest('tr').find("td:eq(1)").text() + ', Type: ' + $(this).closest('tr').find("td:eq(2)").text() + '</span><b></h6>');
    $("#myModal #bkup-fileid").html(
      $(this)
        .closest("tr")
        .find("td:eq(0)")
        .text()
    );

    $.post("restore-api-test.php", { type: "api-ajax" }).done(function(data) {
      $("#myModal .modal-body").html(data);
    });

    //alert("as" + $(this).closest('tr').find("td:eq(1)").text() +  $(this).closest('tr').find("td:eq(0)").text());
  });

  $(document).on("click", "#backupbtn", function(event) {
    $("#backupModal .modal-body").html("");
    $("#backupModal #bkup-deviceid").html(
      '<br/><h6> <b><span id ="backupmoddet"> Device Name:' +
        $(this)
          .closest("tr")
          .find("td:eq(1)")
          .text() +
        "</span><b></h6>"
    );
    //$('#backupModal #bkup-deviceid').html('Device Id:');
    $.post("backup-api-process.php", {
      type: "api-ajax",
      deviceid: $(this)
        .closest("tr")
        .attr("id")
        .replace("row_", "")
    }).done(function(data) {
      $("#backupModal .modal-body").html(data);
    });

    //alert("as" + $(this).closest('tr').find("td:eq(1)").text() +  $(this).closest('tr').find("td:eq(0)").text());
  });

  $(document).on("click", ".link_device_name", function(event) {
    var myModal = $("#Modal_Device_Name");
    $("#Modal_Device_Name .modal-title").html("SSH Command");
    //$('#Modal_Device_Name .modal-body').html($(this).data('ssh'));
    $("#Modal_Device_Name .modal-body").html(
      '<div class="input-group mb-3"><input type="text" class="form-control" size="100" name="textbox" id="textboxp1" readonly value="' +
        $(this)
          .data("ssh")
          .replace(/:/gi, "-") +
        '" >&nbsp;<button class="btn btn-default" onclick="copyToClipboard(\'textboxp1\')">Copy</button></div><div><a target="blank" class="link_device_name_popup" href="ssh://' + $('#username').val() + '@PAMadmingrp@2001-4888-2a31-b000-386-400-0-5@pamssh.nsiam.vzwnet.com">ssh://' + $('#username').val() + '@PAMadmingrp@2001-4888-2a31-b000-386-400-0-5@pamssh.nsiam.vzwnet.com</a></div>'
    );
    $("#Modal_Device_Name .modal-body").append(
      '<hr><br><br><div class="input-group mb-3"><input type="text" class="form-control" size="100" name="textbox" id="textboxp2" readonly value="' +
        $(this)
          .data("sshna")
          .replace(/:/gi, "-") +
        '" >&nbsp;<button class="btn btn-default" onclick="copyToClipboard(\'textboxp2\')">Copy</button></div><div><a target="blank" class="link_device_name_popup" href="ssh://' + $('#username').val() + '@PAMronlygrp@2001-4888-2a31-b000-386-400-0-5@pamssh.nsiam.vzwnet.com">ssh://' + $('#username').val() + '@PAMronlygrp@2001-4888-2a31-b000-386-400-0-5@pamssh.nsiam.vzwnet.com</a></div>'
    );
    myModal.modal("show");
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

    /*$.post( "backup-api-process.php", { type: "api-ajax", deviceid: $(this).closest('tr').attr('id').replace('row_','')
					}).done(function( data ) {
						$('#backupModal .modal-body').html(data);
					});
				  	*/
    //alert("as" + $(this).closest('tr').find("td:eq(1)").text() +  $(this).closest('tr').find("td:eq(0)").text());
  });

  $(document).on("click", "#backuprestore tbody td.details-control", function(
    event
  ) {
    //$('#backuprestore tbody').on('click', 'td.details-control', function () {
    var table = $("#backuprestore").DataTable();
    var tr = $(this).closest("tr");
    var row = table.row(tr);
    var current_click_row = row.child.isShown();

    $("tr.device_row").each(function() {
      var orow = table.row(this);
      // alert(orow.child.isShown());
      if (orow.child.isShown()) {
        // This row is already open - close it
        orow.child.hide();
        $(this).removeClass("shown");
      }
    });

    if (row.child.isShown()) {
      // This row is already open - close it
      row.child.hide();
      tr.removeClass();
    } else {
      // Open this row
      // alert(tr.attr('id'));
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
