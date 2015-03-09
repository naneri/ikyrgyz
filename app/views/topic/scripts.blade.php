<script src="{{asset('/js/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
<script>
$(document).ready(function(){ 
        $(".btn-cancel").click(function (e) {
            e.preventDefault();
            window.history.back()
          });
          
        $(".btn-submit").click(function(){
            if (timer) {
                clearTimeout(timer); //cancel the previous timer.
                timer = null;
            }
        });
          
        $('.rel-photo').click(function(){
            $('.photo-box').css('display','block');
        });
        
        $('.rel-audio').click(function() {
            $('.audio-box').css('display', 'block');
        });
        
        tinymce.init({
                    selector: "textarea",
                    language: 'ru',
                    menubar: false,
                    statusbar: false,
                    subfolder:"{{Auth::user()->id}}",
                    plugins: [
                            "advlist autolink lists link image charmap print preview anchor",
                            "code filemanager",
                            "insertdatetime media table contextmenu paste youtube"
                            ],
                    image_advtab: true,
                    relative_urls: false,
                    remove_script_host: true,
                    toolbar: "bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent blockquote pagebreak | link image youtube media | preview code",
                    setup : function(ed){
                                    ed.on('keyup', function(e) {
                                        //console.log('the content ' + ed.getContent());
                                        setUpdateTimeout();
                                    });
                                }
                });
                
        $('.sync-input[type="checkbox"]').change(function(){
            setUpdateTimeout();
        });
        
        $('.sync-input').keyup(function(){
            setUpdateTimeout(); 
        });
        
        var timer = null;
        
        function setUpdateTimeout(){
            if (timer) {
                clearTimeout(timer); //cancel the previous timer.
                timer = null;
            }
            timer = setTimeout(updateForm, 3000);
        }
        
        function updateForm(){
            
            tinyMCE.triggerSave();
            data = $('form.sync-form').serialize();
            
            $.ajax({
                url: "{{asset('/topic/update')}}",
                data: data,
                dataType: 'json',
                type: 'POST',
                success: function(result){
                    if(result['topic_id'] && $('input[name="topic_id"]').val() != result.topic_id){
                        $('input[name="topic_id"]').val(result.topic_id);
                    }
                },
                error: function(result) {
                }
            });
        }
        
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
			$.getJSON( "{{asset('/tags')}}", {
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
