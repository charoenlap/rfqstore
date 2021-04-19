<div class="modal" tabindex="-1" role="dialog" id="modal_filemanager">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-4 mb-2">
                        <input type="hidden" id="upload_result" value=""> 
                        <input type="hidden" id="upload_preview" value=""> 
                        <button type="button" id="upload_return" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i></button>
                        <button type="button" id="upload_home" class="btn btn-outline-dark"><i class="fas fa-home"></i></button>
                        <button type="button" id="upload_list" class="btn btn-outline-dark"><i class="fas fa-sync-alt"></i></button>
                        <input type="file" id="upload_file" class="d-none"> 
                        <button type="button" id="upload_deldir" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        <button type="button" id="upload_select" class="btn btn-primary"><i class="far fa-image"></i></button>
                        <button type="button" id="upload_submitupload" class="d-none"></button>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="text" id="upload_dirname" value="" class="form-control" placeholder="New Folder" />
                            <div class="input-group-append">
                                <button type="button" id="upload_newdir" class="btn btn-outline-dark"><i class="fas fa-folder-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <div class="input-group">
                            <input type="text" id="upload_searchtxt" value="" class="form-control" placeholder="Search" />
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <input type="text" id="upload_path" value="" class="form-control-plaintext" readonly  />
                    </div>

                </div>
                <div id="upload_load">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function($) {
    var element_return;

    $('#upload_submitupload').hide();
    $('#modal_filemanager').on('show.bs.modal', function (e) {
        var button = $(e.relatedTarget)
        var eleresult = button.data('result');
        var elepreview = button.data('preview');
        $('#upload_result').val(eleresult);
        $('#upload_preview').val(elepreview);
        loadimg('/');
    });
    $('#upload_removeimg').click(function(event) {
        $('#upload_preview').attr('src','http://placehold.it/200x200/&text=No%20Image');
        $('#upload_selectpath').val('');
    });

    $('#upload_searchtxt').keyup(function(event) {
        var search = $('#upload_searchtxt').val();
        var path = $('#upload_path').val();
        loadimg(path,search);
    });
    $('#upload_home').click(function(event) {
        $('#upload_selectpath').val('');
        loadimg('/');
    });
     $('#upload_return').click(function(event) {
        var path = $('#upload_path').val().split('/');
        var newpath = [];
        $.each(path, function(index, val) {
            if (val) {
                newpath.push(val);
            }
        });
        newpath.pop();
        $('#upload_selectpath').val('');
        loadimg(newpath.join('/'));
    }); 

    $('#upload_select').click(function(event) {
        $('#upload_file').trigger('click');
    });
    $('#upload_file').change(function(event) {
        $('#upload_submitupload').trigger('click');
    });
    $("#upload_submitupload").click(function(){
        var fd = new FormData();
        var files = $('#upload_file')[0].files[0];
        fd.append('file',files);
        fd.append('path', $('#upload_path').val());
        $.ajax({
            url: '<?php echo route('upload/uploadfile'); ?>',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    var path = $('#upload_path').val();
                    loadimg(path);
                }else{
                    alert('file not uploaded');
                }
            },
        });
    });

    $('#upload_list').click(function(event) {
        var path = $('#upload_path').val();
        loadimg(path);
    });
    $('#upload_load').on('click', '.selectimg', function(event) {
        event.preventDefault();


        var path = $('#upload_path').val();
        var thispath = $(this).data('path');
        // $('#upload_selectpath').val(path+thispath);
        $($('#upload_result').val()).val(path+thispath);
        // $('#upload_preview').attr('src','<?php echo MURL;?>uploads'+path+thispath);
        $($('#upload_preview').val()).attr('src', '<?php echo MURL;?>uploads'+path+thispath);

        loadimg('/');
        $('#modal_filemanager').modal('hide');
    });
    $('#upload_load').on('click', '.folder', function(event) {
        event.preventDefault();
        var path = $('#upload_path').val().split('/');
        var newpath = [];
        $.each(path, function(index, val) {
            if (val) {
                newpath.push(val);
            }
        });
        newpath.push($(this).data('path'));
        loadimg(newpath.join('/'));
    });

    $('#upload_newdir').click(function(event) {
        var nowpath = $('#upload_path').val();
        $.ajax({
            url: '<?php echo route('upload/makedir'); ?>',
            type: 'POST',
            data: {path: nowpath, name: $('#upload_dirname').val()},
            // dataType: 'json',
            success: function(response){
                console.log(response);
                if (response) {
                    $('#upload_dirname').val('');
                    $('#upload_list').trigger('click'); 
                    $('#upload_selectpath').val('');
                }
            },
        });
    });
    $('#upload_deldir').click(function(event) {
        if (confirm('ยืนยันการลบ ทั้ง Folder และ File ในนี้จะหายไปทั้งหมด')) {
            var nowpath = $('#upload_path').val();
            $('#upload_load [type="checkbox"]:checked').each(function(index, el) {
                $.ajax({
                    url: '<?php echo route('upload/removedir'); ?>',
                    type: 'POST',
                    data: {path: nowpath+$(this).data('path')},
                    // dataType: 'json',
                    success: function(response){
                        $('#upload_list').trigger('click'); 
                        $('#upload_selectpath').val('');
                    },
                });
            });
        }
    });
   
    function loadimg(folderpath = '', searchtxt = '') {
        $.ajax({
            url: '<?php echo route('upload/load'); ?>',
            type: 'post',
            data: {path: folderpath, search: searchtxt},
            dataType: 'json',
            success: function(response){
                $('#upload_load').html(response.html);
                $('#upload_path').val(response.path);
            },
        });
    }
});
</script>