$("#upload_nilai").change(function(){
    var link = BASE_URL + funct + '/upload_nilai';
    var formData = new FormData();
    formData.append("upload_nilai", $("#upload_nilai").get(0).files[0]);
    $.ajax( {
        url        : link,
        type       : 'POST',
        contentType: false,
        cache      : false,
        processData: false,
        data       : formData,
        dataType       : "json",
        success    : function (data)
        {
            image_clear();
            if (data.error == false) {
                swal.fire({
                    title: "Success",
                    text: data.msg,
                    type: "success"
                }).then(function () {
                    reload_tables()
                });
            } else {
                
                swal.fire({
                    title: "Error",
                    text: data.msg,
                    type: "error"
                }).then(function () {
                    reload_tables()
                });
            }
        }
    } );
});

$(document).ready(function () {
   
    var table = $("#example")
        .DataTable({
            scrollY: true,
            responsive: false,
            lengthChange: false,
            autoWidth: false,
            serverSide: true,
            processing: true,
            // "order": [[ 3, "desc" ]],
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
            // dom: '<"top"<"left-col"B><"center-col"l><"right-col"f>>rtip',
            // buttons: [
            //     {
            //         text: 'Selesai & Nilai',
            //         className: 'btn btn-info',
            //         action: function ( e, dt, node, config ) {
            //             alert( 'Button activated' );
            //         }
            //     }
            // ],
            ajax: {
                url: urls,
                type: "POST",
            },
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");

     
});

$('#reset_hasil').click(function(){
    var link = BASE_URL + funct + '/delete_hasil';
    swal.fire({
        title: "Reset penilaian?",
        text: "Penilaian akan di batalkan?",
        type:"warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ya, batalkan!",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: link,
                type: "POST",
                data: {
                    DID: 1,
                },
                success: function (result) {
                    reload_tables();
                    image_clear();
                    swal({
                        title: "Success",
                        text: "Sukses Membatalkan penilaian",
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
    })
})


$('#penilaian').click(function(){
    var link = BASE_URL + funct + '/penilaian';
    swal.fire({
        title: "Selesai Penilaian?",
        text: "Anda telah selesai melakukan preview?",
        type:"warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ya, proses penilaian",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: link,
                type: "POST",
                data:{form:1},
                dataType:"JSON",
                success: function (data) {
                    image_clear();
                    if (data.error == false) {
                        swal.fire({
                            title: "Success",
                            text: data.msg,
                            type: "success"
                        }).then(function () {
                            reload_tables()
                        });
                    } else {
                        swal.fire({
                            title: "Error",
                            text: data.msg,
                            type: "error"
                        }).then(function () {
                            reload_tables()
                        });
                    }
                },
                error: function (xhr, Status, err) {
                    $("Terjadi error : " + Status);
                },
            });
        } else {
            return false;
        }
    })
})

function reload_tables() {
    $("#example").DataTable().ajax.reload(); //reload datatable ajax
}


function image_clear()
{
    $("#upload_nilai").val('');
}
