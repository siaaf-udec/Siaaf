var FormDropzone = function () {
    return {
        //main function to initiate the module
        init: function (route, formatfile, numfile, method, params) {
            Dropzone.options.autoDiscover = false;
            Dropzone.options.myDropzone = {
                url: route,
                //Texto utilizado antes de que se eliminen los archivos.
                dictDefaultMessage : 'Arrastra los archivos aquí para subirlos',
                //Agregará un enlace a cada vista previa del archivo para eliminar o cancelar
                addRemoveLinks: true,
                //¿Cuántas cargas de archivos se procesarán en paralelo?
                parallelUploads:  ( typeof numfile !== 'undefined' && typeof numfile === 'number' ) ? numfile : 1,
                //Define el número de archivos
                maxFiles: ( typeof numfile !== 'undefined' && typeof numfile === 'number' ) ? numfile : 1,
                //Los archivos se agregarán a la cola pero la cola no se procesará automáticamente.
                autoProcessQueue: false,
                //Texto que se usará para eliminar un archivo
                dictRemoveFile: "Eliminar",
                //Tamaño del archivo en MB
                maxFileSize: 1000,
                //Si la respuesta del servidor no es válida
                dictResponseError: "Ha ocurrido un error en el server",
                //For CORS.
                withCredentials: true,
                //Enviar varios archivos en una solicitud
                uploadMultiple: true,
                //Encabezados adicionales
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                acceptedFiles: formatfile,
                init: function() {
                    var myDropzone = this,
                        btnsubmit = $('.button-submit');

                    btnsubmit.on('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();
                        if ( typeof method !== 'undefined' && typeof method === 'object' ) {
                            method.init();
                            myDropzone.processQueue();
                        }
                        if (typeof method === 'undefined' || method === false) {
                            form.submit();
                            myDropzone.processQueue();
                        }
                    });

                    /*Cuando la subida era correcta o errónea*/
                    myDropzone.on("complete", function(file, xhr, formData) {
                        myDropzone.removeFile(file);
                    });

                    /*Antes de enviar cada archivo.*/
                    myDropzone.on("sending", function(file, xhr, formData) {
                        if ( typeof params !== 'undefined' && typeof params === 'object' ) {
                            $.each(params, function (key, value) {
                                formData.append(key, value)
                            });
                        }
                    });

                    /*Archivo agregado*/
                    myDropzone.on("addedfile", function(file, xhr, formData) {
                        if (!file.type.match(/image.*/)) {
                            myDropzone.emit("thumbnail", file, thumb);
                        }
                    });

                    /*Se llama a cada archivo que se ha rechazado porque el número de archivos excede el límite*/
                    myDropzone.on("maxfilesexceeded", function(file, xhr, formData) {
                        myDropzone.removeFile(file);
                    });

                    /*Cuando todos los archivos de la cola terminan de subir.*/
                    myDropzone.on("queuecomplete", function(file, xhr, formData) {
                        UIToastr.init('success', 'Almacenado', 'El archivo se ha cargado satisfactoriamente. Un momento mientras se procesa.');
                    });
                },
                complete: function(file, xhr, formData) {
                    if (file.status == 'success') {
                        UIToastr.init('success', 'Carga Satisfactoria',
                            'El archivo se ha procesado satisfactoriamente.'
                        );
                    }
                },
                error: function(file, xhr, formData) {
                    if (file.status == 'success') {
                        UIToastr.init('success', '¡Ocurrió un Error!',
                            'El archivo se ha procesado satisfactoriamente.'
                        );
                    }
                }
            };
        }
    };
}();
