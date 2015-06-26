(function($) {
$(document).ready(function() {
$('#cssmenu').prepend('<div id="menu-button">Menu</div>');
	$('#cssmenu #menu-button').on('click', function(){
		var menu = $(this).next('ul');
		if (menu.hasClass('open')) {
			menu.removeClass('open');
		}
		else {
			menu.addClass('open');
		}
	});
});
})(jQuery);

//table filtering
$(function(){
  $('#searchf').keyup(function(){
    var val = $(this).val().toLowerCase();

    $('td').closest('tr').hide();
    $('td').closest('tr').each(function(){

    var text = $(this).text().toLowerCase();
      if(text.indexOf(val) !== -1){
        $(this).show();
      }
    });
  });
});

(function($) {
	$.fn.autoSubmit = function(options) {
		return $.each(this, function() {
			// VARIABLES: Input-specific
			var input = $(this);
			var column = input.attr('name');

			// VARIABLES: Form-specific
			var form = input.parents('form');
			var method = form.attr('method');
			var action = form.attr('action');

			// VARIABLES: Where to update in database
			var where_val = form.find('#where').val();
			var where_col = form.find('#where').attr('name');

			// ONBLUR: Dynamic value send through Ajax
			input.bind('blur', function(event) {
				// Get latest value
				var value = input.val();
				// AJAX: Send values
				$.ajax({
					url: action,
					type: method,
					data: {
						val: value,
						col: column,
						w_col: where_col,
						w_val: where_val
					},
					cache: false,
					timeout: 10000,
					success: function(data) {
							$('#notice').text('User Info Updated').css({'color':'green','font-weight':'900'});
							$('#notice').fadeOut().fadeIn();
					}
				});
				// Prevent normal submission of form
				return false;
			})
		});
	}
})(jQuery);
// JQUERY: Run .autoSubmit() on all INPUT fields within form
$(function(){
	$('#ajax-form INPUT').autoSubmit();
});

//close the alert when clicking the "X"
$(document).on('click', '.closeAlert', function() {
	this.parentNode.remove();
});

function getPayPeriodEntries(value) {
	$.ajax({
        type: "POST",
        url: "getPayPeriods.php",
        data: { firstDate: value },
        success: function(data) {
        	$('#timeEntries').html(data);
        }
    });
}

$(document).on('submit', '#timeAdminEntries', function(e) {
	e.preventDefault();
	var dataString = $("#timeAdminEntries").serialize();
		$.ajax({
        type: "POST",
        url: "getUserPaymentEntries.php",
        data: dataString,
        success: function(data) {
        	$('#timeEntries').html(data);
        }
    });
});

$(document).on('click', '.del_button', function(e) {
	 e.preventDefault();
	 if (confirm('Are you sure you want to delete this time entry? This action cannot be undone.')) {
	 var clickedID = this.id.split('-'); //Split ID string (Split works as PHP explode)
	 var DbNumberID = clickedID[1]; //and get number from array
	 var myData = 'recordToDelete='+ DbNumberID; //build a post data structure
	$(this).hide(); //hide currently clicked delete button
		jQuery.ajax({
		type: "POST", // HTTP method POST or GET
		url: "deleteTime.php", //Where to make Ajax calls
		dataType:"text", // Data type, HTML, json etc.
		data:myData, //Form variables
		success:function(response){
			$('#'+DbNumberID).fadeOut();
		},
		error:function (xhr, ajaxOptions, thrownError){
			alert(thrownError);
		}
	});
	}
});

$(document).on('click', '.approveButton', function(e) {
   	var trid = $(this).closest('tr').attr('id');
	e.preventDefault();
		jQuery.ajax({
		type: "POST",
		url: "approveTime.php", //Where to make Ajax calls
		dataType:"text", // Data type, HTML, json etc.
		data:'id='+trid, //Form variables
		success:function(response){
			$("#"+trid+" td:nth-child(5)").css('background-color','green');
			$("#"+trid+" td:nth-child(5)").css('color','white');
			$("#"+trid+" td:nth-child(5)").html("Approved");
		}
	});
});

$(document).on('click', '.rejectButton', function(e) {
   	var trid = $(this).closest('tr').attr('id');
	e.preventDefault();
		jQuery.ajax({
		type: "POST",
		url: "rejectTime.php", //Where to make Ajax calls
		dataType:"text", // Data type, HTML, json etc.
		data:'id='+trid, //Form variables
		success:function(response){
			$("#"+trid+" td:nth-child(5)").css('background-color','crimson');
			$("#"+trid+" td:nth-child(5)").css('color','white');
			$("#"+trid+" td:nth-child(5)").html("Rejected");
		}
	});
});

$(document).on('click', '.clearStatusButton', function(e) {
   	var trid = $(this).closest('tr').attr('id');
	e.preventDefault();
		jQuery.ajax({
		type: "POST",
		url: "clearStatus.php", //Where to make Ajax calls
		dataType:"text", // Data type, HTML, json etc.
		data:'id='+trid, //Form variables
		success:function(response){
			$("#"+trid+" td:nth-child(5)").css('background-color','white');
			$("#"+trid+" td:nth-child(5)").html("");
		}
	});
});

function characterCount() {
    // 140 is the max message length
    var remaining = 150 - jQuery('#comments').val().length;
    jQuery('.characterCountdown').text(remaining + ' characters remaining.');
}

jQuery(document).ready(function($) {
    characterCount();
    $('#comments').change(characterCount);
    $('#comments').keyup(characterCount);
});

//responsive nav scripts
$(function() {
	var pull 		= $('#pull');
		menu 		= $('nav ul');
		menuHeight	= menu.height();

	$(pull).on('click', function(e) {
		e.preventDefault();
		menu.slideToggle();
	});

	$(window).resize(function(){
		var w = $(window).width();
		if(w > 320 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});
});

$( document ).ready(function() {
	if (document.getElementById('activatedFalse').checked) {
		document.getElementById('canReactivateTrue').disabled = false;
    	document.getElementById('canReactivateFalse').disabled = false;
    	$(".isAdmin").css("color", "#c2c0c0");
	} else if (document.getElementById('activatedTrue').checked) {
		document.getElementById('canReactivateTrue').disabled = true;
    	document.getElementById('canReactivateFalse').disabled = true;
    	$(".canReactivate").css("color", "#c2c0c0");
	}

    document.getElementById('activatedTrue').onclick = function() {
    document.getElementById('canReactivateTrue').disabled = true;
    document.getElementById('canReactivateFalse').disabled = true;
    document.getElementById('isAdminTrue').disabled = false;
    document.getElementById('isAdminFalse').disabled = false;
    $(".canReactivate").css("color", "#c2c0c0");
    $(".isAdmin").css("color", "#000");
	}

	document.getElementById('activatedFalse').onclick = function() {
    document.getElementById('canReactivateTrue').disabled = false;
    document.getElementById('canReactivateFalse').disabled = false;
    document.getElementById('isAdminTrue').disabled = true;
    document.getElementById('isAdminFalse').disabled = true;
    $(".canReactivate").css("color", "#000");
    $(".isAdmin").css("color", "#c2c0c0");
	}
});