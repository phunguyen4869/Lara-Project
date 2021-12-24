// X-CSRF-TOKEN
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Bạn có chắc chắn muốn xóa danh mục này không?')) {
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
