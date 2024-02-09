
$(document).ready(function () {

    $(document).ready(function()
    {
    //number formatting.
    $('.numeric2').number(true, 2);
    $('.numeric0').number(true);
    $("[decimals*='2']").number(true, 2);
    $("[decimals*='0']").number(true);
    })


  
    $(function() {
        $('#summernote1').summernote()
        $('#summernote2').summernote()
    })
    
    $('input[name="SeasonTag"]').amsifySuggestags({
        suggestions: ['Summer', 'Spring', 'Fall', 'Winter'],
    });
    
    $('input[name="MaterialTag"]').amsifySuggestags({
        suggestions: ['SATIN SILK', 'LINEN'],
    });
    
    
    $("#fotoUpload").change(function(){
        var DID = $("#DID").val();
        var link = BASE_URL + funct + '/upload_photo';
        var formData = new FormData();
        formData.append("fotoProduk", $("#fotoUpload").get(0).files[0]);
        formData.append("idproduk", DID);
        $.ajax( {
            url        : link,
            type       : 'POST',
            contentType: false,
            cache      : false,
            processData: false,
            data       : formData,
            xhr        : function ()
            {
                var jqXHR = null;
                if ( window.ActiveXObject ){
                    jqXHR = new window.ActiveXObject( "Microsoft.XMLHTTP" );
                }else{
                    jqXHR = new window.XMLHttpRequest();
                }
                jqXHR.upload.addEventListener( "progress", function ( evt ){
                    if ( evt.lengthComputable ){
                        var percentComplete = Math.round( (evt.loaded * 100) / evt.total );
                        $("#prosesUpload").html("mengunggah: "+percentComplete+"%");
                    }
                }, false );
                return jqXHR;
            },
            success    : function ( data )
            {
                $("#prosesUpload").html("");
                loadResult();
            }
        } );
    });
    
    function loadResult(){
        var DID = $("#DID").val();
        var link = BASE_URL + funct + '/upload_photo_result/' + DID;
    
        // $("#foto-produk").html("mohon tunggu sebentar...");
        $.post(link,function(msg){
            var data = eval("("+msg+")");
            console.log(data);
            if(data.success == true){
                // $("#foto-produk").html("");
                var html = `<div class="uploadfoto-item">
                <img src="`+ data.data.path +`">
                <button type="button" class="utama" disabled="">foto utama</button>
            </div>`;
                $("#foto-produk").append(html);
            }
        });
    }
    
    })
    
    function cekIsiVariasi(){
        if($("#variasi").html() == ""){
            $(".novariasi").show();
        }
    }

    var variantcount = 0;
    function tambahVariasi() {
        variantcount = variantcount + 1
        console.log(variantcount);

        setTimeout(() => {
            $('.my-colorpicker2').colorpicker()
    
            $('.my-colorpicker2').on('colorpickerChange', function(event) {
              $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
            })
        
    
        }, 500);
        $("#variasi").append($("#variasitambah").html());
        $(".novariasi").hide();
        $("#belumada").hide();
    }


    $("#variasi").on('click', '.hapusvariasi', function() {
        
        var therem = $(this).parents(".form-group");
        swal.fire({
            title: "Yakin menghapus variasi?",
            text: "variasi akan dihapus, dan tidak dapat dikembalikan lagi",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal"
        }).then((val) => {
            if (val.value) {
                
                variantcount = variantcount - 1
                console.log(variantcount);

                therem.remove();
                if (!$("#variasi input").val()) {
                    $("#stok").show();
                    $("#belumada").show();
                    $(".novariasi").show();
                }
            }
        });
    });
    $("#variasi").on('click', '.hapusvariasion', function() {
        var therem = $(this).parents(".form-group");
        var varid = $(this).data("varid");
    
        swal.fire({
            title: "Yakin menghapus variasi?",
            text: "variasi akan dihapus, dan tidak dapat dikembalikan lagi, termasuk stok juga akan habis",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal"
        }).then((val) => {
            if (val.value) {
                $.post("<?= site_url('products/hapusvariasi') ?>", {
                    "theid": varid,
                    [$("#names").val()]: $("#tokens").val()
                }, function(e) {
                    var data = eval("(" + e + ")");
                    updateToken(data.token);
                    if (data.success == true) {
                        therem.remove();
                        if (!$("#variasi input").val()) {
                            $("#stok").show();
                            $("#belumada").show();
                            $(".novariasi").show();
                            
                        }
                    } else {
                        swal.fire("Gagal", "gagal menghapus variasi, coba ulangi beberapa saat lagi", "danger");
                    }
                });
            }
        });
    });
    
    function SaveProduct() {
        
        if(variantcount < 1)
        {
            swal.fire({
                title: "Warning",
                text: "Data variant harus terisi",
                type: "error"
            })
        }else
        {
            var DID = $("#DID").val();
            var link = BASE_URL + funct + '/add/' + DID;
            var form = $('#form1').serialize();
                form +="&" + $("#variasi").serialize();
            $.ajax({
                type: "post",
                url: link,
                data: form,
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
        
    }
    