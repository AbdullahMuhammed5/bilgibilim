$(function () {

    // Checkboxes
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green',
    });

    // file chosen select
    $(".chosen-select").select2({
        tags: true,
        max_selected_options: 5
    });

    // handle request for authors based on post type
    $('#news-type').change(function(){
        let type = $(this).val();
        $.ajax({
            type:"get",
            url: `${window.location.origin}/getAuthorsByJob/${type}`,
            headers : {
                "Access-Control-Allow-Origin" : "*"},
            success:function(res){
                if(res){
                    $('#author-wrapper').css('display', 'block')
                    $("#author").empty();
                    $("#author").append('<option value="">Select Author</option>');
                    $.each(res, function(key, value){
                        $("#author").append('<option value="'+key+'">'+value+'</option>');
                    });
                }
            },
            error: (err) => console.log(err)
        });
    });

    // handle request for cities based on it's country
    $('#country').change(function(){
        let cid = $(this).val();
        if(cid){
            $.ajax({
                type:"get",
                url: `${window.location.origin}/getCities/${cid}`,
                success:function(res){
                    if(res){
                        $('#city-wrapper').css('display', 'block')
                        $("#city").empty();
                        $("#city").append('<option value="">Select City</option>');
                        $.each(res, function(key, value){
                            $("#city").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }
            });
        }
    });

    // handle upload image request
    $.each($('.upload-files'), function(){
        $(this).change(()=>{
            let csrf_token = $('meta[name="csrf-token"]').attr('content');
            event.preventDefault();
            let formData = new FormData();
            let files = $(this)[0].files;
            for (let i = 0; i < files.length; i++){
                formData.append("files[]", files[i]);
            }

            $.ajax({
                method: 'post',
                url: `${window.location.origin}/uploadToServer`,
                data: formData ,
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                headers: { 'X-CSRF-TOKEN': csrf_token },
                success: (res) => console.log(res.success),
                error: (err) => console.log(err)
            })
        });
    });

    Dropzone.autoDiscover = false;
    $('.datetimepicker').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss',
    });

});
