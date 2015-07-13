 runDropzone = function(upload_url){
        Dropzone.autoDiscover = false;
        $("#dZUpload").dropzone({
            url: upload_url,
            addRemoveLinks: true,
            maxFiles: 1,
            success: function (file, response) {
                var imgName = response;
                file.previewElement.classList.add("dz-success");
                console.log(response);
            },
            removedfile: function(file,response){
                $.post("{{URL::to('topic/addCover?removePhoto=1')}}", function(data){
                    console.log(data);
                });
                var _ref;
                (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
            },
            error: function (file, response) {
                file.previewElement.classList.add("dz-error");
            },
            init: function() {
                this.on("maxfilesexceeded", function(file){
                    this.removeFile(file);
                });
            }
        });

        $("#dZUpload").on("removedfile", function(file) {
            console.log(file);
        /*  var server_file = $(file.previewTemplate).children('.server_file').text();
          alert(server_file);
          // Do a post request and pass this path and use server-side language to delete the file
          $.post("delete.php", { file_to_be_deleted: server_file } );*/
        });
    }

