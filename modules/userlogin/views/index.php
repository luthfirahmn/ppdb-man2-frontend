<section class="content">
    <div class="alert alert-danger notif-msg" style="display:none"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><?php echo $template['title'] ?></h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="pull-left">

                        </div>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>LastLogin</th>
                                    <th>SessionExpiry</th>
                                    <th>RememberMe</th>
                                    <th>ResetPass</th>
                                    <th>CodeOTP</th>
                                    <th>EmpID</th>
                                    <th>AdminPanel</th>
                                    <th>AppToken</th>
                                    <th>Active</th>

                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
<!-- update -->
<!-- baru -->

<script>
    var urls = '<?= base_url(); ?>UserLogin/get_list';
    if (0) {
        btnAdd = [{
            text: "Add",
            action: function(e, dt, node, config) {
                location.href = add_urls;
            },
        }, ]
    } else {
        btnAdd = []
    }

    $(document).ready(function() {
        $("#example1")
            .DataTable({
                responsive: true,
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
                        success: function(result) {
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
                        error: function(xhr, Status, err) {
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
</script>