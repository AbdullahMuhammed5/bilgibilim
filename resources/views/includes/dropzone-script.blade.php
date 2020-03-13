<script type="text/javascript">
    Dropzone.autoDiscover = false;
    $(function () {
        if($('#dropzone')){
            let uploadedDocumentMap = {};
            const headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            };
            $('div#dropzone').dropzone({
                type: 'POST',
                url: '{{ url("files/store") }}',
                headers: headers,
                maxFilesize: 1,
                acceptedFiles: ".jpeg, .jpg, .png, .pdf, .xlsx",
                addRemoveLinks: true,
                removedfile: function(file)
                {
                    let name = file.upload ? file.upload.filename : file.name;
                    let type = file.type;

                    $.ajax({
                        headers: headers,
                        type: 'POST',
                        url: '{{ url("files/delete") }}',
                        data: {filename: name, type: type},
                        success: function (data){
                            console.log(name + " has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }
                    });
                    if(['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)){
                        $('#dropzone').find('input[name="images[]"][value="' + name + '"]').remove()
                    }else{
                        $('#dropzone').find('input[name="files[]"][value="' + name + '"]').remove()
                    }
                    let fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },
                init: function() {
                    @if(isset($news) || isset($event)) // on edit news or events

                        let thisDropzone = this;

                        $.get({
                        @if(isset($news))
                            url: '{{ url("/files/getFiles", ['id'=>$news->id, 'type'=>'News']) }}',
                            @elseif(isset($event))
                            url: '{{ url("/files/getFiles", ['id'=>$event->id, 'type'=>'Event']) }}',
                        @endif
                        headers: headers,
                        success : function(data) {

                            $.each(data, function(key, value){
                                let mockFile = { name: value.name,  size: value.size, type: value.type };
                                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                                if(value.type == 'xlsx' || value.type == 'pdf') {
                                    thisDropzone.options.thumbnail.call(thisDropzone, mockFile, '{{ asset("img/file.png") }}');
                                }else{
                                    thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "{{ Storage::url("path") }}".replace("path", value.name).replace('public/', ''));
                                }
                                @if($route == 'events')
                                    let previewElem = $('.dz-preview').has('img[alt="'+value.name+'"]').last();
                                    if('{{$event->cover}}' == value.name){
                                        $(previewElem).append('Select as cover <input type="radio" name="cover" checked value="'+value.name+'" class="cover-radio">')
                                    } else{
                                        $(previewElem).append('Select as cover <input type="radio" name="cover" value="'+value.name+'" class="cover-radio">')
                                    }
                                @endif
                            });
                        },
                        error: (err) => console.log(err)
                    });

                    @endif

                },
                success: function(file, response)
                {
                    let name = response;
                    if(['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)){
                        $('#dropzone').append('<input type="hidden" name="images[]" value="' + name + '">')
                        uploadedDocumentMap[name] = response.name
                    } else{
                        $('#dropzone').append('<input type="hidden" name="files[]" value="' + name + '">')
                        uploadedDocumentMap[name] = response.name
                    }
                    @if($route == 'events')
                        let previewElem = $('.dz-preview').has('img[alt="'+file.name+'"]').last();
                        $(previewElem).append('Select as cover <input type="radio" name="cover" value="'+name+'" class="cover-radio">')
                    @endif
                },
                error: function(file, response)
                {
                    return false;
                }
            })
        }
    });
</script>
