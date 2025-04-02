(function ($) {
	"use strict";


    //document ready function
    jQuery(document).ready(function($){
		$(".news-update").ticker();
		$(".news-update").removeClass('news-noload');
		$('body').on("click", function() {
			$(".slicknav_nav").removeClass('mhide');
		  });

		 $("#newsx-paper-menu").newsxPaperAccessibleDropDown();

        }); // end document ready
		

	 $.fn.newsxPaperAccessibleDropDown = function () {
    var el = $(this);

    $("a", el)
        .on("focus", function () {
            $(this).parents("li").addClass("hover");
        })
        .on("blur", function () {
            var that = this;
            setTimeout(function () {
                if (!$(that).parents("li").find("a:focus").length) {
                    $(that).parents("li").removeClass("hover");
                }
            }, 10);
        })
        .on("keydown", function (e) {
            var parentLi = $(this).parent("li");

            // Detect Shift + Tab
            if (e.shiftKey && e.key === "Tab") {
                var prevElement = $(this).parent("li").prev().find("a").last();
                if (prevElement.length) {
                    prevElement.focus();
                    e.preventDefault();
                }
            }
        });
};


}(jQuery));	