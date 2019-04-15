(function($){

    var defaults = {
        stickies: '.stick',
        offset: 0
    };

    var _scroll = function( settings, $stickies ){
        $(settings.stickies).each(function(i){
            var $thisSticky = $(this),
                $stickyPosition = $thisSticky.data('originalPosition');

            if ($stickyPosition <= $(settings.parent).scrollTop()) {

                var $nextSticky = $stickies.eq(i + 1),
                    $nextStickyPosition = $nextSticky.data('originalPosition') - $thisSticky.data('originalHeight');

                $thisSticky.addClass("sticked");

                if ($nextSticky.length > 0 && $thisSticky.offset().top >= $nextStickyPosition) {
                    $thisSticky.addClass("absolute").css("top", $nextStickyPosition);
                }
                
                if ($nextSticky.offset() != undefined)
                {    
                    var $nextStickyOffset = $nextSticky.offset().top - settings.offset;
                    if ($nextStickyOffset <= $thisSticky.height())
                    {
                        $thisSticky.css("top", (-Math.abs($thisSticky.height()-$nextStickyOffset)+settings.offset));
                    }
                }
                
            } else {

                var $prevSticky = $stickies.eq(i - 1);

                $thisSticky.removeClass("sticked");

                if ($prevSticky.length > 0 && $(settings.parent).scrollTop() <= $thisSticky.data('originalPosition') - $thisSticky.data('originalHeight')) {
                    $prevSticky.removeClass("absolute").removeAttr("style");
                }
            }

        });
    };
    
    $.fn.stick = function(options) {
        
        var settings = $.extend(defaults, options, {parent: this});
        
        var $stickies = $(settings.stickies).each(function(){
            var $wrapper = $(this).wrap('<div class="stick-wrapper" />');

            $wrapper
                .data('originalPosition', $wrapper.offset().top - settings.offset)
                .data('originalHeight', $wrapper.outerHeight())
                .parent()
                .height($wrapper.outerHeight());
        });

        settings.parent.off("scroll.stickies").on("scroll.stickies", function() {
            _scroll( settings, $stickies );
        });
    };

})(jQuery);