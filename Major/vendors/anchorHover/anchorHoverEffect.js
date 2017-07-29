/*!
* jQuery anchor hover effect plugin ( Make your anchor tag fancy and animated)
* Original author: Satinder Singh 
* Blog: http://codepedia.info
* Demo: 
* Further changes, comments: 
* Licensed under the MIT license
*/


;(function ($, window, document, undefined) {

    $.fn.anchorHoverEffect = function (options) {

        // Establish our default settings
        var settings = $.extend({
            type: 'roller3d',
            foreColor: null
        }, options);

        return this.each(function () {
            var self = $(this);
            var txt = self.text();

            if (settings.type == 'roller3d') {
                self.html('<span data-txt="' + txt + '" >' + txt + '</span>').attr("class", "roller3d");
            } else if (settings.type == "underline") {
                self.wrap("<span  class='underline'></span>");
            } else if (settings.type == "brackets") {
                self.wrap("<span  class='brackets'></span>")
            } else if (settings.type == 'flip') {
                self.html('<span data-txt="' + txt + '" >' + txt + '</span>').wrap("<span class='flip'></span>");
            } else if (settings.type == 'roller3d2') {
                self.html('<span data-txt="' + txt + '" >' + txt + '</span>').attr("class", "roller3d2");
            } else if (settings.type == 'glow') {
                self.html('<span data-txt="' + txt + '" >' + txt + '</span>').wrap("<span class='glow'></span>");
            } else if (settings.type == "borderBottom") {
                self.wrap("<span  class='borderBottomEffect'></span>");
            }

            if ($.isFunction(settings.complete)) {
                settings.complete.call(this);
            }
        });

    }
})(jQuery, window, document);
