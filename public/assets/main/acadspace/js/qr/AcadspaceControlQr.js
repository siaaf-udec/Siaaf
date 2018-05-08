var QRcontrol = function () {
    return {
        //main function to initiate the module
        init: function (routes, valores, type_crud) {
            var myQR = this,
                btnsubmit = $('.button-submit');
            btnsubmit.on('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (type_crud == 'CREATE') {
                    if (valores.documento === null || valores.espacio === null || valoes.espacio === null) {
                        UIToastr.init('error', 'ERROR QR', '¡QR Corrupto!');
                    } else {
                        UIToastr.init('success', 'BIENVENIDO', 'Registro satisfactorio.');
                    }
                }
            });


        },
        complete: function (file, xhr, formData) {
            if (file.status == 'success') {
                $('#form_sol_create')[0].reset();
                App.unblockUI();
                UIToastr.init('success', 'BIENVENIDO',
                    'Registro satisfactorio.'
                );
            }
        },
        error: function (file, xhr, formData) {
            if (file.status == 'error') {

                UIToastr.init('error', '¡QR Corructo!',
                    'Intentar de nuevo'
                );
            }
        }


    };
}();