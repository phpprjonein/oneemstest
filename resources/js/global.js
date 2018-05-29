$(document).ready(function() {
	
	if( $('.has-datetimepicker').length ) 
	{
		$('.has-datetimepicker').datetimepicker();
	}
	
	if( $('.has-datepicker').length )
	{
		$('.has-datepicker').datetimepicker({format: 'DD/MM/YYYY'});
	} 
	window.ATL_JQ_PAGE_PROPS =  {
		"triggerFunction": function(showCollectorDialog) {
			//Requries that jQuery is available! 
			jQuery("#feedback-button").click(function(e) {
				alert('over here');
				e.preventDefault();
				showCollectorDialog();
			});
		}
	};
});