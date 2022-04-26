(function($) {
    "use strict";
    $(document).ready(function(){

        //Custom JS

        $('#hamburger').on('click', function() {            
            $('.mobile-nav').addClass('show');
            $('.overlay').addClass('active');
        });

        $('.close-nav').on('click', function() {            
            $('.mobile-nav').removeClass('show');            
            $('.overlay').removeClass('active');          
        });

        $(".overlay").on("click", function () {
            $(".mobile-nav").removeClass("show");
            $('.overlay').removeClass('active');
        });

        $("#mobile-menu").metisMenu();
    
        $(".popup-link").magnificPopup({
            type: 'image',
            fixedContentPos: false
        });
    
        $(".popup-gallery").magnificPopup({
            type: 'image',
            fixedContentPos: false,
            gallery: {
                enabled: true
            },
            // other options
        });
    
        $(".popup-video, .popup-vimeo, .popup-gmap").magnificPopup({
            type: "iframe",
            mainClass: "mfp-fade",
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });        
    
        //FAQ toggle
        jQuery(".schema-faq-section .schema-faq-answer").hide();
        jQuery(".schema-faq-section .schema-faq-question").click( function(){ 
            jQuery(".schema-faq-section .schema-faq-question").removeClass('open-faq');
            if( jQuery(this).hasClass('open-faq') ){
                jQuery(this).removeClass('open-faq');
            } else {
                jQuery(this).addClass('open-faq');
            }
            jQuery(".schema-faq-section .schema-faq-answer").slideUp(); 
            jQuery(this).parent().find('.schema-faq-answer').slideDown(); 
        });

        //Contact Form Fileupload
        jQuery('input[type="file"]').on('change', function() {
            var text = jQuery(this).val();
            text = text.substring(text.lastIndexOf("\\") + 1, text.length);
            var span = jQuery("<span />").addClass("demo").html(text);
            jQuery(this).after(span);
        });
    });

    // Sticky Menu
    $(window).scroll(function() {
        var Width = $(document).width();

        if ($("body").scrollTop() > 120 || $("html").scrollTop() > 120) {
            if (Width > 767) {
                $(".header-wrapper").addClass("sticky-navbar");
                $(".header-wrapper .main-menu-wrapper").addClass("sticky");
            }
        } else {
            $(".header-wrapper").removeClass("sticky-navbar");
            $(".header-wrapper .main-menu-wrapper").removeClass("sticky");
        }
    });

    //Filters
    jQuery(".filter_products select").on('change', function () {
        var url = jQuery(this).val();
        location.href = url;
    });
        
})(jQuery); // End jQuery
