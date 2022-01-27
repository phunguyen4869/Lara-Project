// X-CSRF-TOKEN
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//remove ajax
function removeRow(id, url) {
    if (confirm('Bạn có chắc chắn muốn xóa mục này không?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'json',
            data: {
                id
            },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    $(".table").load(location.href + " .table>*", "");
                } else {
                    alert('Xoá không thành công, vui lòng thử lại');
                }
            }
        });
    }
}

//remove permission of role ajax
function removePermission(roleID, permissionID, url) {
    if (confirm('Bạn có chắc chắn muốn thu hồi permission không?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'json',
            data: {
                roleID,
                permissionID
            },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    $(".table").load(location.href + " .table>*", "");
                } else {
                    alert('Thu hồi không thành công, vui lòng thử lại');
                }
            }
        });
    }
}

//Upload single image
$('#upload').change(function () {
    const form = new FormData();
    form.append('files[]', $(this)[0].files[0]);
    $.ajax({
        contentType: false,
        processData: false,
        type: 'POST',
        datatype: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results) {
            if (results.error === false) {
                $('#image_show').html('<a href="' + results.url + '" target="_blank"><img src="' + results.url + '" width="100px"></a>');

                $('#thumb').val(results.url);
            } else {
                alert('Upload không thành công, vui lòng thử lại');
            }
        }
    });
});

//upload multiple images
$('#upload_multiple').change(function () {
    $('#image_show_multi').html('');
    const form = new FormData();
    let filesCount = $(this)[0].files.length;
    for (let i = 0; i < filesCount; i++) {
        form.append('files[]', $(this)[0].files[i]);
    }
    $.ajax({
        contentType: false,
        processData: false,
        type: 'POST',
        datatype: 'JSON',
        data: form,
        url: '/admin/upload/services',
        success: function (results) {
            console.log(results.url[0]);
            if (results.error === false) {
                for (let i = 0; i < filesCount; i++) {
                    $('#image_show_multi').append('<a href="' + results.url[i] + '" target="_blank"><img src="' + results.url[i] + '" width="100px"></a>');
                }

                $('#thumb').val(results.url);
            } else {
                alert('Upload không thành công, vui lòng thử lại');
            }
        }
    });
});


// //active product status
// $('.product-active-btn').click(function () {
//     alert('Product active');
// });

//change product status
function changeStatus(id, url, status) {
    if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái không?')) {
        $.ajax({
            type: 'GET',
            datatype: 'json',
            data: {
                id,
                status
            },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    $(".table").load(location.href + " .table>*", "");
                } else {
                    alert('Thay đổi trạng thái không thành công, vui lòng thử lại');
                }
            }
        });
    }
}

$('#payment_method').change(function () {
    let value = $(this).find("option:selected").attr("value");

    switch (value) {
        case "credit_card":
            $('#credit_card').removeClass('hidden');
            $('#atm_card').addClass('hidden');
            break;

        case "atm_card":
            $('#atm_card').removeClass('hidden');
            $('#credit_card').addClass('hidden');
            break;

        case "cod":
            $('#atm_card').addClass('hidden');
            $('#credit_card').addClass('hidden');
            break;
    }
});
