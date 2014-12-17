<script>
$(document).ready(function(){ 
	$('#topic_types a').click(function(e) {
            e.preventDefault();
            $('input[name="topic_type"').val($(this).attr('data-topic-type'));
        });
        
	var uploadInput = $('#file'),
                        imageInput = $('[name="image"]'),
                        thumb = document.getElementById('thumb'),
                        error = $('div.error');

                uploadInput.on('change', function() {
                    
                    var data;

                    data = new FormData();
                    
                    $.each(uploadInput[0].files, function(){
                    
                        var imgTag = $('<img class="topic-image">');
                        var inputTag = $('<input type="hidden" name="topic_images[]">');
                        
                        data.append('file', this);
                        var token = $('[name="_token"]').val();
                        data.append('_token', token);
                            console.log(this);

                        $.ajax({
                            url: '/upload',
                            data: data,
                            processData: false,
                            contentType: false,
                            type: 'POST',
                            dataType: 'json',
                            success: function(result) {
                                if (result.filelink) {
                                    imgTag.attr('src', result.filelink);
                                    inputTag.val(result.filelink);
                                    $('#image').append(imgTag);
                                    $('#image').append(inputTag);
                                    error.hide();
                                } else {
                                    error.text(result.message);
                                    error.show();
                                }
                            },
                            error: function(result) {
                                error.text("Upload impossible");
                                error.show();
                            }
                        });
                        
                    });
                });
                
	function split( val ) {
		return val.split( /,\s*/ );
	}
	function extractLast( term ) {
		return split( term ).pop();
	}
 
	$( "#tags" )
	// don't navigate away from the field on tab when selecting an item
	.bind( "keydown", function( event ) {
		if ( event.keyCode === $.ui.keyCode.TAB &&
			$( this ).data( "ui-autocomplete" ).menu.active ) {
			event.preventDefault();
		}
	})
	.autocomplete({
		source: function( request, response ) {
			$.getJSON( "/tags", {
					term: extractLast( request.term ),
				}, 
				function( data ) {
					response($.map(data, function(item) {
						return {
							value: item.name
						}
					}))
				}
			);
		},
		search: function() {
			// custom minLength
			var term = extractLast( this.value );
			if ( term.length < 2 ) {
			return false;
			}
		},
		focus: function() {
			// prevent value inserted on focus
			return false;
		},
		select: function( event, ui ) {
			console.log(ui);
			console.log(this);
			var terms = split( this.value );
			// remove the current input
			terms.pop();
			// add the selected item
			terms.push( ui.item.value );
			// add placeholder to get the comma-and-space at the end
			terms.push( "" );
			this.value = terms.join( ", " );
			return false;
		}
	});
});
</script>