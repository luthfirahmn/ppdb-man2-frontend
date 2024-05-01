$(document).on("click", ".browse", function () {
    var file = $(this).parents().find(".file");
    file.trigger("click");
});
$('input[type="file"]').change(function (e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});

//ajax add
$('#save').on('click', function () {

    if ($("#status_form").val() == 0) {
        var link = BASE_URL + funct + '/add';
    } else {
        var link = BASE_URL + funct + '/edit/';
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
});