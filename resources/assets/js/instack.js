
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('../../../node_modules/bootstrap-select/dist/js/bootstrap-select.min');
require('../../../node_modules/bootstrap-datepicker//dist/js/bootstrap-datepicker.min');
require('../../../node_modules/jquery-ui-dist/jquery-ui.min');
require('../../../node_modules/croppie/croppie.min');
require('./components/jquery.uploadfile');
require('./components/appMenu');
require('./components/appNav');
require('./components/postClicked');
require('./components/postEach');
require('./components/postCreate');
//require('../../../node_modules/dropzone/dist/dropzone');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
//     el: '#app'
// });

//$(".dropzone").dropzone({ url: '/postsharephotoauto' });

//Scripts for displaying post create div after load
$(document).ready(function() {
    $('.btn-post-create').delay(2000).show(0);
    $('.btn-post-create-load').delay(2000).hide(0);
});
//End scripts for displaying post create div after load

if (urlName == 'register') {
    //Script for Birthday picker
    require('./components/bootstrap-birthday');
    $('.birthday-field').bootstrapBirthday({
        widget: {
            wrapper: {
                tag: 'div',
                class: 'row'
            },
            wrapperYear: {
                use: true,
                tag: 'div',
                class: 'col-md-4'
            },
            wrapperMonth: {
                use: true,
                tag: 'div',
                class: 'col-md-4'
            },
            wrapperDay: {
                use: true,
                tag: 'div',
                class: 'col-md-4'
            },
            selectYear: {
                name: 'birthday[year]',
                class: 'selectpicker form-control reg-year',
            },
            selectMonth: {
                name: 'birthday[month]',
                class: 'selectpicker form-control reg-month',
            },
            selectDay: {
                name: 'birthday[day]',
                class: 'selectpicker form-control reg-day',
            }
        }
    });
    //End script for Birthday picker
} else {
    //Scripts for pin a post
    document.querySelector("#uploadWritePost div[contenteditable]").addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertHTML", false, text);
        });

        document.querySelector("#uploadMediaPhoto div[contenteditable]").addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertHTML", false, text);
        });

        document.querySelector("#uploadMediaAudio div[contenteditable]").addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertHTML", false, text);
        });

        document.querySelector("#uploadMediaVideo div[contenteditable]").addEventListener("paste", function(e) {
            e.preventDefault();
            var text = e.clipboardData.getData("text/plain");
            document.execCommand("insertHTML", false, text);
        });
    //End scripts for pin a post
}

//Script for Ajax token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
//End script for Ajax token

//Scripts for post ajax loading more
$(document).ready(function() {
    var postPage = 1;
    $(window).scroll(function() {
        if( $(window).scrollTop() + $(window).height() >= $(document).height() ) {
            postPage++;
            loadMoreData(postPage);
        }
    });

    function loadMoreData(postPage){
        $.ajax({
            url: '?page=' + postPage,
            type: "get",
            beforeSend: function(){
                $('.ajax-post-load-more').css("display","block");
            },
            success: function(data){
                $("#post-data").append(data.html);
            },
            complete: function(data){
                if ( data.html == '' ) {
                    $('.alert-no-more-stories').css("display","block");
                } else {
                    $('.ajax-post-load-more').css("display","block");
                }
            },
            error: function(xhr,status,error){
                console.log('Server not responding...');
            }
        });
    }
});
//End scripts for post ajax loading more

//Scripts for context Menu for image upload
$('img').on("contextmenu",function(e){
   //return false;
});
//End scripts for context Menu for image upload

//Scripts for carousel interval
// interval is in milliseconds. 1000 = 1 second - so 1000 * 10 = 10 seconds
$('.carousel').carousel({
    interval: 1000 * 10
});
//End scripts for carousel interval