<script>
$(function() {
    'use strict';



    $(function() {
        'use strict';

        var page_data_diri = $('#form-data-diri');

        // data diri
        // --------------------------------------------------------------------
        if (page_data_diri.length) {
            page_data_diri.validate({

                onkeyup: function(element) {
                    $(element).valid();
                },
                rules: {
                    'tempat_lahir': {
                        required: true,
                    },
                    'jenis_kelamin': {
                        required: true,
                    },
                    // alamat
                    'alamat': {
                        required: true,
                    },
                    'provinsi': {
                        required: true,
                    },
                    'kecamatan': {
                        required: true,
                    },
                    'kelurahan': {
                        required: true,
                    },
                    'kode_pos': {
                        required: true,
                    },
                    'kota': {
                        required: true,
                    },

                    'rt': {
                        required: true,
                    },

                    'rw': {
                        required: true,
                    },

                    // asal sekolah
                    'asal_sekolah': {
                        required: true,
                    },

                    // ortu

                    'nama_ayah': {
                        required: true,
                    },
                    'pekerjaan_ayah': {
                        required: true,
                    },
                    'no_hp_ayah': {
                        required: true,
                    },
                    'nama_ibu': {
                        required: true,
                    },
                    'pekerjaan_ibu': {
                        required: true,
                    },
                    'no_hp_ibu': {
                        required: true,
                    },

                },
                messages: {
                    'tempat_lahir': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'jenis_kelamin': {
                        required: 'Tidak Boleh Kosong',
                    },

                    // alamat
                    'alamat': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'provinsi': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'kota': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'kecamatan': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'kelurahan': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'kode_pos': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'rt': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'rw': {
                        required: 'Tidak Boleh Kosong',
                    },

                    // asal sekolah
                    'asal_sekolah': {
                        required: 'Tidak Boleh Kosong',
                    },

                    // ortu
                    'nama_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'pekerjaan_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'no_hp_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'nama_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'pekerjaan_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'no_hp_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },

                },

                submitHandler: function(page_data_diri) {
                    Swal.fire({
                        title: 'Pastikan data sudah benar?',
                        text: "Data yang telah di input tidak bisa berubah!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Simpan!',

                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Tunggu sebentar ...',
                                onBeforeOpen() {
                                    Swal.showLoading()
                                },
                                onAfterClose() {
                                    Swal.hideLoading()
                                },
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                allowEnterKey: false
                            })
                            $.ajax({
                                url: "<?php echo base_url('emis_regular/data_diri') ?>",
                                type: "POST",
                                data: $(page_data_diri).serialize(),
                                dataType: "json",
                                success: function(data) {
                                    if (data.error == false) {
                                        toastr.success(data.msg,
                                            'Success Mengisi Form!', {
                                                closeButton: true,
                                                progressBar: true,
                                                tapToDismiss: false
                                            })
                                        window.location.href =
                                            '<?php echo base_url('dashboard_peserta')?>'


                                    } else {
                                        toastr.error(data.msg,
                                            'Error Mengisi Form!!', {
                                                progressBar: true,
                                                allowHtml: true,
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                        swal.close();
                                    }
                                },
                            });
                        }
                    })

                }
            });


        }

        // end validation

    });

})
</script>
