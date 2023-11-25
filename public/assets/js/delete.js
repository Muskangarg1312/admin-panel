var base_url = $('base').attr('href');

$(document).ready(function() {
    $('.confirm_del_btn').click(function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var keyword = $(this).data('keyword');
        console.log('id = '+id);
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                $.ajax({
                    url:  base_url + '/' + keyword + '/' + id + '/delete',
                    success: function (response) {
                        swal({
                            title: response.status,
                            text: response.status_text,
                            type: response.type,
                        });
                        if (response.type === 'success') {
                            window.location.reload();
                        }
                    }
                });
            } else {
                window.location.reload();
            }
        });
    });
});
