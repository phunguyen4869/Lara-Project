// X-CSRF-TOKEN
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

//remove ajax
function removeRow(id, url) {
    if (confirm('Bạn có chắc chắn muốn xóa mục này không?')) {
        $.ajax({type: 'DELETE',
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

//Upload file
$('#upload').change(function () {
    const form = new FormData();
    form.append('file', $(this)[0].files[0]);
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

// //active product status
// $('.product-active-btn').click(function () {
//     alert('Product active');
// });

//change product status
function changeProductStatus(id, url, status) {
    if(confirm('Bạn có chắc chắn muốn thay đổi trạng thái không?')){
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
