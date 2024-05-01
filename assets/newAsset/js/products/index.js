
var urls = BASE_URL + 'products/get_list';
var add_urlsa = BASE_URL + 'products/form/';
var add_product_temp = BASE_URL + 'products/add_product_temp';


if (MAdd > 0) {
    btnAdd1 = [{
        text: "Add",
        action: function (e, dt, node, config) {
            $.ajax({
                url: add_product_temp,
                type: "post",
                dataType: "json",
                success: function(result) {
                    if (result.error == false) {
                        console.log(result.id);
                        location.href = add_urlsa + result.id;
                    } else {
                        reload_table();
                    }
                },
                error: function(xhr, Status, err) {
                    $("Terjadi error : " + Status);
                },
            });
        },
    },]
} else {
    btnAdd = []
}

$(document).ready(function () {
    $("#table-product")
        .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            serverSide: true,
            processing: true,
            // "order": [[ 3, "desc" ]],
            paging: true,
            columnDefs: [{
                "width": "50px",
                "targets": 0
            }],
            searching: {
                regex: true
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
            pageLength: 10,
            dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>",
            buttons: btnAdd1,
            ajax: {
                url: urls,
                type: "POST",
            },
        })
        .buttons()
        .container()
        .appendTo("#table-product_wrapper .col-md-6:eq(0)");
});

function myDelete(id, urls) {
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
                    url: urls,
                    type: "POST",
                    data: {
                        DID: id,
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
    $("#table-product").DataTable().ajax.reload(); //reload datatable ajax
}

function modal_variant()
{
    $("#modal-variant").modal('show');
}