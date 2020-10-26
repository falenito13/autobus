    let this_js_script = $('script[src*=file]');
    var accepted_files = this_js_script.attr('data-accepted_files');
    var max_files = this_js_script.attr('data-max_files');
    var PostTable = this_js_script.attr('data-PostTable');
    var uploadedDocumentMap = {};
    Dropzone.options.myAwesomeDropzone = {
        paramName: "File",
        autoProcessQueue: true,
        parallelUploads: 1,
        uploadMultiple: true,
        maxFiles: max_files,
        addRemoveLinks: true,
        url: "/ka/admin/uploadfiles",
        headers: {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
        },
        maxFilesize: 3,
        acceptedFiles: accepted_files,
        init: function () {
            if (Data != null || Data.count() > 0 || Data !== undefined){
                var re = /(?:\.([^.]+))?$/;
                for (let k in Data) {
                    var ext = re.exec(Data[k].name)[1];
                    if (ext === 'svg') {
                        let mockFile = {
                            name: Data[k].name,
                            path_name: Data[k].name,
                            size: Data[k].file_size,
                            type: 'image/svg+xml',
                            status: 'added',
                            url: '/uploads/' + Data[k].route_name + '/svg/' + Data[k].name,
                            accepted: true,
                            kind: 'svg+xml'
                        };
                        this.emit("addedfile", mockFile);
                        this.files.push(mockFile);
                        this.emit("thumbnail", mockFile, '/uploads/' + Data[k].route_name + '/svg/' + Data[k].name);
                        //this.createThumbnailFromUrl(mockFile, '/uploads/' + Data[k].route_name + '/svg/' + Data[k].name);
                        this.emit("complete", mockFile);
                    }
                    if (['png', 'jpg', 'jpeg'].includes(ext)){
                        let mockFile = {
                            name: Data[k].name,
                            path_name: Data[k].name,
                            size: Data[k].file_size,
                            type: Data[k].mime_type,
                            status: 'added',
                            url: '/uploads/' + Data[k].route_name + '/thumbs/' + Data[k].name,
                            accepted: true,
                            kind: 'svg+xml'
                        };
                        this.emit("addedfile", mockFile);
                        this.files.push(mockFile);
                        //this.emit("thumbnail", mockFile, '/uploads/' + Data[k].route_name + '/thumbs/' + Data[k].name);
                        this.createThumbnailFromUrl(mockFile, '/uploads/' + Data[k].route_name + '/thumbs/' + Data[k].name);
                        this.emit("complete", mockFile);
                    }

                }
            }
            this.on("sending", function(file, xhr, formData){
                formData.append("PostTable", PostTable);
            });
            this.on("success", function(file,response) {
                console.log(response);
                $('form').append('<input type="hidden" name="File[]" value="' + response.file_name  + '">');
                uploadedDocumentMap[file.name] = response.file_name;

            })
            this.on("removedfile", function(file) {
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="File[]"][value="' + name + '"]').remove();
            });
            this.on("error", function (file, message) {
                this.removeFile(file);
                $.toast({
                    heading: 'error',
                    text: message,
                    position: 'top-right',
                    loaderBg: '#ff6849',
                    icon: 'error',
                    hideAfter: 4000,
                    stack: 6
                });
            });

        }

    };
