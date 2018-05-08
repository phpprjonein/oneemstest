<!DOCTYPE html>
<html>
<head>
 <?php //include_once("includes.php");  ?>
<meta name="viewport" content="width=device-width, initial-scale=1"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"> </script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"> </script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
<style>
* {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 300px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>
<script >
/*
$(document).ready(function() {
	    alert('inside1');
		if($('#swdelvrybatchpro').length > 0){
		alert('inside2');
		//$('#ip-mgt-utils #ajax_loader').show();
         var table =  $('#swdelvrybatchpro').DataTable( {
          "processing": true,
          "serverSide": true,
          "ajax":"software-delivery-process.php",      
          "pageLength": 25,
          "dom": 'Bfrtip',
	      "buttons": [{extend: 'excelHtml5',text: '', titleAttr:'Excel',className:'dtexcelbtn'},{extend: 'pdfHtml5',titleAttr:'',className:'dtpdfbtn'},{extend: 'print',titleAttr:'',className:'dtprintbtn'}], 
            "language": {
            "lengthMenu": "Display _MENU_ records per page",
            "zeroRecords": "No records found",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "",
            "infoFiltered": ""
            },
          "columns": [
            {  "className":      'batch-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": "<input type='checkbox' id = 'batchchkbox' class='btn btn-primary' data-toggle='modal'>"},
			{ "data": "deviceIpAddr" },
            { "data": "systemname" },
			{ "data": "deviceseries" },
            { "data": "market" },
            { "data": "nodeVersion" },
        ],
        "order": [[4, 'asc']],
      } );
	}
});
*/
$(document).ready(function() {
    $('#example').DataTable( {
        "ajax": 'swdeliverydata.txt'
    } );
} );
</script>
</head>
<body>

<h2>Two Equal Columns</h2>

<div class="row">
<div class="column" style="background-color:#aaa;">
<form action="/html/tags/html_form_tag_action.cfm">
<fieldset class="form-group">
<label for="first_name">Device Series</label>
<select class="custom-select" id ="file_name">
<option selected>Choose Device Series</option>
<option value="1">Devise Series</option>
<option value="2">File2</option>
<option value="2">File2</option>
<option value="3">File3</option>
</select>
</fieldset>

<fieldset class="form-group">
<label for="first_name">OS Version</label>
<select class="custom-select" id ="os_version">
<option selected>Choose OS Version </option>
<option value="1">15.1</option>
<option value="2">15.2</option> 
</select>
</fieldset>
<fieldset class="form-group">
<label for="first_name">File Name</label>
<select class="custom-select" id ="file_name">
<option selected>Choose Filename</option>
<option value="1">File1</option>
<option value="2">File2</option>
<option value="2">File2</option>
<option value="3">File3</option>
</select>
</fieldset>
<button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
  <div class="column" style="background-color:#bbb;">
    <h2>Column 2</h2>

<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
  </div>
</div>
</body>
</html>
