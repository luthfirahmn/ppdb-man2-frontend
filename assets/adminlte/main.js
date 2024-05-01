if (!index) {
    var urls = BASE_URL + funct + '/get_list';
    var add_urls = BASE_URL + funct + '/form/add';
    var url_delete = BASE_URL + funct + '/delete';

    if (MAdd > 0) {
        btnAdd = [{
            text: "Add",
            action: function (e, dt, node, config) {
                location.href = add_urls;
            },
        },]
    } else {
        btnAdd = []
    }

    $(document).ready(function () {
        $("#example1")
            .DataTable({
                scrollY: true,
                responsive: false,
                lengthChange: false,
                autoWidth: false,
                serverSide: true,
                processing: true,
                // "order": [[ 3, "desc" ]],
                paging: true,
                searching: {
                    regex: true
                },
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"],
                ],
                columnDefs: [
                    { 
                        orderable: false,
                        searchable: false, 
                        targets: -1 
                    } ,
                    {
                        "width": "50px",
                        "targets": 0
                    }
                ],
                pageLength: 10,
                dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
                buttons: btnAdd,
                ajax: {
                    url: urls,
                    type: "POST",
                },
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
    });

    function myDelete(id) {
        swal.fire({
            title: "Are you sure?",
            text: "Are you sure you want to delete this?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url_delete,
                        type: "POST",
                        data: {
                            id: id,
                        },
                        success: function (result) {
                            reload_table();
                            swal({
                                title: "Success",
                                text: "success deleted..",
                                type: "success",
                                showConfirmButton: false,
                                confirmButtonText: false,
                                timer: 2000,
                            });
                        },
                        error: function (xhr, Status, err) {
                            $("Terjadi error : " + Status);
                        },
                    });
                } else {
                    return false;
                }
            });
    }

    function reload_table() {
        $("#example1").DataTable().ajax.reload(); //reload datatable ajax
    }
}



function error_ajax(status) {
    var message;
    var statusErrorMap = {
        '400': "Server understood the request, but request content was invalid.",
        '401': "Unauthorized access.",
        '403': "Forbidden resource can't be accessed.",
        '404': "The page you requested was not found.",
        '500': "Internal server error.",
        '503': "Service unavailable."
    };
    if (status) {
        message = statusErrorMap[status];
        if (!message) {
            message = "Unknown Error \n.";
        }
    } else if (exception == 'parsererror') {
        message = "Error.\nParsing JSON Request failed.";
    } else if (exception == 'timeout') {
        message = "Request Time out.";
    } else if (exception == 'abort') {
        message = "Request was aborted by the server";
    } else {
        message = "Unknown Error \n.";
    }
    alert(message)
    // swal.fire("Error Message", message, "error");
}

function SaveForm() {

    if ($("#status_form").val() == 0) {
        var link = BASE_URL + funct + '/add';
    } else {
        var id = $("#id").val();
        var link = BASE_URL + funct + '/edit/' + id;
    }

    $.ajax({
        type: "post",
        url: link,
        data: new FormData($('#formadd')[0]),
        processData: false,
        contentType: false,
        cache: false,
        dataType: "json",
        beforeSend: function () {
            $('.save').attr('disable', 'disabled');
            $('.save').html('<i class="fa fa-spin fa-spinner"></i>');
        },
        complete: function () {
            $('.save').removeAttr('disable');
            $('.save').html('<i class="ti-save"> </i> Save');
        },
        success: function (data) {
            if (data.error == false) {
                swal.fire({
                    title: "Success",
                    text: data.msg,
                    type: "success"
                }).then(function () {
                    window.location.href = BASE_URL + funct;
                });
            } else {
                $(".error-msg").css('display', 'block');
                $(".error-msg").html(data.msg);
                window.scrollTo(0, 0)
            }
        },
        error: function (xhr, status, errorThrown) {
            error_ajax(xhr.status);
        }

    });
}
