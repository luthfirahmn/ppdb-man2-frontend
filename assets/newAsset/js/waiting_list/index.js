$("#cari_peserta").on('click', function(){
    var nisn = $('#nisn').val();
    if(nisn == ''){
        swal.fire({
            title: "Warning",
            text: "NISN Harus diisi",
            type: "error"
        })

        return
    }

    var url = BASE_URL +  'waiting_list/get_peserta_waiting_list' + '/' + nisn;
    $.ajax({
        url: url,
        type: "post",
        dataType: "json",
        success: function(result) {
            if(result.error == false){
                var html = '';
                html += '<table id="table_aksi" class="table display" style="width:100%">';
                html +='<thead>';
                html +='<tr>';
                html +='<th>Action</th>';
                html +='<th>NISN</th>';
                html +='<th>NO WA</th>';
                html +='<th>Nama Peserta</th>';
                html +='<th>Jalur Pilihan</th>';
                html +='<th>Status Penilaian</th>';
                html +='</tr>';
                html +='</thead>';
                html +='<tbody>';
                html +='<tr>';
                html +='<td>' + '<button type="button" onclick="action_waiting_list(\''+result.data.nisn +'\',8)"  class="btn btn-danger btn-sm" >Luluskan</button>' + '</td>';
                html +='<td>' + result.data.nisn + '</td>';
                html +='<td>' + result.data.no_wa + '</td>';
                html +='<td>' + result.data.nama_lengkap + '</td>';
                html +='<td>' + result.data.jalur + '</td>';
                html +='<td>' + result.data.status + '</td>';
                html +='</td>';
                html +='</table>';
                $("#aksi").html(html);
            }else{
                swal.fire({
                    title: "Warning",
                    text: "Data Peserta Tidak Ditemukan",
                    type: "error"
                })
            }
            
        }
    })
   

})


function action_waiting_list(nisn,status)
{
    
    var url = BASE_URL + funct + '/aksi_waiting_list';

    Swal.fire({
        title: 'Anda yakin?',
        text: "Update status peserta?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url: url,
                type: "POST",
                data: {nisn:nisn,status:status},
                dataType:"JSON",
                beforeSend :function () {
                    
                    $("#aksi").html('');
                    swal.fire({
                        title: 'Loading',
                        html: 'Proccess Data',
                        onOpen: () => {
                        swal.showLoading()
                        }
                    })
                       
                 },  
                success: function (result) {
                    
                    if(result.error == false){
                        swal.fire({
                            title: "Sukses",
                            text: result.msg,
                            type: "success"
                        }).then(() => {
                            Swal.close()
                            reload_table()
                        })
                    }else{
                        swal.fire({
                            title: "Error",
                            text: result.msg,
                            type: "error"
                        }).then(() => {
                            Swal.close()
                            reload_table()
                        })
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
}
