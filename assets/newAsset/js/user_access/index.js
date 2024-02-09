function updateUserAkses(e, DID, Act) {
    var mode = e.classList[3];
    $.ajax({
        type: "post",
        url: BASE_URL + funct + '/updateAkses',
        data: { "DID": DID, "mode": mode, "Act": Act },
        dataType: "json",
        beforeSend: function () {
            $(e).attr('disable', 'disabled');
            $(e).html('<i class="fa fa-spin fa-spinner"></i>');
        },
        complete: function () {
            $(e).removeAttr('disable');
            $(e).html(e.innerHTML);
        },
        success: function (data) {
            if (data.error == false) {
                swal.fire({
                    title: "Success",
                    text: data.msg,
                    type: "success"
                }).then(function () {
                    reload_table();
                });
            }
        },
        error: function (xhr, status, errorThrown) {
            error_ajax(xhr.status);
        }

    });
}