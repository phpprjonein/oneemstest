$(document).ready(function() {
	var readOnlyLength = 0;
  if ($("#config_file_uploader").length > 0) {
    document.forms["config_file_uploader"].reset();
  }
  if ($("#wizard-75a3c2").length > 0) {
    document.forms["wizard-75a3c2"].reset();
  }

  // show bandwidth form fields class (.bandwidth) when dropdown changes to BW-Upgrade, else hide (.non-bandwidth)
  $(document).on(
    "change",
    "#cellsitech-generate-script .leftselector select#select_script_type",
    function(event) {
      if (this.value == "BW-Upgrade") {
        $(".bandwidth").show();
        $(".non-bandwidth").hide();
      } else {
        $(".non-bandwidth").show();
        $(".bandwidth").hide();
      }
      refresh_telco_interface();
    }
  );
  
  $(document).on('keypress, keydown', '#cellsitech-generate-script #select_device_name', function(event) {
    var $field = $(this);
    if ((event.which != 37 && (event.which != 39)) &&
      ((this.selectionStart < readOnlyLength) ||
        ((this.selectionStart == readOnlyLength) && (event.which == 8)))) {
      return false;
    }
  });
  
  $(document).on("input", "#cellsitech-generate-script #select_device_name", function(event) {
	  refresh_telco_interface();
  });
  
  $(document).on("change", "#cellsitech-generate-script #select_switch", function(event) {
	  if ($(this).val() != "" && $('#cellsitech-generate-script #select_script_type').val() == 'BW-Upgrade') {
		  $('#cellsitech-generate-script #select_device_name').val($(this).val());
	  }else{
		  $('#cellsitech-generate-script #select_device_name').val('');
	  }
      if ($('#cellsitech-generate-script #select_switch').val() != ""){
          	$.post("ip-mgt-process.php", {
              'calltype': "configtrigger",
              'select_switch' : $('#cellsitech-generate-script #select_switch').val(),
              'action': "GenerateScriptDeviceLoad"
            }).done(function(data) {
              if (data != "") {
              		readOnlyLength = data.length;
              		$('#cellsitech-generate-script #select_device_name').val(data);
              		refresh_telco_interface();	
              }
            });
          	$.post("ip-mgt-process.php", {
                'calltype': "configtrigger",
                'select_switch' : $('#cellsitech-generate-script #select_switch').val(),
                'action': "GenerateScriptTimezoneLoad"
              }).done(function(data) {
                if (data != "") {
                		$('#cellsitech-generate-script #Time-Zone').val(data);
                }
            });
          	
        	$.post("ip-mgt-process.php", {
        		'calltype': "configtrigger",
        		'select_switch' : $('#cellsitech-generate-script #select_switch').val(),
        		'action': "GenerateScriptLoadVlanEven",
        	  }).done(function(data) {
        		if (data != "") {
        			$('.VlanEven').html(data);
        		}
        	});
        	$.post("ip-mgt-process.php", {
        		'calltype': "configtrigger",
        		'select_switch' : $('#cellsitech-generate-script #select_switch').val(),
        		'action': "GenerateScriptLoadVlanOdd",
        	  }).done(function(data) {
        		if (data != "") {
        			$('.VlanOdd').html(data);
        		}
        	});
          	
          	
      }
  });

  $(document).on("change", "#cellsitech-generate-script .leftselector select", function(
    event
  ) {
    var filename = "";
    sep = "";
    $("#cellsitech-generate-script .leftselector select")
      .not("#select_switch")
      .each(function() {
        if ($(this).val() != "") {
          filename = filename + sep + $(this).val();
          sep = "_";
          $(this).removeClass("required");
        }
      });
    filename = filename.replace(/[^a-z0-9_-]/gi, "");
    if (filename != "") {
      //$('#template_info').removeClass('d-none');
      //$("#cellsitech-generate-script #template_info #filename').html(filename);
      //$("#cellsitech-generate-script #upload_filename').val(filename);
      $.post("ip-mgt-process.php", {
        calltype: "trigger",
        filename: filename,
        scripttype: $(".gscript1 #select_script_type").val(),
        action: "GenerateScript"
      }).done(function(data) {
        if (data != "") {
          $("#loadtemplates").html(data);
          $("#loadtemplates").removeClass("d-none");
          $("#template_info").removeClass("d-none");
          $("#template_info_act").removeClass("d-none");
        } else {
          $("#loadtemplates").addClass("d-none");
          $("#template_info").addClass("d-none");
          $("#template_info_act").addClass("d-none");
        }
      });
    } else {
      $("#loadtemplates").addClass("d-none");
      $("#template_info_act").addClass("d-none");
      $("#template_info").addClass("d-none");
    }
    return false;
  });

  jQuery("#cellsitech-generate-script #aliasName").on("input", function() {
    var filename = "";
    sep = "";
    $("#cellsitech-generate-script .leftselector select").each(function() {
      if ($(this).val() != "") {
        filename = filename + sep + $(this).val();
        sep = "_";
        $(this).removeClass("required");
      }
    });
    filename = filename.replace(/[^a-z0-9_-]/gi, "");
    if (filename != "") {
      $.post("ip-mgt-process.php", {
        calltype: "trigger",
        filename: filename,
        alias: $(this).val(),
        action: "GenerateScript"
      }).done(function(data) {
        if (data != "") {
          $("#loadtemplates").html(data);
          $("#loadtemplates").removeClass("d-none");
        } else {
          $("#loadtemplates").html(
            '<tr><td colspan="3">Template not found</td></tr>'
          );
        }
      });
    } else {
      $("#loadtemplates").addClass("d-none");
      $("#template_info").addClass("d-none");
    }
    return false;
  });

  //generate-script-delete
  $("body").on("click", ".generate-script-delete", function() {
    var filename = "";
    sep = "";
    $("#cellsitech-generate-script .leftselector select").each(function() {
      if ($(this).val() != "") {
        filename = filename + sep + $(this).val();
        sep = "_";
        $(this).removeClass("required");
      }
    });
    filename = filename.replace(/[^a-z0-9_-]/gi, "");
    if (filename != "") {
      $.post("ip-mgt-process.php", {
        calltype: "trigger",
        filename: filename,
        alias: $("#aliasName").val(),
        deltemp: $(this)
          .closest("tr")
          .find("td:eq(0)")
          .text(),
        action: "DelGenerateScript"
      }).done(function(data) {
        if (data != "") {
          $("#status").html("Template deleted successfully.<br/>");
          $("#loadtemplates").html(data);
          $("#loadtemplates").removeClass("d-none");
          $("#status").css("opacity", "");
          $("#status").addClass("alert-success");
          $("#status").show();
          window.setTimeout(function() {
            $(".alert")
              .fadeTo(500, 0)
              .slideUp(500, function() {
                $(this).hide();
              });
          }, 4000);
        } else {
          $("#loadtemplates").html(
            '<tr><td colspan="3">Template not found</td></tr>'
          );
        }
      });
    } else {
      $("#loadtemplates").addClass("d-none");
      $("#template_info").addClass("d-none");
    }

    return false;
  });

  $(document).on(
    "click",
    "#cellsitech-generate-script .generate-script-submit",
    function(event) {
      var req_err = false;
      $("#status").html("");

      if ($(".gscript1 #select_device_series").val() == "") {
        $(".gscript1 #status").html(
          "<strong>Error!</strong> Device Series field is required.<br/>"
        );
        $(".gscript1 #status").addClass("alert-danger");
        $(".gscript1 #status").show();
        $(".gscript1 #select_device_series").addClass("required");
        req_err = true;
      }
      if ($(".gscript1 #select_os_version").val() == "") {
        $(".gscript1 #status").append(
          "<strong>Error!</strong> Device Os Verion field is required.<br/>"
        );
        $(".gscript1 #status").addClass("alert-danger");
        $(".gscript1 #select_os_version").addClass("required");
        $(".gscript1 #status").show();
        req_err = true;
      }
      if (
        $(".gscript1 #select_purpose").val() == "Modification" &&
        $(".gscript1 #select_script_type").val() == "BW-Upgrade" &&
        $(".gscript1 #select_switch").val() == ""
      ) {
        $(".gscript1 #status").append(
          "<strong>Error!</strong> Select switch field is required.<br/>"
        );
        $(".gscript1 #status").addClass("alert-danger");
        $(".gscript1 #select_os_version").addClass("required");
        $(".gscript1 #status").show();
        req_err = true;
      }
      if ($(".gscript1 #select_purpose").val() != "Modification") {
        if ($(".gscript1 #select_switch").val() == "") {
          $(".gscript1 #status").append(
            "<strong>Error!</strong> Select switch field is required.<br/>"
          );
          $(".gscript1 #status").addClass("alert-danger");
          $(".gscript1 #select_os_version").addClass("required");
          $(".gscript1 #status").show();
          req_err = true;
        }
        if ($(".gscript1 #select_script_type").val() != "BW-Upgrade") {
          requiredFields = $("#cellsitech-generate-script").find(
            ".uservarsreq"
          );
          var allFieldsComplete = true;
          requiredFields.each(function(index) {
            if (this.value.length == 0) {
              $(this).addClass("requiredIncomplete");
              allFieldsComplete = false;
              $(this).addClass("required");
            } else {
              $(this).removeClass("requiredIncomplete");
            }
          });
          if (!allFieldsComplete) {
            $(".gscript1 #status").append(
              "<strong>Error!</strong> All user form variable values are required.<br/>"
            );
            $(".gscript1 #status").addClass("alert-danger");
            $(".gscript1 #status").show();
            req_err = true;
          }
        }
      }
      if (req_err) {
        $("#status").css("opacity", "");
        $("#status").addClass("alert-danger");
        $("#status").show();
        window.setTimeout(function() {
          $(".alert")
            .fadeTo(500, 0)
            .slideUp(500, function() {
              $(this).hide();
            });
        }, 4000);
        window.scrollTo(0, 0);
        return false;
      }
      return true;
    }
  );

  $(document).on("change", "#cellsitech-config select", function(event) {
    var filename = "";
    sep = "";
    $("#cellsitech-config select").each(function() {
      if ($(this).val() != "") {
        filename = filename + sep + $(this).val();
        sep = "_";
        $(this).removeClass("required");
      }
    });
    filename = filename.replace(/[^a-z0-9_-]/gi, "");
    if (filename != "") {
      $("#template_info").removeClass("d-none");
      var aliasName = "";
      if ($("#aliasName").val() != "") aliasName = "_" + $("#aliasName").val();

      $("#cellsitech-config #template_info #filename").html(
        filename + aliasName + "_" + $("#username").val()
      );
      $("#cellsitech-config #upload_filename").val(
        filename + aliasName + "_" + $("#username").val()
      );
    } else {
      $("#template_info").addClass("d-none");
    }
    return false;
  });
  jQuery("#cellsitech-config #aliasName").on("input", function() {
    var filename = "";
    sep = "";
    $("#cellsitech-config select").each(function() {
      if ($(this).val() != "") {
        filename = filename + sep + $(this).val();
        sep = "_";
        $(this).removeClass("required");
      }
    });
    filename = filename.replace(/[^a-z0-9_-]/gi, "");
    if (filename != "") {
      $("#template_info").removeClass("d-none");
      var aliasName = "";
      if ($("#aliasName").val() != "") aliasName = "_" + $("#aliasName").val();
      $("#cellsitech-config #template_info #filename").html(
        filename + aliasName + "_" + $("#username").val()
      );
      $("#cellsitech-config #upload_filename").val(
        filename + aliasName + "_" + $("#username").val()
      );
    } else {
      $("#template_info").addClass("d-none");
    }
    return false;
  });

  $(document).on("change", "#select_region", function(event) {
    $.post("ip-mgt-process.php", {
      type: "autocomplete",
      region: $("#select_region").val(),
      case: "refresh-market"
    }).done(function(data) {
      $("#select_market").html(data);
    });
    $.post("ip-mgt-process.php", {
      type: "autocomplete",
      region: $("#select_region").val(),
      market: $("#select_market").val(),
      case: "refresh-switch"
    }).done(function(data) {
      $("#select_switch_name").html(data);
    });
  });

  $(document).on("change", "#select_market", function(event) {
    $.post("ip-mgt-process.php", {
      type: "autocomplete",
      region: $("#select_region").val(),
      market: $("#select_market").val(),
      case: "refresh-switch"
    }).done(function(data) {
      $("#select_switch_name").html(data);
    });
  });

  $(document).on("click", "#cellsitech-config .config-submit", function(event) {
    var req_err = false;
    $("#cellsitech-config select.form-required").each(function() {
      if ($(this).val() == "") {
        $(this).addClass("required");
        req_err = true;
      } else {
        $(this).removeClass("required");
      }
    });
    if (req_err) {
      $("#status").html("");
      if ($("#select_device_series").val() == "") {
        $("#status").html(
          "<strong>Error!</strong> Device series field is required.<br/>"
        );
      }
      if ($("#select_os_version").val() == "") {
        $("#status").append(
          "<strong>Error!</strong> OS Version field is required.<br/>"
        );
      }
    }
    /*if($("#file").val() == ""){
        	$("#status").append("<strong>Error!</strong> File input field is required.<br/>");
        	req_err = true;
    	}else{
	        var allowedFiles = [".txt"];
	        var uploadfile = $("#file");
	        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
	        if (!regex.test(uploadfile.val().toLowerCase())) {
	        	req_err = true;
	        	$("#status").append("<strong>Error!</strong> Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.<br/>");
	        }
    	}*/
    if (req_err) {
      $("#status").css("opacity", "");
      $("#status").addClass("alert-danger");
      $("#status").show();
      window.setTimeout(function() {
        $(".alert")
          .fadeTo(500, 0)
          .slideUp(500, function() {
            $(this).hide();
          });
      }, 4000);
      return false;
    } else {
      $.post("ip-mgt-process.php", {
        type: "templduplicateschk",
        templname: $("#cellsitech-config #upload_filename").val()
      }).done(function(data) {
        if (data == "exist") {
          if (
            confirm(
              "Template already exist, Are you  sure do you want to overwrite it ?"
            )
          ) {
            $("#config_file_uploader").submit();
            return true;
          }
          return false;
        } else {
          $("#config_file_uploader").submit();
          return true;
        }
      });
    }
    return false;
  });

  /*
	$(document).on('change', '#cellsitech-config #file_process input[type="checkbox"]', function(e){
        if($(this).is(':checked')){
        	$('#file_process .form-non-editable-fields').hide();
        }else{
        	$('#file_process .form-non-editable-fields').show();
        }
    });
    $(document).on('click', "#config_file_uploader #config-submit", function(event) {
    	$('#main-status').hide();
    	var req_err = false;
    	if($("#file").val() == ""){
        	$("#status").html("<strong>Error!</strong> File input field is required.");
        	req_err = true;
    	}else{
	        var allowedFiles = [".txt"];
	        var uploadfile = $("#file");
	        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
	        if (!regex.test(uploadfile.val().toLowerCase())) {
	        	req_err = true;
	        	$("#status").html("<strong>Error!</strong> Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
	        }
    	}
        if(req_err){
        	$('#status').css("opacity","");
        	$("#status").addClass('alert-danger');
        	$("#status").show();
		    window.setTimeout(function() {
		        $(".alert").fadeTo(500, 0).slideUp(500, function(){
		            $(this).hide();
		        });
		    }, 4000);
        	return false;
        }

        return true;
    });
	*/
});

function refresh_telco_interface(){
	$.post("ip-mgt-process.php", {
		'calltype': "configtrigger",
		'select_switch' : $('#cellsitech-generate-script #select_switch').val(),
		'action': "GenerateScriptTelcoInterfaceLoadEven",
		'select_script_type' : $(".gscript1 #select_script_type").val(),
		'select_device_name' : $('#cellsitech-generate-script #select_device_name').val(),
	  }).done(function(data) {
		if (data != "") {
			$('.Telco-Interface-ASR9010-Even').html(data);
		}
	});
	$.post("ip-mgt-process.php", {
		'calltype': "configtrigger",
		'select_switch' : $('#cellsitech-generate-script #select_switch').val(),
		'action': "GenerateScriptTelcoInterfaceLoadOdd",
		'select_script_type' : $(".gscript1 #select_script_type").val(),
		'select_device_name' : $('#cellsitech-generate-script #select_device_name').val(),
	  }).done(function(data) {
		if (data != "") {
			$('.Telco-Interface-ASR9010-Odd').html(data);
		}
	});	
}