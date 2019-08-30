//Script for pin a post when reached the div create
var postCreateHeight = 0;
function postCreateScroll(){
    $(window).scroll(function() {
        postCreateHeight = $('.pannel-post-create-open').height() + 800;
        if ( $(window).scrollTop() > postCreateHeight ) {
            $('.btn-pin-post-close').click();
        }
    })
}
//End script for pin a post when reached the div create

//Script for pin a post when clicked outside of div
$('#hidden-dom').click(function() {
    //$('.btn-pin-post-close').click();
});
//End script for pin a post when clicked outside of div

//Scripts for pin a post
$('#btnWritePost').on('click', function() {
    postCreateScroll();

    $('.wrapper-create').addClass('hidden-dom-create-open');
    $('#hidden-dom').addClass('hidden-dom-open');
    $('.pannel-post-create-open').css("display","block");

    $('#btnWritePost').addClass('btnClicked');
    $('#btnUploadPhoto').removeClass('btnClicked');
    $('#btnUploadAudio').removeClass('btnClicked');
    $('#btnUploadVideo').removeClass('btnClicked');

    $('.pannel-post-create-open').find('#uploadWritePost').css("display", "block");
    $('.pannel-post-create-open').find('#uploadMediaPhoto').css("display","none");
    $('.pannel-post-create-open').find('#uploadMediaAudio').css("display", "none");
    $('.pannel-post-create-open').find('#uploadMediaVideo').css("display", "none");
});
$('#btnUploadPhoto').on('click', function() {
    $('#btnWritePost').removeClass('btnClicked');
    $('#btnUploadAudio').removeClass('btnClicked');
    $('#btnUploadVideo').removeClass('btnClicked');

    // var inputFilePhoto = $('.pannel-post-create-open').find('#uploadMediaPhoto').find("input[type='file']").val();
    // if (inputFilePhoto != '') {
    //     $('.pannel-post-create-open').find('#uploadMediaPhoto').css("display","block");
    // }
    var inputFilePhoto = $('.pannel-post-create-open').find('#uploadMediaPhoto').find(".hidden-config-file-uploader-photo").val();
    if (inputFilePhoto != 0) {
        $('.pannel-post-create-open').find('#uploadMediaPhoto').css("display","block");
    }

    $('.pannel-post-create-open').find('#uploadWritePost').css("display", "none");
    $('.pannel-post-create-open').find('#uploadMediaAudio').css("display", "none");
    $('.pannel-post-create-open').find('#uploadMediaVideo').css("display", "none");
});
$('#btnUploadAudio').on('click', function() {
    $('#btnWritePost').removeClass('btnClicked');
    $('#btnUploadPhoto').removeClass('btnClicked');
    $('#btnUploadVideo').removeClass('btnClicked');
    
    var inputFileAudio = $('.pannel-post-create-open').find('#uploadMediaAudio').find("input[type='file']").val();
    if (inputFileAudio != '') {
        $('.pannel-post-create-open').find('#uploadMediaAudio').css("display", "block");
    }

    $('.pannel-post-create-open').find('#uploadWritePost').css("display", "none");
    $('.pannel-post-create-open').find('#uploadMediaPhoto').css("display","none");
    $('.pannel-post-create-open').find('#uploadMediaVideo').css("display", "none");
});
$('#btnUploadVideo').on('click', function() {
    $('#btnWritePost').removeClass('btnClicked');
    $('#btnUploadPhoto').removeClass('btnClicked');
    $('#btnUploadAudio').removeClass('btnClicked');
    
    var inputFileVideo = $('.pannel-post-create-open').find('#uploadMediaVideo').find("input[type='file']").val();
    if (inputFileVideo != '') {
        $('.pannel-post-create-open').find('#uploadMediaVideo').css("display", "block");
    }

    $('.pannel-post-create-open').find('#uploadWritePost').css("display", "none");
    $('.pannel-post-create-open').find('#uploadMediaPhoto').css("display","none");
    $('.pannel-post-create-open').find('#uploadMediaAudio').css("display", "none");
});

$("#uploadWritePost div[contenteditable]").keyup(function(){
    if ($('#uploadWritePost div[contenteditable]').text().trim().length == 0) {
        $('.btn-pin-write-post').attr("disabled", "disabled");
    } else {
        $('.btn-pin-write-post').removeAttr("disabled");
    }

    var editableCountDiv = $(this).find('div').length;
    if (editableCountDiv > 4) {
        $('#captionBg').val('');
        $(this).removeClass('caption-style-post caption-style').css("background", "none");
        $('.caption-bg-list').css("display","none");
        $('#uploadWritePost').find('.media-left').css("display","table-cel");
    }
    if (editableCountDiv < 4) {
        $('.caption-bg-list').css("display","block");
    }

    var editableCountText = $(this).text().trim().length;
    if(editableCountText > 104){
        $('#captionBg').val('');
        $(this).removeClass('caption-style-post caption-style').css("background", "none");
        $('.caption-bg-list').css("display","none");
        $('#uploadWritePost').find('.media-left').css("display","table-cell");
    }
    if (editableCountText < 104) {
        $('.caption-bg-list').css("display","block");
    }
});


function hexc(captionBgValue) {
    var parts = captionBgValue.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
        parts[i] = parseInt(parts[i]).toString(16);
        if (parts[i].length == 1) parts[i] = '0' + parts[i];
    }
    captionBg = '#' + parts.join('');
}

var captionBg = '';
$('.caption-bg-list li').click(function() {
    var captionBgStyle = $(this).css('backgroundColor');
    hexc(captionBgStyle);
    $('.write-post-holder').find('.caption-write-post-here').css("background", captionBg);
    if (captionBg != '#ffffff') {
        $('#captionBg').val(captionBg);
        $('#uploadWritePost').find('.media-left').css("display","none");
        $('#uploadWritePost').find('.write-post-holder').addClass('write-post-div').find('.caption-write-post-here').addClass('caption-style-post caption-style');
    } else {
        $('#captionBg').val('');
        $('#uploadWritePost').find('.media-left').css("display","table-cell");
        $('#uploadWritePost').find('.write-post-holder').removeClass('write-post-div').find('.caption-write-post-here').removeClass('caption-style-post caption-style');
    }
})

$('form').on('submit', function() {
    $('.btn-pin-post').attr("disabled", "disabled");

    var textareaPost = $(this).find('textarea');
    var captionPost  = $(this).find('.caption').html();
    textareaPost.val(captionPost);
});

$('.btn-pin-post-close').on('click', function(event){
    $.ajax({
        url:  '/deleteallfilefromlistupload',
        method: 'GET',
        success : function(data){
            //Do Nothing
        }
    });

    $(window).unbind('.pannel-post-create-open');

    $('.wrapper-create').removeClass('hidden-dom-create-open');
    $('#hidden-dom').removeClass('hidden-dom-open');

    $('.pannel-post-create-open').css("display","none");
    $('#btnWritePost').removeClass('btnClicked');
    $('#btnUploadPhoto').removeClass('btnClicked');
    $('#btnUploadAudio').removeClass('btnClicked');
    $('#btnUploadVideo').removeClass('btnClicked');

    $('.caption').empty();
    $('#caption').val('');
    $('.btn-pin-write-post').attr("disabled", "disabled");

    $('.caption-bg-list').css("display","block");
    $('.write-post-holder').find('.caption-write-post-here').removeClass('caption-style-post caption-style').css("background","none");

    var inputFilePhoto = $('.pannel-post-create-open').find('#uploadMediaPhoto').find(".hidden-config-file-uploader-photo").val();
    if (inputFilePhoto != 0) {
        $('#btnUploadPhoto').attr("onclick", "event.preventDefault(); document.getElementById('ajax-upload-id-photo[]').click();");
        $(".hidden-config-file-uploader-photo").val("0");
    }
    $('.pannel-post-create-open').find('#uploadMediaPhoto').css("display","none");

    $('.upload-file-photo-caption').css("display","none");
    $('.list-post-upload-photo').remove();
    $('.btn-pin-upload-photo-post').attr("disabled", "disabled");

    $('#btnUploadAudio').attr("onclick", "event.preventDefault(); document.getElementById('postAudio').click();");
    $('.pannel-post-create-open').find('#uploadMediaAudio').css("display","none");

    $('.upload-file-audio-caption').css("display","none");
    $('.list-post-upload-audio').remove();
    $('.btn-pin-upload-audio-post').attr("disabled", "disabled");

    $('#btnUploadVideo').attr("onclick", "event.preventDefault(); document.getElementById('postVideo').click();");
    $('.pannel-post-create-open').find('#uploadMediaVideo').css("display","none");

    $('.upload-file-video-caption').css("display","none");
    $('.list-post-upload-video').remove();
    $('.btn-pin-upload-video-post').attr("disabled", "disabled");

    $('.list-post-upload-avatar').remove();

    $('.list-post-upload-cover').remove();
    $('.cover-photo-holder').find('.cover-photo-default').css("display","block");
    $('.cover-photo-holder').find('.btn-upload-cover').css({"display":"none","visibility":"visible"});
    $('.cover-photo-holder').find('.btn-save-cover').css("display","none");
    $('.cover-photo-holder').find('.btn-cancel-cover').css("display","none");
    $('.cover-photo-holder').find('.cover-position-text').css("visibility","hidden");

    // var $el = $('.upload-file-input');
    // $el.wrap('<form>').closest('form').get(0).reset();
    // $el.unwrap();

    uploadPhoto.reset();

    //if ($('.multi-field', $wrapper).length > 1)
    if(navigator.userAgent.toUpperCase().indexOf('MSIE') >= 0){
       $('.wrapper-content').find("input[type='file']").replaceWith($("input[type='file']").clone(true));
    } else {
        $('.wrapper-content').find("input[type='file']").val('');
    }
});
//End scripts for pin a post

//Scripts for change profile picture
$('.avatar-holder-img').mouseover(function() {
    $('.a-avatar-change').css("display", "block");
});

$('.avatar-holder-img').mouseout(function() {
    $('.a-avatar-change').css("display", "none");
});

var $uploadCrop;

$uploadCrop = $('#avatarPreview').croppie({
    enableExif: true,
    viewport: {
        width: 180,
        height: 180,
        type: 'circle'
    },
    boundary: {
        width: "100%",
        height: "400"
    }
});

function readFile(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $('#avatarPreview').addClass('ready');
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function(){
                //console.log('jQuery bind complete');
            });
            
        }
        
        reader.readAsDataURL(input.files[0]);
    }
    else {
        swal("Sorry - you're browser doesn't support the FileReader API");
    }
}

$("#uploadAvatarSave").on("click", function (event) {
    $uploadCrop.croppie('result', {
        type: 'canvas',
        size: 'viewport'
    }).then(function (responce) {
        $('#avatarbase64').val(responce);
        $('#UploadAvatarWithCrop').submit();
    });
});
//End scripts for change profile picture

//Scripts for change cover photo
$('.cover-photo-holder').mouseover(function() {
    $('.btn-upload-cover').css("display", "inline-block");
});

$('.cover-photo-holder').mouseout(function() {
    $('.btn-upload-cover').css("display", "none");
});
//End scripts for change cover photo

//File upload with preview
var uploadPhoto = $("#file-uploader-photo").uploadFile({
    url: "/postsharephotoauto",
    fileName: "photo",
    inputFileName: 'photoFile[]',
    acceptFiles: "image/*",
    onSelect: function (files) {
        for(var i = 0; i < files.length; i++) {
            var fileExtension = '.' + files[i].name.split('.').pop();
            files[i].name = "1609141608152015" + new Date().getTime() + Math.random().toString(36).substring(7) + fileExtension;
        }

        $('#btnUploadPhoto').addClass('btnClicked');
        $('#btnWritePost').removeClass('btnClicked');
        $('#btnUploadAudio').removeClass('btnClicked');
        $('#btnUploadVideo').removeClass('btnClicked');

        postCreateScroll();

        $('.wrapper-create').addClass('hidden-dom-create-open');
        $('#hidden-dom').addClass('hidden-dom-open');
        $('.pannel-post-create-open').css("display","block");

        $('#btnUploadPhoto').removeAttr("onclick");
        $('.pannel-post-create-open').find('#uploadMediaPhoto').css("display","block");

        $('.upload-file-photo-caption').css("display","block");

        $('.hidden-config-file-uploader-photo').val("1");
    },
    onSubmit: function (files) {
        if ($('.list-upload-file').length > 3) {
            $('.list-upload-file').addClass('list-inline-item-post-style-limit');
            $("html,body").animate({ scrollTop: 0 }, "slow");
        }
    },
    onSuccess: function (files, data) {
        if(files != ""){
            $('#photoPreview').find('.list-upload-file').append("<div class='btn-file-upload-delete ajax-file-upload-red'><i class='fa fa-trash fa-1x'></i></div>")
            $('.btn-pin-upload-photo-post').removeAttr("disabled");
            $('.ajax-file-upload-progress').css("display","none");
        }
    },
});

// $("#postPhoto").on('change', function (){
//     //$('#uploadPostModal').modal();
//     var total_file = document.getElementById("postPhoto").files.length;
//     for(var i = 0; i < total_file; i++) {
//         $('#btnUploadVideo').addClass('btnClicked');
//         $('#btnWritePost').removeClass('btnClicked');
//         $('#btnUploadAudio').removeClass('btnClicked');
//         $('#btnUploadPhoto').removeClass('btnClicked');

//         postCreateScroll();

//         $('.wrapper-create').addClass('hidden-dom-create-open');
//         $('#hidden-dom').addClass('hidden-dom-open');
//         $('.pannel-post-create-open').css("display","block");

//         $('#btnUploadPhoto').removeAttr("onclick");
//         $('.pannel-post-create-open').find('#uploadMediaPhoto').css("display","block");

//         $('#photoPreview').find('ul').prepend("<li class='list-inline-item list-inline-item-post list-post-upload-photo'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></li>");
        
//         $('.upload-file-photo-caption').css("display","block");
//         $('.btn-pin-upload-photo-post').removeAttr("disabled");
//     }
// });

$("#postAudio").on('change', function (){
    //$('#uploadPostModal').modal();
    var total_file = document.getElementById("postAudio").files.length;
    for(var i = 0; i < total_file; i++) {
        $('#btnUploadAudio').addClass('btnClicked');
        $('#btnWritePost').removeClass('btnClicked');
        $('#btnUploadPhoto').removeClass('btnClicked');
        $('#btnUploadVideo').removeClass('btnClicked');

        postCreateScroll();

        $('.wrapper-create').addClass('hidden-dom-create-open');
        $('#hidden-dom').addClass('hidden-dom-open');
        $('.pannel-post-create-open').css("display","block");

        $('#btnUploadAudio').removeAttr("onclick");
        $('.pannel-post-create-open').find('#uploadMediaAudio').css("display","block");

        $('#audioPreview').find('ul').prepend("<li class='list-inline-item list-inline-item-post list-post-upload-audio'><audio controls style='width: 100%'><source src='"+URL.createObjectURL(event.target.files[i])+"' type='audio/mp3'></audio></li>");
        
        $('.upload-file-audio-caption').css("display","block");
        $('.btn-pin-upload-audio-post').removeAttr("disabled");
    }
});

$("#postVideo").on('change', function (){
    //$('#uploadPostModal').modal();
    var total_file = document.getElementById("postVideo").files.length;
    for(var i = 0; i < total_file; i++) {
        $('#btnUploadVideo').addClass('btnClicked');
        $('#btnWritePost').removeClass('btnClicked');
        $('#btnUploadPhoto').removeClass('btnClicked');
        $('#btnUploadAudio').removeClass('btnClicked');

        postCreateScroll();

        $('.wrapper-create').addClass('hidden-dom-create-open');
        $('#hidden-dom').addClass('hidden-dom-open');
        $('.pannel-post-create-open').css("display","block");

        $('#btnUploadVideo').removeAttr("onclick");
        $('.pannel-post-create-open').find('#uploadMediaVideo').css("display","block");

        $('#videoPreview').find('ul').prepend("<li class='list-inline-item list-inline-item-post list-post-upload-video'><video controls style='width: 100%'><source src='"+URL.createObjectURL(event.target.files[i])+"' type='video/mp4'></video></li>");
        
        $('.upload-file-video-caption').css("display","block");
        $('.btn-pin-upload-video-post').removeAttr("disabled");
    }
});

$("#postAvatar").on('change', function (){
    $('#uploadAvatarModal').modal();
    readFile(this); 

    // var total_file = document.getElementById("postAvatar").files.length;
    // for(var i = 0; i < total_file; i++) {
    //     $('#avatarPreview').find('ul').prepend("<li class='list-inline-item list-post-upload-avatar'><img class='img-responsive' src='"+URL.createObjectURL(event.target.files[i])+"'></li>");
    // }
});

$("#postCoverPhoto").on('change', function (){
    //$('#uploadCoverPhotoModal').modal();
    var total_file = document.getElementById("postCoverPhoto").files.length;
    for(var i = 0; i < total_file; i++) {
        $('#coverPreview').prepend("<img class='list-post-upload-cover cover-photo-img' src='"+URL.createObjectURL(event.target.files[i])+"'>");
        $('.cover-photo-holder').find('.cover-photo-default').css("display","none");
        $('.cover-photo-holder').find('.btn-upload-cover').css({"display":"none","visibility":"hidden"});
        $('.cover-photo-holder').find('.btn-save-cover').css("display","block");
        $('.cover-photo-holder').find('.btn-cancel-cover').css("display","block");
        $('.cover-photo-holder').find('.cover-position-text').css("visibility","visible");
    }

    //Script for draggable cover photo
    $('.cover-photo-img').draggable({
        cursor: "move",
        //containment: ".cover-photo-holder",
        opacity: 0.6,
        drag: function(){
            var $this = $(this);
            var thisPos = $this.position();
            var parentPos = $this.parent().position();

            var xPos = thisPos.left - parentPos.left;
            var yPos = thisPos.top - parentPos.top;

            var coverPosition = 'left:' + xPos + 'px; top:' + yPos + 'px;';
            $('.cover-photo-position-field').val(coverPosition);
        }
    });
    //Endcript for draggable cover photo
});
//End file upload with preview