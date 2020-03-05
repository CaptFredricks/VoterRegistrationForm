jQuery(document).ready($ => {
	let form = $('#registration-form');
	let status = $('#status');
	
	$(form).submit(e => {
		e.preventDefault(); // prevent the form from submitting
		
		let form_data = $(form).serialize();
		
		$.ajax({
			data: form_data,
			method: 'POST',
			url: $(form).attr('action') + '?ajax=true' // tell PHP that the form is using Ajax
		}).done(response => {
			$(status).html(response);
			
			$(form).trigger('reset');
		}).fail(data => {
			if(data.responseText !== '')
				$(status).html('<span class="error">' + data.responseText + '</span>');
			else
				$(status).html('<span class="error">An unexpected error occurred.</span>');
		});
	});
});