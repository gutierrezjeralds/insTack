//Scripts for like post
// var likeCount = 0;
var likeCountElement = 0;
var likeCountElementNew = 0;

if ($('.like-count-zero').val() == 0) {
    $('.like-count-zero').css("display", "none");
}

$("body").on("click", ".like", function(event){
    event.preventDefault();
    postId = $(this).closest('.view-post-data').attr('data-tack');
    likeCountElement = $(event.target).closest('.view-post-data').find('.like-count');
    var isLike = $(this).previousElementSibling == null;
    var iconLikeFind = $(event.target).find('span');
    var changClassIconLike = iconLikeFind.attr("class");
    var likeClassName = $(this).attr('class').split(' ').pop();
    var likeCountTextAdd = parseInt(likeCountElement.text()) + 1;
    var likeCountTextMinus = parseInt(likeCountElement.text()) - 1;
    //console.log(postId);

    if (likeClassName == 'unlikeThis') {
        $(this).removeClass("unlikeThis");
        $(this).addClass("likeThis");
        $(this).find('span').removeClass("fa-thumbs-o-up faa-bounce animated");
        $(this).find('span').addClass("fa-thumbs-up faa-bounce animated");

        likeCountElementNew = $(event.target).closest('.view-post-data').find('.like-count').text(likeCountTextAdd);
        if (likeCountElement.val() == 0) {
            likeCountElement.css("display", "inline-block");
        }
    }
    if (likeClassName == 'likeThis') {
        $(this).removeClass("likeThis");
        $(this).addClass("unlikeThis");
        $(this).find('span').removeClass("fa-thumbs-up faa-bounce animated");
        $(this).find('span').addClass("fa-thumbs-o-up");

        likeCountElementNew = $(event.target).closest('.view-post-data').find('.like-count').text(likeCountTextMinus);
        if (likeCountTextMinus == 0) {
            likeCountElement.css("display", "none");
        }
    }

    $.ajax({
        method: 'POST',
        url: urlLike,
        data:{isLike: isLike, postId: postId, _token: token},
        success: function () {

        }
    })
        .done(function (msg){
            //Change the page
            // event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You like this post' : 'Like' : event.target.innerText == 'Dislike' ? 'You don\'t like this post' : 'Dislike';
            // if (isLike){
            //     event.target.nextElementSibling.innerText = 'Dislike';
            // } else {
            //     event.target.previousElementSibling.innerText = 'Like';
            // }
        });
});
//End scripts for like post

//Scripts for edit post
var postId = 0;
var postcaptionElement = null;
$("body").on("click", ".edit-post", function(event){
    event.preventDefault();
    postId = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['tack'];
    postcaptionElement = $(event.target).closest('.view-post-data').find('.post-caption');
    var postcaption = postcaptionElement.html();
    //console.log(postcaption);
    $('#post-caption').html(postcaption);
    $('#editModal').modal();
});
$("body").on("click", "#editSave", function() {
    $.ajax({
        method: 'POST',
        url: urlEdit,
        data: {caption: $('#post-caption').html(), postId: postId, _token: token}
    })
        .done(function (msg){
            // console.log((msg['message']));
            // console.log(JSON.stringify(msg));
            $(postcaptionElement).html(msg['new_caption']);
            $('#editModal').hide();
        });
});
// End scripts for edit post

//Scripts for delete post with ajax
var postDeleteId = 0;
var postDeleteUserId = 0;
$("body").on("click", ".delete-post", function(event){
    event.preventDefault();
    postDeleteId = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['tack'];
    postDeleteUserId = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['unknown'];

    $.ajax({
        url:  '/deletepost/' + postDeleteUserId + '/' + postDeleteId,
        method: 'GET',
        success : function(data){
            $("div[data-tack='"+postDeleteId+"']").remove();
            $('.cover-photo-'+postDeleteId).attr("src", "/images/background/background-3.jpg");
            $('.avatar-photo-'+postDeleteId).attr("src", "{{$user->avatar}}");
            //console.log(data);
        }
    }); 
});
//End scripts for delete post with ajax

//Scripts for allow comment post with ajax
var postEnableComentId = 0;
$("body").on("click", ".comment-post", function(event){
    event.preventDefault();
    postEnableComentId = $(event.target).closest('.view-post-data').attr('data-tack');

    var comentFieldVal = $(event.target).closest('.view-post-data').find('.comment_hide_field').val();
    if (comentFieldVal == 0) {
        $('#comment-hide').val("1");
        $(event.target).closest('.view-post-data').find('.comment-post').find('span').text(' Enable comment');
        $(this).find('i').removeClass('fa-ban');
        $(this).find('i').addClass('fa-check');
        $(event.target).closest('.view-post-data').find('.comment-box').css("display","none");
    } else if (comentFieldVal == 1) {
        $('#comment-hide').val("0");
        $(event.target).closest('.view-post-data').find('.comment-post').find('span').text(' Disable comment');
        $(this).find('i').removeClass('fa-check');
        $(this).find('i').addClass('fa-ban');
        $(event.target).closest('.view-post-data').find('.comment-box').css("display","block");
    } else {
        $('#comment-hide').val("1");
        $(event.target).closest('.view-post-data').find('.comment-post').find('span').text(' Enable comment');
        $(this).find('i').removeClass('fa-check');
        $(this).find('i').addClass('fa-ban');
        $(event.target).closest('.view-post-data').find('.comment-box').css("display","block");
    }
    
    $.ajax({
        method: 'POST',
        url:  urlEnableComment,
        data: {comment_hide_value:$('#comment-hide').val(), postId: postEnableComentId, _token: token}
    })
        .done(function (msg){
            $(event.target).closest('.view-post-data').find('.comment_hide_field').val(msg['new_comment_hide']);
        });
});
//End scripts for allow comment post with ajax

//Scripts for copy post URL
var postIdClipboard;
$("body").on("click", ".copyButtonURL", function(event) {
    event.preventDefault();
    postIdClipboard = event.target.parentNode.parentNode.parentNode.parentNode.parentNode.dataset['tack'];
    var postClipboardInput = $('#copyTargetURL-'+postIdClipboard);

    copyToClipboard();

    function copyToClipboardFF(text) {
        window.prompt ("Copy to clipboard: Ctrl C, Enter", text);
    }

    function copyToClipboard() {
        var success   = true,
            range     = document.createRange(),
            selection;

        // For IE.
        if (window.clipboardData) {
            window.clipboardData.setData("Text", postClipboardInput.val());        
        } else {
            // Create a temporary element off screen.
            var tmpElem = $('<div>');
            tmpElem.css({
                position: "absolute",
                left:     "-1000px",
                top:      "-1000px",
            });
            // Add the input value to the temp element.
            tmpElem.text(postClipboardInput.val());
            $("body").append(tmpElem);
            // Select temp element.
            range.selectNodeContents(tmpElem.get(0));
            selection = window.getSelection ();
            selection.removeAllRanges ();
            selection.addRange (range);
            // Lets copy.
            try { 
              success = document.execCommand ("copy", false, null);
            }
            catch (e) {
              copyToClipboardFF(postClipboardInput.val());
            }
            if (success) {
              //alert ("The text is on the clipboard, try to paste it!");
              // remove temp element.
              tmpElem.remove();
            }
        }
    }
});
//End scripts for copy post URL

//Scripts for delete file upload from the list
var fileNameTempUploadDelete = null;
$("body").on("click", ".btn-file-upload-delete", function(event){
    event.preventDefault();
    fileNameTempUploadDelete = $(this).closest('.list-upload-file').find('.ajax-input-file-name').val();
    //console.log(fileNameTempUploadDelete);

    $.ajax({
        url:  '/deletefilefromlistuploadphoto/' + fileNameTempUploadDelete,
        method: 'GET',
        success : function(data){
            //Do Nothing
        }
    });

    $(this).closest('.list-upload-file').remove();
    if ($('.list-upload-file').length == 0) {
        $('.btn-pin-post-close').click();
    }
    if ($('.list-upload-file').length < 4) {
        $('.list-upload-file').removeClass('list-inline-item-post-style-limit');
    }
});
//End scripts for delete file upload from the list