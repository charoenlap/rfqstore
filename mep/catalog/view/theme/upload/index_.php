<!-- ไม่ได้ใช้ -->


<input type="hidden" name="<?php echo $name;?>" id="upload_selectpath_<?php echo $module;?>" value="">
<img src="http://placehold.it/200x200/&text=No%20Image" alt="preview" id="upload_preview_<?php echo $module;?>" class="img-thumbnail mb-2 img-fluid"><br>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#model_upload_<?php echo $module;?>"><i class="far fa-image"></i></button>
<button type="button" class="btn btn-outline-danger" id="upload_removeimg_<?php echo $module;?>"><i class="far fa-trash-alt"></i></button>
<div class="modal" tabindex="-1" role="dialog" id="model_upload_<?php echo $module;?>">
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
                        <button type="button" id="upload_return_<?php echo $module;?>" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i></button>
                        <button type="button" id="upload_home_<?php echo $module;?>" class="btn btn-outline-dark"><i class="fas fa-home"></i></button>
                        <button type="button" id="upload_list_<?php echo $module;?>" class="btn btn-outline-dark"><i class="fas fa-sync-alt"></i></button>
                        <input type="file" id="upload_file_<?php echo $module;?>" class="d-none"> 
                        <button type="button" id="upload_deldir_<?php echo $module;?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        <button type="button" id="upload_select_<?php echo $module;?>" class="btn btn-primary"><i class="far fa-image"></i></button>
                        <button type="button" id="upload_submitupload_<?php echo $module;?>" class="d-none"></button>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="text" id="upload_dirname_<?php echo $module;?>" value="" class="form-control" placeholder="New Folder" />
                            <div class="input-group-append">
                                <button type="button" id="upload_newdir_<?php echo $module;?>" class="btn btn-outline-dark"><i class="fas fa-folder-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mb-2">
                        <div class="input-group">
                            <input type="text" id="upload_searchtxt_<?php echo $module;?>" value="" class="form-control" placeholder="Search" />
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <input type="text" id="upload_path_<?php echo $module;?>" value="" class="form-control-plaintext" readonly  />
                    </div>

                </div>
                <div id="load_<?php echo $module;?>">
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery(document).ready(function($) {
    loadimg<?php echo $module;?>('/');
    

    $('#upload_submitupload_<?php echo $module;?>').hide();

    $('#model_upload_<?php echo $module;?>').on('shown.bs.modal', function (e) {
        $('#upload_list_<?php echo $module;?>').trigger('click'); 
        loadimg<?php echo $module;?>('/');
    });
    $('#upload_removeimg_<?php echo $module;?>').click(function(event) {
        $('#upload_preview_<?php echo $module;?>').attr('src','http://placehold.it/200x200/&text=No%20Image');
        $('#upload_selectpath_<?php echo $module;?>').val('');
    });

    $('#upload_searchtxt_<?php echo $module;?>').keyup(function(event) {
        var search = $('#upload_searchtxt_<?php echo $module;?>').val();
        var path = $('#upload_path_<?php echo $module;?>').val();
        loadimg<?php echo $module;?>(path,search);
    });
    $('#upload_home_<?php echo $module;?>').click(function(event) {
        $('#upload_selectpath_<?php echo $module;?>').val('');
        loadimg<?php echo $module;?>('/');
    });
     $('#upload_return_<?php echo $module;?>').click(function(event) {
        var path = $('#upload_path_<?php echo $module;?>').val().split('/');
        var newpath = [];
        $.each(path, function(index, val) {
            if (val) {
                newpath.push(val);
            }
        });
        newpath.pop();
        $('#upload_selectpath_<?php echo $module;?>').val('');
        loadimg<?php echo $module;?>(newpath.join('/'));
    }); 

    $('#upload_select_<?php echo $module;?>').click(function(event) {
        $('#upload_file_<?php echo $module;?>').trigger('click');
    });
    $('#upload_file_<?php echo $module;?>').change(function(event) {
        $('#upload_submitupload_<?php echo $module;?>').trigger('click');
    });
    $("#upload_submitupload_<?php echo $module;?>").click(function(){
        var fd = new FormData();
        var files = $('#upload_file_<?php echo $module;?>')[0].files[0];
        fd.append('file',files);
        fd.append('path', $('#upload_path_<?php echo $module;?>').val());
        $.ajax({
            url: '<?php echo route('upload/uploadfile'); ?>',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    var path = $('#upload_path_<?php echo $module;?>').val();
                    loadimg<?php echo $module;?>(path);
                }else{
                    alert('file not uploaded');
                }
            },
        });
    });

    $('#upload_list_<?php echo $module;?>').click(function(event) {
        var path = $('#upload_path_<?php echo $module;?>').val();
        loadimg<?php echo $module;?>(path);
    });
    $('#load_<?php echo $module;?>').on('click', '.selectimg', function(event) {
        event.preventDefault();
        var path = $('#upload_path_<?php echo $module;?>').val();
        var thispath = $(this).data('path');
        $('#upload_selectpath_<?php echo $module;?>').val(path+thispath);
        $('#upload_preview_<?php echo $module;?>').attr('src','<?php echo MURL;?>uploads'+path+thispath);
        loadimg<?php echo $module;?>('/');
        $('#model_upload_<?php echo $module;?>').modal('hide');
    });
    $('#load_<?php echo $module;?>').on('click', '.folder', function(event) {
        event.preventDefault();
        var path = $('#upload_path_<?php echo $module;?>').val().split('/');
        var newpath = [];
        $.each(path, function(index, val) {
            if (val) {
                newpath.push(val);
            }
        });
        newpath.push($(this).data('path'));
        loadimg<?php echo $module;?>(newpath.join('/'));
    });

    $('#upload_newdir_<?php echo $module;?>').click(function(event) {
        var nowpath = $('#upload_path_<?php echo $module;?>').val();
        $.ajax({
            url: '<?php echo route('upload/makedir'); ?>',
            type: 'POST',
            data: {path: nowpath, name: $('#upload_dirname_<?php echo $module;?>').val()},
            // dataType: 'json',
            success: function(response){
                console.log(response);
                if (response) {
                    $('#upload_dirname_<?php echo $module;?>').val('');
                    $('#upload_list_<?php echo $module;?>').trigger('click'); 
                    $('#upload_selectpath_<?php echo $module;?>').val('');
                }
            },
        });
    });
    $('#upload_deldir_<?php echo $module;?>').click(function(event) {
        if (confirm('ยืนยันการลบ ทั้ง Folder และ File ในนี้จะหายไปทั้งหมด')) {
            var nowpath = $('#upload_path_<?php echo $module;?>').val();
            $('#load_<?php echo $module;?> [type="checkbox"]:checked').each(function(index, el) {
                $.ajax({
                    url: '<?php echo route('upload/removedir'); ?>',
                    type: 'POST',
                    data: {path: nowpath+$(this).data('path')},
                    // dataType: 'json',
                    success: function(response){
                        $('#upload_list_<?php echo $module;?>').trigger('click'); 
                        $('#upload_selectpath_<?php echo $module;?>').val('');
                    },
                });
            });
        }
    });
   
    function loadimg<?php echo $module;?>(folderpath = '', searchtxt = '') {
        $.ajax({
            url: '<?php echo route('upload/load'); ?>',
            type: 'post',
            data: {path: folderpath, search: searchtxt},
            dataType: 'json',
            success: function(response){
                $('#load_<?php echo $module;?>').html(response.html);
                $('#upload_path_<?php echo $module;?>').val(response.path);
            },
        });
    }
});
</script>