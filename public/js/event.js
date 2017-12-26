(function ($) {
    'use strict';

    function CustomEvent(options) {}


    CustomEvent.prototype.init = function () {
        this.reader = new FileReader();
        this.bindEvents();
    };

    CustomEvent.prototype.bindEvents = function () {
        var that = this;
        $('#updateImage, #selectImage').on('change', that.readURL.bind(that));
    };

    CustomEvent.prototype.readURL = function (e) {
        var files =  e.target.files
        if (files && files[0]) {
            this.reader.onload = function(e) {
                if ($('#editArticle').length) {
                    $('#editArticle img').attr('src', e.target.result);    
                } else {
                    $('#createArticle img').attr('src', e.target.result);    
                }
                
            }
      
            this.reader.readAsDataURL(files[0]);
        }
    };

    $( document ).ready(function() {
        var event = new CustomEvent();
        event.init();
    });
})(jQuery);