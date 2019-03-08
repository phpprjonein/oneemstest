$(document).ready(function() {
	  $(document).on("change", ".ems-inventory #select_region_list", function(event) {
	          	$.post("ip-mgt-process.php", {
	              'calltype': "inventorytrigger",
	              'select_region' : $('.ems-inventory #select_region_list').val(),
	              'action': "LoadMarketBoxValues"
	            }).done(function(data) {
	              if (data != "") {
	              		$('.ems-inventory #select_market_list').html(data);
	              }
	            });
	  });
	  
	  $(document).on("click","#show_files_act button",function(event) {
		  var req_err = false;
	      $("#status").html("");
	      
	      if ($(".ems-inventory #select_inventory_type").val() == "") {
	          $(".ems-inventory  #status").append("<strong>Error!</strong> Inventory Type field is required.<br/>");
	          $(".ems-inventory  #status").addClass("alert-danger");
	          $(".ems-inventory  #status").show();
	          $(".ems-inventory  #select_inventory_type").addClass("required");
	          req_err = true;
	      }
	      if ($(".ems-inventory #select_region_list").val() == "") {
	          $(".ems-inventory  #status").append("<strong>Error!</strong> Region field is required.<br/>");
	          $(".ems-inventory  #status").addClass("alert-danger");
	          $(".ems-inventory  #status").show();
	          $(".ems-inventory  #select_region_list").addClass("required");
	          req_err = true;
	      }
	      if ($(".ems-inventory #select_market_list").val() == "") {
	          $(".ems-inventory  #status").append("<strong>Error!</strong> Market field is required.<br/>");
	          $(".ems-inventory  #status").addClass("alert-danger");
	          $(".ems-inventory  #status").show();
	          $(".ems-inventory  #select_market_list").addClass("required");
	          req_err = true;
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
	        }else{
	          	$.post("ip-mgt-process.php", {
		              'calltype': "inventorytrigger",
		              'select_inventory_type' : $('.ems-inventory #select_inventory_type').val(),
		              'select_region' : $('.ems-inventory #select_region_list').val(),
		              'select_market' : $('.ems-inventory #select_market_list').val(),
		              'action': "LoadRegionMarketFiles"
		            }).done(function(data) {
		            	if (data != "") {
		              		$('#inventory-files tbody').html(data);
		              		$('#inventory-files').show();
		            	}
		            });
	        	
	        }
	        return true;
	  });
});