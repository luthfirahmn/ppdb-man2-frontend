$(document).ready(function () {
var url = BASE_URL + funct + '/get_list_filter';
var url_download = BASE_URL + funct + '/export_jadwal/';

    $("#filter_tanggal").change(function(){
        var filter = $(this).val();
        $('#example1').DataTable().destroy();
        $("#example1")
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
                url: url,
                type: "POST",
                data: {filter:filter},
            },
        })
        .buttons()
        .container()
        .appendTo("#custom-table_wrapper .col-md-6:eq(0)");
        
    })

    $("#btn-download").click(function(e){
        e.preventDefault();  //stop the browser from following
        
        var filter = $('#filter_tanggal').val();
        window.location.href = url_download + filter;
        // $.ajax({
        //     type: "post",
        //     url: url_download,
        //     data: {filter:filter},
        //     xhrFields: {
        //         responseType: 'blob'
        //     },
        //     beforeSend: function () {
        //         $(this).attr('disable', 'disabled');
        //         $(this).html('<i class="fa fa-spin fa-spinner"></i>');
        //     },
        //     complete: function () {
        //         $(this).removeAttr('disable');
        //         $(this).html('Download Data');
        //     },
        //     success: function (data) {
        //         var a = document.createElement('a');
        //         var url = window.URL.createObjectURL(data);
        //         a.href = url;
        //         a.download = 'myfile.xlsx';
        //         document.body.append(a);
        //         a.click();
        //         a.remove();
        //         window.URL.revokeObjectURL(url);
            
        //     },
        //     error: function (xhr, status, errorThrown) {
        //         error_ajax(xhr.status);
        //     }
    
        // });
    })
})
