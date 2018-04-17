/**
 * Created by danielprado on 20/07/17.
 */

var DropZone = function () {
    var upload = function (route, thumb) {
        Dropzone.autoDiscover = false;
        $("#dropzone").dropzone({
            url: route,
            addRemoveLinks: true,
            parallelUploads: 1,
            maxFiles: 1,
            autoProcessQueue: false,
            dictRemoveFile: Lang.get("javascript.dropzone.remove"),
            maxFileSize: 1000,
            dictResponseError: Lang.get("javascript.dropzone.server_error"),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            acceptedFiles: '.pdf',
            init: function() {
                var submitButton = document.querySelector("#submit");
                var myDropzone = this; // closure
                myDropzone.on("maxfilesexceeded", function(file) {
                    myDropzone.disable();
                    this.removeFile(file);
                });
                myDropzone.on("addedfile", function(file) {
                    if (!file.type.match(/image.*/)) {
                        myDropzone.emit("thumbnail", file, thumb);
                    }
                });
                myDropzone.on("deletedfile", function (file) {
                    myDropzone.enable();
                });
                submitButton.addEventListener("click", function(file) {
                    if (myDropzone.files.length > 0 && $('#financial-form-files').valid()) {
                        myDropzone.processQueue();
                    } else {
                        swal({
                            title: Lang.get("javascript.warning"),
                            text: Lang.get("javascript.dropzone.one_file"),
                            buttonsStyling: false,
                            confirmButtonClass: "btn btn-success",
                            type: "warning",
                        });
                    }
                });
                myDropzone.on("sending", function (file) {
                    $.blockUI({
                        message: '<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i><h3> '+ Lang.get("javascript.dropzone.processing") +' </h3>',
                        css: {
                            border: 'none',
                            padding: '20px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });
                });
                myDropzone.on("complete", function(file) {
                    myDropzone.enable();
                    myDropzone.removeFile(file);
                });
                myDropzone.on("queuecomplete", function(file) {
                    myDropzone.enable();
                    UIToastr.init('success', Lang.get("javascript.dropzone.stored"), Lang.get("javascript.dropzone.stored_and_processing"));
                });
            },

            complete: function(file) {
                $.unblockUI({
                    onUnblock: function () {
                        if (file.status === "success") {
                            swal({
                                title: Lang.get("javascript.dropzone.stored"),
                                text: Lang.get("javascript.dropzone.success", { filename: file.name }),
                                buttonsStyling: false,
                                confirmButtonClass: "btn btn-success",
                                type: "success",
                            });
                        }
                    }
                });
            },

            error: function(file) {
                swal({
                    title: Lang.get("javascript.error"),
                    text:  Lang.get("javascript.dropzone.failed") + ' ' +file.name ,
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-danger",
                    type: "error",
                });
            },
        });
    };

    return {
        init: function (route, thumb) {
            upload(route, thumb);
        }
    }
}();
