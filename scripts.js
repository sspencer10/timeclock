( function( $ ) {
$( document ).ready(function() {
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
} )( jQuery );


//adding hour totals
var totalsByRow = [0, 0, 0, 0, 0, 0, 0, 0];
var totalsByCol = [0, 0, 0, 0, 0, 0, 0, 0];
$(document).ready(function() {

    var $dataRows = $("#hoursTable tr:not('.totalColumn, .titlerow')");

    $dataRows.each(function(i) {
        $(this).find('td:not(.totalRow)').each(function(j) {
            totalsByCol[j] += parseInt($(this).html());
            totalsByRow[i] += parseInt($(this).html());
        });
    });
    
    for (var i = 0; i < totalsByCol.length - 1; i++) {
        totalsByCol[totalsByCol.length - 1] += totalsByCol[i];       
    }    

    $("#hoursTable td.totalCol").each(function(i) {
        $(this).html("" + totalsByCol[i]);
    });

    $("#hoursTable td.totalRow").each(function(i) {
        $(this).html("" + totalsByRow[i]);
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
						// Alert if update failed
						if (data) {
							alert(data);
						}
						// Load output into a P
						else {
							$('#notice').text('User Info Updated').css({'color':'green','font-weight':'900'});
							$('#notice').fadeOut().fadeIn();
						}
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