
/**
* Theme: Codefox Admin Template
* Author: Coderthemes
 * Email: coderthemes@gmail.com
* File Uploads
*/

$(document).ready(function(){

	'use-strict';

    //Example single
    $('#filer_input_single').filer({
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd'],
        changeInput: true,
        showThumbs: true,
        addMore: false
    });

    //Example 2

    $('#filer_input_excel').filer({
        limit: null,
        maxSize: null,
        // extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd'],
        extensions: ['xlsx', 'xls','csv'],
        changeInput: true,
        showThumbs: true,
        addMore: true,

        captions: {
            button: "Chọn tệp Excel",
            feedback: "Chọn files để Upload",
            feedback2: "files đã được chọn",
            drop: "Drop file here to Upload",
            removeConfirmation: "Bạn có muốn xóa file khỏi upload ?",
            errors: {
                filesLimit: "Chỉ cho phép {{fi-limit}} files được upload lên hệ thống !.",
                filesType: "Vui lòng chọn đúng định dạng file excel vd: *.xlsx,*.xls !",
                filesSize: "{{fi-name}} kích thước quá lớn! Vui lòng upload file dưới {{fi-maxSize}} MB.",
                filesSizeAll: "Tất cả các file tổng dung lượng quá lớn! Vui lòng upload dưới {{fi-maxSize}} MB."
            }
        }
    });
    $('#filer_input_audio').filer({
        limit: 1,
        maxSize: null,
        // extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd'],
        extensions: ['mp3', 'aac','wav','flac','wma','ogg','aiff','alac'],
        changeInput: true,
        showThumbs: true,
        addMore: true,

        captions: {
            button: "Chọn tệp âm thanh",
            feedback: "Chọn files để Upload",
            feedback2: "files đã được chọn",
            drop: "Drop file here to Upload",
            removeConfirmation: "Bạn có muốn xóa file khỏi upload ?",
            errors: {
                filesLimit: "Chỉ cho phép {{fi-limit}} files được upload lên hệ thống !.",
                filesType: "Vui lòng chọn đúng định dạng file âm thanh vd: *.mp3,*.wav,... !",
                filesSize: "{{fi-name}} kích thước quá lớn! Vui lòng upload file dưới {{fi-maxSize}} MB.",
                filesSizeAll: "Tất cả các file tổng dung lượng quá lớn! Vui lòng upload dưới {{fi-maxSize}} MB."
            }
        }
    });
    $('#filer_input_image').filer({
        limit: 1,
        maxSize: null,
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'psd'],       
        changeInput: true,
        showThumbs: true,
        addMore: true,

        captions: {
            button: "Chọn tệp hình ảnh",
            feedback: "Chọn files để Upload",
            feedback2: "files đã được chọn",
            drop: "Drop file here to Upload",
            removeConfirmation: "Bạn có muốn xóa file khỏi upload ?",
            errors: {
                filesLimit: "Chỉ cho phép {{fi-limit}} files được upload lên hệ thống !.",
                filesType: "Vui lòng chọn đúng định dạng file hình ảnh vd: *.jpg,*.png,.. !",
                filesSize: "{{fi-name}} kích thước quá lớn! Vui lòng upload file dưới {{fi-maxSize}} MB.",
                filesSizeAll: "Tất cả các file tổng dung lượng quá lớn! Vui lòng upload dưới {{fi-maxSize}} MB."
            }
        }

    });

	//Example 1
    $("#filer_input1").filer({
        limit: null,
        maxSize: null,
        extensions: null,
        changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag & Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn btn btn-primary waves-effect waves-light">Browse Files</a></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-info">\
                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
                                    </div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            itemAppend: '<li class="jFiler-item">\
                            <div class="jFiler-item-container">\
                                <div class="jFiler-item-inner">\
                                    <div class="jFiler-item-thumb">\
                                        <div class="jFiler-item-status"></div>\
                                        <div class="jFiler-item-info">\
                                            <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
                                            <span class="jFiler-item-others">{{fi-size2}}</span>\
                                        </div>\
                                        {{fi-image}}\
                                    </div>\
                                    <div class="jFiler-item-assets jFiler-row">\
                                        <ul class="list-inline pull-left">\
                                            <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
                                        </ul>\
                                        <ul class="list-inline pull-right">\
                                            <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                        </ul>\
                                    </div>\
                                </div>\
                            </div>\
                        </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: true,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        dragDrop: {
            dragEnter: null,
            dragLeave: null,
            drop: null,
        },
        uploadFile: {
            url: "../plugins/jquery.filer/php/upload.php",
            data: null,
            type: 'POST',
            enctype: 'multipart/form-data',
            beforeSend: function(){},
            success: function(data, el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
                });
            },
            error: function(el){
                var parent = el.find(".jFiler-jProgressBar").parent();
                el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
                    $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
                });
            },
            statusCode: null,
            onProgress: null,
            onComplete: null
        },
		files: [
			{
				name: "Desert.jpg",
				size: 145,
				type: "image/jpg",
				file: "../files/assets/images/file-upload/Desert.jpg"
			},
			{
				name: "overflow.jpg",
				size: 145,
				type: "image/jpg",
				file: "../files/assets/images/file-upload/Desert.jpg"
			}
		],
        addMore: false,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        afterShow: null,
        onRemove: function(itemEl, file, id, listEl, boxEl, newInputEl, inputEl){
            var file = file.name;
            $.post('../plugins/jquery.filer/php/remove_file.php', {file: file});
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "Choose Files",
            feedback: "Choose files To Upload",
            feedback2: "files were chosen",
            drop: "Drop file here to Upload",
            removeConfirmation: "Are you sure you want to remove this file?",
            errors: {
                filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Vui lòng chọn đúng định dạng file excel vd: *.xlsx,*.xls !",
                filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
            }
        }
    });
});