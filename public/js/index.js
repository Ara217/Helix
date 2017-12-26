(function ($) {
    'use strict';

    function Article(options) {}


    Article.prototype.init = function () {
        var that = this;

        if ($('#messageBlock').length > 0) {
            setTimeout(function(){   
                $('#messageBlock').hide();
            }, 3000);
        }
     
        $('#articleTable')
        .DataTable({
            dom: '<"webkit-scrollbar"t>p',
            ordering: false,
            bAutoWidth: false,
            bLengthChange: false,
            bInfo: false,
           
            "aaSorting": [[2,'asc']],
            ajax: {
                url: '/articles/getSavedArticles',
                type: 'POST'
            },
            columns: [
                {
                    data: "title", 
                    name: 'title', 
                    className: 'text-ellipsis max-width0 text-left'
                },
                {
                    data: "date", 
                    name: 'date'
                },
                {
                    data: "url", 
                    name: 'url',
                    className: 'text-ellipsis max-width0 text-left'
                },
                {
                    data: "show", 
                    name: 'show'
                },
                {
                    data: "update", 
                    name: 'update'
                },
                {
                    data: "delete", 
                    name: 'update'
                }
            ],
        }); 

        this.bindEvents();
    };

    Article.prototype.bindEvents = function () {};

    $( document ).ready(function() {
        var article = new Article();
        article.init();
    });
})(jQuery);


