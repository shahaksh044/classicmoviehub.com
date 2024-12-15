(function ($) {
    "use strict";
    var n = window.AFTHRAMPES_JS || {};
    var fScrollPos = 0;

    /*Used for ajax loading posts*/
    var loadType, loadButtonContainer, loadBtn, loader, pageNo, loading, morePost, scrollHandling;
    /**/

    /* --------------- Background Image ---------------*/
    n.dataBackground = function () {
        $('.read-bg-img').each(function () {
            var src = $(this).find('img').attr('src');
            if (src) {
                $(this).css('background-image', 'url(' + src + ')').find('img').hide();
            }
        });
    },
        n.setLoadPostDefaults = function () {
            if ($('.morenews-load-more-posts').length > 0) {
                loadButtonContainer = $('.morenews-load-more-posts');
                loadBtn = $('.morenews-load-more-posts .aft-readmore');
                loader = $('.morenews-load-more-posts .ajax-loader');
                loadType = loadButtonContainer.attr('data-load-type');
                pageNo = 2;
                loading = false;
                morePost = true;
                scrollHandling = {
                    allow: true,
                    reallow: function () {
                        scrollHandling.allow = true;
                    },
                    delay: 400
                };
            }
        },
        n.getPostsOnScroll = function () {
            if ($('.morenews-load-more-posts').length > 0 && 'scroll' === loadType) {
                var container = $('.morenews-load-more-posts').closest('#primary');
                var fCurScrollPos = $(window).scrollTop();
                if (fCurScrollPos > fScrollPos) {
                    if (!loading && scrollHandling.allow && morePost) {
                        scrollHandling.allow = false;
                        setTimeout(scrollHandling.reallow, scrollHandling.delay);
                        var offset = $(loadButtonContainer).offset().top - $(window).scrollTop();
                        if (2000 > offset) {
                            loading = true;
                            n.renderPostsAjax();
                        }
                    }
                }
                fScrollPos = fCurScrollPos;
            }
        },
        n.getPostsOnClick = function () {
            if ($('.morenews-load-more-posts').length > 0 && 'click' === loadType) {
                $('.morenews-load-more-posts a').on('click', function (e) {
                    e.preventDefault();
                    var container = $(this).closest('#primary');
                    n.renderPostsAjax();

                });

            }
        },
        n.renderPostsAjax = function () {
            $.ajax({
                type: 'GET',
                url: AFurl.ajaxurl,
                data: {
                    action: 'morenews_load_more',
                    nonce: AFurl.nonce,
                    page: pageNo,
                    post_type: AFurl.post_type,
                    search: AFurl.search,
                    cat: AFurl.cat,
                    taxonomy: AFurl.taxonomy,
                    author: AFurl.author,
                    year: AFurl.year,
                    month: AFurl.month,
                    day: AFurl.day
                },
                dataType: 'json',
                beforeSend: function () {
                    loadBtn.hide();
                    loader.addClass('ajax-loader-enabled');
                },
                success: function (res) {
                    if (res.success) {
                        var $content_join = res.data.content.join('');
                        var $content = $($content_join);
                        $content.hide();
                        if ($('.aft-masonry-archive-posts').length > 0) {

                            var $grid = $('.aft-masonry-archive-posts');
                            $grid.append($content);
                            $grid.imagesLoaded(function () {
                                $content.fadeIn();
                                $grid.masonry('appended', $content);
                                loader.removeClass('ajax-loader-enabled');
                            });
                        } else {
                            $('.aft-archive-wrapper').append($content);

                            $content.fadeIn();
                            loader.removeClass('ajax-loader-enabled');

                            /*Set Bg Image if any*/
                            if ($content_join.indexOf("read-bg-img") >= 0) {
                                n.dataBackground();
                            }
                            $content.fadeIn();
                            loader.removeClass('ajax-loader-enabled');
                            $('[data-mh]').matchHeight({ remove: true });
                            $.fn.matchHeight._maintainScroll = true;
                            $.fn.matchHeight._applyDataApi();


                        }


                        pageNo++;
                        loading = false;
                        if (res.data.more_post) {
                            morePost = true;
                            loadBtn.fadeIn();
                        } else {
                            morePost = false;
                        }
                        loader.removeClass('ajax-loader-enabled');
                    } else {
                        loader.removeClass('ajax-loader-enabled');
                    }
                }
            });
        },
//Post view count
        n.PostCount = function () {

            if ($('body').hasClass('single-post')) {

                var flag = false;

                $(window).scroll(function (event) {


                    if (flag == true) {

                        return false;

                    }

                    var current_pos = $(this).scrollTop();

                    if (current_pos > 600) {

                        var stringid = $('.type-post').attr('id');

                        stringid = stringid.split('-');

                        var postid = stringid[1];

                        if (flag == false) {

                            $.ajax({
                                type: 'GET',
                                url: AFurl.ajaxurl,
                                data: {
                                    action: 'morenews_ajax_post_view_count',
                                    nonce: AFurl.nonce,
                                    post_id: postid,

                                },
                                success: function (response) {
                                    if (response == 'count_added') {
                                        //
                                    }

                                }
                            });
                        }

                        flag = true;
                    }

                });


            }

        },

        $(document).ready(function () {

            n.setLoadPostDefaults();
            n.getPostsOnClick();
            if (AFurl.view_count == true) {
                n.PostCount();
            }

        });

    $(window).scroll(function () {
        n.getPostsOnScroll();

    });

})(jQuery);