jQuery(document).ready(function($) {

    //jQuery('marquee').marquee();
    jQuery("#owl-featured-post").owlCarousel({
        autoPlay: 4000,
        slideSpeed : 1500,
        singleItem:true,
        navigation:true,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        pagination: false,
        mouseDrag :true
    });
    jQuery("#related-post").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items : 4,
        pagination : false,
        navigation:true,
        navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]

    });
    jQuery("#owl-gallery").owlCarousel({
        navigation : true, // Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true
        // "singleItem:true" is a shortcut for:
        // items : 1,
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false

    });

    var submitIcon = jQuery('.searchbox-icon');
    var inputBox = jQuery('.searchbox-input');
    var searchBox = jQuery('.searchbox');
    var isOpen = false;
    submitIcon.click(function(){
        if(isOpen == false){
            searchBox.addClass('searchbox-open');
            inputBox.focus();
            isOpen = true;
        } else {
            searchBox.removeClass('searchbox-open');
            inputBox.focusout();
            isOpen = false;
        }
    });
    submitIcon.mouseup(function(){
        return false;
    });
    searchBox.mouseup(function(){
        return false;
    });
        jQuery(document).mouseup(function(){
            if(isOpen == true){
                jQuery('.searchbox-icon').css('display','block');
                submitIcon.click();
            }
        });

    function buttonUp(){
        var inputVal = jQuery('.searchbox-input').val();
        inputVal = jQuery.trim(inputVal).length;
        if( inputVal !== 0){
            jQuery('.searchbox-icon').css('display','none');
        } else {
            jQuery('.searchbox-input').val('');
            jQuery('.searchbox-icon').css('display','block');
        }
    }
    jQuery(".menu-nav").affix({
        offset: {
            top: 200
        }
    });
    //var $document = $(document),
    //    $element = $('#menu-bar');
    //
    //$document.scroll(function() {
    //    if ($document.scrollTop() >= 50) {
    //        $element.stop().css({
    //            top: '0px'
    //        });
    //    } else {
    //        $element.stop().css({
    //            top: '-200px'
    //        });
    //    }
    //});



}(jQuery));
// Place any jQuery/helper plugins in here.
jQuery(document).ready(function($) {
    $(document).on("click", ".upload_image_button", function() {

        jQuery.data(document.body, 'prevElement', $(this).prev());

        window.send_to_editor = function(html) {
            var imgurl = jQuery('img',html).attr('src');
            var inputText = jQuery.data(document.body, 'prevElement');

            if(inputText != undefined && inputText != '')
            {
                inputText.val(imgurl);
            }

            tb_remove();
        };

        tb_show('', 'media-upload.php?type=image&TB_iframe=true');
        return false;
    });
});

