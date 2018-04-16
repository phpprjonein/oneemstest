$(document).ready(function() {
	$('#inputName').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "ip-mgt-process.php",
                data: 'type=autocomplete&category=name&query=' + query,            
                dataType: "json",
                type: "POST",
                success: function (data) {
					result($.map(data, function (index, value) {
						return index;
                    }));
                }
            });
        }
    });
});    