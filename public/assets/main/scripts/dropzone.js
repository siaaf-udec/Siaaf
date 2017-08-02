var FormDropzone = function () {
    return {
        //main function to initiate the module
        init: function (route, formatfile, numfile, method, params) {
            Dropzone.options.autoDiscover = false;
            Dropzone.options.myDropzone = {
                url: route,
                dictDefaultMessage : 'Arrastra los archivos aquí para subirlos', //Texto utilizado antes de que se eliminen los archivos.
                addRemoveLinks: true, //Agregará un enlace a cada vista previa del archivo para eliminar o cancelar
                parallelUploads: 1, //¿Cuántas cargas de archivos se procesarán en paralelo?
                maxFiles: numfile, //Define el número de archivos
                autoProcessQueue: false, //Los archivos se agregarán a la cola pero la cola no se procesará automáticamente.
                dictRemoveFile: "Eliminar", // Texto que se usará para eliminar un archivo
                maxFileSize: 1000, //Tamaño del archivo en MB
                dictResponseError: "Ha ocurrido un error en el server", //Si la respuesta del servidor no es válida
                withCredentials: true, // For CORS.
                uploadMultiple: true,
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

                    myDropzone.params = name;

                    /*Cuando la subida era correcta o errónea*/
                    myDropzone.on("complete", function(file) {
                        myDropzone.removeFile(file);
                    });

                    /*Antes de enviar cada archivo.*/
                    myDropzone.on("sending", function(file, xhr, formData) {
                        $(params).each(function (key, value) {
                            console.log(params[1]);
                            formData.append(params[key], value.name)
                        });

                        UIToastr.init('success', 'Procesando',
                            ''
                        );
                    });

                    /*Archivo agregado*/
                    myDropzone.on("addedfile", function(file) {
                        if (!file.type.match(/image.*/)) {
                            myDropzone.emit("thumbnail", file, thumb);
                        }
                    });

                    /*Se llama a cada archivo que se ha rechazado porque el número de archivos excede el límite*/
                    myDropzone.on("maxfilesexceeded", function(file) {
                        myDropzone.removeFile(file);
                    });

                    /*Cuando todos los archivos de la cola terminan de subir.*/
                    myDropzone.on("queuecomplete", function(file) {
                        UIToastr.init('success', 'Almacenado', 'El archivo se ha cargado satisfactoriamente. Un momento mientras se procesa.');
                    });
                },
                complete: function(file) {
                    if (file.status == 'success') {
                        UIToastr.init('success', 'Carga Satisfactoria',
                            'El archivo se ha procesado satisfactoriamente.'
                        );
                    }
                },
                error: function(file) {
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
