<script>
function switchPage(page) {

    $(".formContent").attr('style', 'display:none')
    $(".step").removeClass("active dstepper-block")
    switch (page) {
        case 'jalur':
            $("#jalur").removeAttr("style");
            $("#step-jalur").addClass("active");
            break;
        case 'dataDiri':
            $("#dataDiri").removeAttr("style");
            $("#step-data-diri").addClass("active");
            break;
        case 'alamat':
            $("#alamat").removeAttr("style");
            $("#step-alamat").addClass("active");
            break;
        case 'asalSekolah':
            $("#asalSekolah").removeAttr("style");
            $("#step-asal-sekolah").addClass("active");
            break;
        case 'ortu':
            $("#ortu").removeAttr("style");
            $("#step-orang-tua").addClass("active");
            break;
        case 'berkas':
            sessionStorage.setItem("reloading", "true");
            document.location.reload();
            break;
    }
}

function switchPageBerkas() {
    $(".formContent").attr('style', 'display:none')
    $(".step").removeClass("active dstepper-block")
    $("#berkas").removeAttr("style");
    $("#step-berkas").addClass("active");
}

$(function() {
    'use strict';

    var reloading = sessionStorage.getItem("reloading");
    if (reloading) {
        sessionStorage.removeItem("reloading");
        switchPageBerkas();
    }

    $('#next-jalur').click(function() {
        Swal.fire({
            title: 'Informasi',
            text: "Sudah memilih jalur dengan benar?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Pilih!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo base_url('emis/pilih_jalur') ?>",
                    type: "POST",
                    data: $('#form-jalur').serialize(),
                    dataType: "json",
                    success: function(data) {

                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('dataDiri')

                        } else {
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    },
                });
            }
        })
    })

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
                    'nik': {
                        required: true,
                    },
                    'tempat_lahir': {
                        required: true,
                    },
                    'jenis_kelamin': {
                        required: true,
                    },
                    'hobi': {
                        required: true,
                    },
                    'cita': {
                        required: true,
                    },
                    'jumlah_saudara': {
                        required: true,
                    },
                    'anak_ke': {
                        required: true,
                    },
                    'tinggi': {
                        required: true,
                    },
                    'berat': {
                        required: true,
                    },
                    'lingkar_kepala': {
                        required: true,
                    },
                    'pernah_tk': {
                        required: true,
                    },
                    'pernah_paud': {
                        required: true,
                    },
                    'hepatitis_b': {
                        required: true,
                    },
                    'polio': {
                        required: true,
                    },
                    'bcg': {
                        required: true,
                    },
                    'campak': {
                        required: true,
                    },
                    'dpt': {
                        required: true,
                    },

                },
                messages: {
                    'nik': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'tempat_lahir': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'jenis_kelamin': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'hobi': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'cita': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'jumlah_saudara': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'anak_ke': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'tinggi': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'berat': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'lingkar_kepala': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'pernah_tk': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'pernah_paud': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'hepatitis_b': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'polio': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'bcg': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'campak': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'dpt': {
                        required: 'Tidak Boleh Kosong',
                    },

                },

                submitHandler: function(page_data_diri) {
                    Swal.fire({
                        title: 'Informasi',
                        text: "Data yang telah di input sudah benar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Simpan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?php echo base_url('emis/data_diri') ?>",
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
                                        switchPage('alamat')

                                    } else {
                                        toastr.error(data.msg,
                                            'Error Mengisi Form!!', {
                                                progressBar: true,
                                                allowHtml: true,
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                    }
                                },
                            });
                        }
                    })

                }
            });


        }
        // end data diri

        // alamat

        var page_alamat = $('#form-alamat');

        // jQuery Validation
        // --------------------------------------------------------------------
        if (page_alamat.length) {
            page_alamat.validate({

                onkeyup: function(element) {
                    $(element).valid();
                },
                rules: {
                    'alamat': {
                        required: true,
                    },
                    'provinsi': {
                        required: true,
                    },
                    'status_sekolah': {
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
                    'jarak_rumah': {
                        required: true,
                    },
                    'transportasi': {
                        required: true,
                    }

                },
                messages: {
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
                    'jarak_rumah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'transportasi': {
                        required: 'Tidak Boleh Kosong',
                    }
                },

                submitHandler: function(page_alamat) {
                    Swal.fire({
                        title: 'Informasi',
                        text: "Data yang telah di input sudah benar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Simpan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?php echo base_url('emis/alamat') ?>",
                                type: "POST",
                                data: $(page_alamat).serialize(),
                                dataType: "json",
                                success: function(data) {
                                    if (data.error == false) {
                                        toastr.success(data.msg,
                                            'Success Mengisi Form!', {
                                                closeButton: true,
                                                progressBar: true,
                                                tapToDismiss: false
                                            })
                                        switchPage('asalSekolah')

                                    } else {
                                        toastr.error(data.msg,
                                            'Error Mengisi Form!!', {
                                                progressBar: true,
                                                allowHtml: true,
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                    }
                                },
                            });
                        }
                    })

                }
            });


        }
        // end validation

        // alamat

        // end alamat
        var page_sekolah = $('#form-asal-sekolah');

        // jQuery Validation
        // --------------------------------------------------------------------
        if (page_sekolah.length) {
            page_sekolah.validate({

                onkeyup: function(element) {
                    $(element).valid();
                },
                rules: {
                    'asal_sekolah': {
                        required: true,
                    },
                    'jenis_sekolah': {
                        required: true,
                    },
                    'kota': {
                        required: true,
                    },
                    'kota_sekolah': {
                        required: true,
                    }

                },
                messages: {
                    'asal_sekolah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'jenis_sekolah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'status_sekolah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'kota_sekolah': {
                        required: 'Tidak Boleh Kosong',
                    }
                },

                submitHandler: function(page_sekolah) {
                    Swal.fire({
                        title: 'Informasi',
                        text: "Data yang telah di input sudah benar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Simpan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?php echo base_url('emis/sekolah') ?>",
                                type: "POST",
                                data: $(page_sekolah).serialize(),
                                dataType: "json",
                                success: function(data) {
                                    if (data.error == false) {
                                        toastr.success(data.msg,
                                            'Success Mengisi Form!', {
                                                closeButton: true,
                                                progressBar: true,
                                                tapToDismiss: false
                                            })
                                        switchPage('ortu')

                                    } else {
                                        toastr.error(data.msg,
                                            'Error Mengisi Form!!', {
                                                progressBar: true,
                                                allowHtml: true,
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
                                    }
                                },
                            });
                        }
                    })

                }
            });


        }
        // end validation

        var page_ortu = $('#form-ortu');

        // jQuery Validation
        // --------------------------------------------------------------------
        if (page_ortu.length) {
            page_ortu.validate({

                onkeyup: function(element) {
                    $(element).valid();
                },
                rules: {
                    'no_kk': {
                        required: true,
                    },
                    'no_ktp_ayah': {
                        required: true,
                    },
                    'nama_ayah': {
                        required: true,
                    },
                    'tempat_lahir_ayah': {
                        required: true,
                    },
                    'tgl_lahir_ayah': {
                        required: true,
                    },
                    'pendidikan_ayah': {
                        required: true,
                    },
                    'pekerjaan_ayah': {
                        required: true,
                    },
                    'no_hp_ayah': {
                        required: true,
                    },
                    'status_ayah': {
                        required: true,
                    },
                    'no_ktp_ibu': {
                        required: true,
                    },
                    'nama_ibu': {
                        required: true,
                    },
                    'tempat_lahir_ibu': {
                        required: true,
                    },
                    'tgl_lahir_ibu': {
                        required: true,
                    },
                    'pendidikan_ibu': {
                        required: true,
                    },
                    'pekerjaan_ibu': {
                        required: true,
                    },
                    'no_hp_ibu': {
                        required: true,
                    },
                    'status_ibu': {
                        required: true,
                    },
                    'penghasilan_ortu': {
                        required: true,
                    },

                },
                messages: {
                    'no_kk': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'no_ktp_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'nama_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'tempat_lahir_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'tgl_lahir_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'pendidikan_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'pekerjaan_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'no_hp_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'status_ayah': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'no_ktp_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'nama_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'tempat_lahir_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'tgl_lahir_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'pendidikan_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'pekerjaan_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'no_hp_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'status_ibu': {
                        required: 'Tidak Boleh Kosong',
                    },
                    'penghasilan_ortu': {
                        required: 'Tidak Boleh Kosong',
                    },
                },

                submitHandler: function(page_ortu) {
                    Swal.fire({
                        title: 'Informasi',
                        text: "Data yang telah di input sudah benar?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Simpan!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "<?php echo base_url('emis/orang_tua') ?>",
                                type: "POST",
                                data: $(page_ortu).serialize(),
                                dataType: "json",
                                success: function(data) {
                                    if (data.error == false) {
                                        toastr.success(data.msg,
                                            'Success Mengisi Form!', {
                                                closeButton: true,
                                                progressBar: true,
                                                tapToDismiss: false
                                            })
                                        switchPage('berkas')

                                    } else {
                                        toastr.error(data.msg,
                                            'Error Mengisi Form!!', {
                                                progressBar: true,
                                                allowHtml: true,
                                                closeButton: true,
                                                tapToDismiss: false
                                            });
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


    $("#keterangan_lulus").change(function() {
        Swal.fire({
            title: 'Upload File?',
            text: "Upload Data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upload!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = "<?php echo base_url('emis/berkas_keterangan_lulus') ?>";
                var formData = new FormData();
                formData.append("keterangan_lulus", $("#keterangan_lulus").get(0).files[0]);
                $.ajax({
                    url: link,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function() {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('berkas')

                        } else {
                            swal.close()
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            }
        })
    });

    $("#berkas_nisn").change(function() {
        Swal.fire({
            title: 'Upload File?',
            text: "Upload Data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upload!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = "<?php echo base_url('emis/berkas_nisn') ?>";
                var formData = new FormData();
                formData.append("berkas_nisn", $("#berkas_nisn").get(0).files[0]);
                $.ajax({
                    url: link,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function() {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('berkas')

                        } else {
                            swal.close()
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            }
        })
    });

    $("#berkas_rapot").change(function() {
        Swal.fire({
            title: 'Upload File?',
            text: "Upload Data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upload!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = "<?php echo base_url('emis/berkas_rapot') ?>";
                var formData = new FormData();
                formData.append("berkas_rapot", $("#berkas_rapot").get(0).files[0]);
                $.ajax({
                    url: link,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function() {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('berkas')

                        } else {
                            swal.close()
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            }
        })
    });

    $("#berkas_akte").change(function() {
        Swal.fire({
            title: 'Upload File?',
            text: "Upload Data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upload!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = "<?php echo base_url('emis/berkas_akte') ?>";
                var formData = new FormData();
                formData.append("berkas_akte", $("#berkas_akte").get(0).files[0]);
                $.ajax({
                    url: link,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function() {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('berkas')

                        } else {
                            swal.close()
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            }
        })
    });

    $("#berkas_kk").change(function() {
        Swal.fire({
            title: 'Upload File?',
            text: "Upload Data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upload!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = "<?php echo base_url('emis/berkas_kk') ?>";
                var formData = new FormData();
                formData.append("berkas_kk", $("#berkas_kk").get(0).files[0]);
                $.ajax({
                    url: link,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function() {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('berkas')

                        } else {
                            swal.close()
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            }
        })
    });

    $("#berkas_ktp_ortu").change(function() {
        Swal.fire({
            title: 'Upload File?',
            text: "Upload Data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upload!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = "<?php echo base_url('emis/berkas_ktp_ortu') ?>";
                var formData = new FormData();
                formData.append("berkas_ktp_ortu", $("#berkas_ktp_ortu").get(0).files[0]);
                $.ajax({
                    url: link,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function() {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('berkas')

                        } else {
                            swal.close()
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            }
        })
    });

    $("#berkas_foto").change(function() {
        Swal.fire({
            title: 'Upload File?',
            text: "Upload Data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upload!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = "<?php echo base_url('emis/berkas_foto') ?>";
                var formData = new FormData();
                formData.append("berkas_foto", $("#berkas_foto").get(0).files[0]);
                $.ajax({
                    url: link,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function() {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('berkas')

                        } else {
                            swal.close()
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                        }
                    }
                });
            }
        })
    });

    $("#berkas_khusus").change(function() {
        Swal.fire({
            title: 'Upload File?',
            text: "Upload Data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Upload!'
        }).then((result) => {
            if (result.isConfirmed) {
                var link = "<?php echo base_url('emis/berkas_khusus') ?>";
                var formData = new FormData();
                formData.append("berkas_khusus", $("#berkas_khusus").get(0).files[0]);
                $.ajax({
                    url: link,
                    type: 'POST',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    dataType: "JSON",
                    beforeSend: function() {
                        swal.fire({
                            title: 'Menunggu',
                            html: 'Memproses data',
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function(data) {
                        if (data.error == false) {
                            toastr.success(data.msg, 'Success!', {
                                closeButton: true,
                                progressBar: true,
                                tapToDismiss: false
                            })
                            switchPage('berkas')

                        } else {
                            swal.close()
                            toastr.error(data.msg, 'Error!', {
                                progressBar: true,
                                allowHtml: true,
                                closeButton: true,
                                tapToDismiss: false
                            });
                            switchPage('berkas')

                        }
                    }
                });
            }
        })
    });

    $("#btn_simpan").click(function() {
        var nilai_mtk = $("#nilai_mtk").val()
        var nilai_ipa = $("#nilai_ipa").val()
        var nilai_ips = $("#nilai_ips").val()
        var nilai_agama = $("#nilai_agama").val()
        var link = "<?php echo base_url('emis/save') ?>";

        if (nilai_mtk == '' && nilai_ipa == '' && nilai_ips == '' && nilai_agama == '') {
            toastr.error("Mohon isi semua formulir", 'Error!', {
                progressBar: true,
                allowHtml: true,
                closeButton: true,
                tapToDismiss: false
            });
        } else {
            Swal.fire({
                title: 'Perhatian!',
                text: "Cek kembali semua data yang telah terisi, data tidak bisa di ubah kembali ketika selesai!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Selesai!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: link,
                        type: 'POST',
                        data: {
                            nilai_mtk: nilai_mtk,
                            nilai_ipa: nilai_ipa,
                            nilai_ips: nilai_ips,
                            nilai_agama: nilai_agama
                        },
                        dataType: "JSON",
                        beforeSend: function() {
                            swal.fire({
                                title: 'Menunggu',
                                html: 'Memproses data',
                                onOpen: () => {
                                    swal.showLoading()
                                }
                            })
                        },
                        success: function(data) {
                            if (data.error == false) {
                                toastr.success(data.msg, 'Success!', {
                                    closeButton: true,
                                    progressBar: true,
                                    tapToDismiss: false
                                })
                                location.reload();

                            } else {
                                swal.close()
                                toastr.error(data.msg, 'Error!', {
                                    progressBar: true,
                                    allowHtml: true,
                                    closeButton: true,
                                    tapToDismiss: false
                                });

                            }
                        }
                    });
                }
            })
        }

    })

})
</script>
