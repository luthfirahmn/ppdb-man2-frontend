var url_custom = BASE_URL + funct + '/get_product_list_category/';
var url_custom_modal = BASE_URL + funct + '/get_product_list_modal/';
var url_add_product = BASE_URL + funct + '/add_product';
var url_delete_product = BASE_URL + funct + '/delete_product';


$("#category").on('change', function () {
    var id = $(this).val();
    // $('#custom-table').DataTable().destroy();
    $("#custom-table")
    .DataTable({
        // scrollY: true,
        destroy: true,
        responsive: false,
        lengthChange: false,
        autoWidth: false,
        serverSide: true,
        processing: true,
        paging: true,
        columnDefs: [{
            "width": "20px",
            "targets": 0
        }],
        searching: {
            regex: true
        },
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"],
        ],
        columnDefs: [
            { orderable: false, searchable: false, targets: -1 } //Ultima columna no ordenable para botones
        ],
        pageLength: 10,
        ajax: {
            url: url_custom + id,
            type: "POST",
        },
    })
    .buttons()
    .container()
    .appendTo("#custom-table_wrapper .col-md-6:eq(0)");
});

$(document).ready(function () {
    var category = $('#category').val();

    $("#custom-table-modal")
        .DataTable({
            // scrollY: true,
            responsive: false,
            lengthChange: false,
            autoWidth: false,
            serverSide: true,
            processing: true,
            paging: true,
            columnDefs: [{
                "width": "20px",
                "targets": 0
            }],
            searching: {
                regex: true
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"],
            ],
            columnDefs: [
                { orderable: false, searchable: false, targets: -1 } //Ultima columna no ordenable para botones
            ],
            pageLength: 10,
            ajax: {
                url: url_custom_modal + category,
                type: "POST",
            },
        })
        .buttons()
        .container()
        .appendTo("#custom-table_wrapper .col-md-6:eq(0)");
});


$('#btn-add').on('click', function(){
    
    var category = $('#category').val();

    if(category == null)
    {
        Swal.fire(
            'Warning',
            'Please choose the category first!',
            'error'
          )
    }
    else
    {
        $('.add-modal').modal('show');
    }
})

function add_product(product_id) {
    var category = $('#category').val();

    swal.fire({
        title: "Are you sure?",
        text: "Are you sure you want to add this product?",
        icon: "error",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url_add_product,
                type: "POST",
                data: {product_id : product_id , category:category},
                dataType: "JSON",
                success: function (result) {
                    reload_table_modal();
                    reload_table_custom();
                    swal({
                        title: "Success",
                        text: "success add product..",
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

function delete_product(DID) {
    var category = $('#category').val();

    swal.fire({
        title: "Are you sure?",
        text: "Are you sure you want to delete this product?",
        icon: "error",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url_delete_product,
                type: "POST",
                data: {DID:DID},
                dataType: "JSON",
                success: function (result) {
                    reload_table_modal();
                    reload_table_custom();
                    swal({
                        title: "Success",
                        text: "success delete product..",
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

function reload_table_modal() {
    $("#custom-table-modal").DataTable().ajax.reload(); //reload datatable ajax
}

function reload_table_custom() {
    $("#custom-table").DataTable().ajax.reload(); //reload datatable ajax
}