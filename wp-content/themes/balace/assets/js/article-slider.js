document.addEventListener('DOMContentLoaded', function() {
    var swiper = new Swiper('.swiper-container-article', {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            420: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 30
            }
        }
    });
});

jQuery(document).ready(function($) {
    var postIndex = 2; 
    var postsPerPage = 2; 


    function showMorePosts() {
        var $hiddenPosts = $('#article-list-mob .article-item-mob').filter(':hidden');
        if ($hiddenPosts.length > 0) {
            $hiddenPosts.slice(0, postsPerPage).show();
            postIndex += postsPerPage;

     
            if ($hiddenPosts.length <= postsPerPage) {
                $('#load-more-posts-mob').hide();
            }
        }
    }

  
    $('#load-more-posts-mob').on('click', function() {
        showMorePosts();
    });
});
