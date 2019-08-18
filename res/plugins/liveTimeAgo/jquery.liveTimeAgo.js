/*!
 liveTimeAgo - 1.0.0
 Copyright © 2016 Florian Nicolas
 Licensed under the MIT license.
 https://github.com/ticlekiwi/jquery.liveTimeAgo.js
 !*/
(function ($) {
    $.fn.liveTimeAgo = function (options) {
        var timeOutID, timeIntervalID = null;

        var defauts =
        {
            translate: {
                'year': '% year ago',
                'years': '% years ago',
                'month':'% month ago',
                'months':'% months ago',
                'day': '% day ago',
                'days': '% days ago',
                'hour': '% hour ago',
                'hours': '% hours ago',
                'minute': '% minute ago',
                'minutes': '% minutes ago',
                'seconds': 'few seconds ago',
                'error': 'unknow time',
            }
        };

        if (typeof options == 'undefined') {
            options = defauts;
        }

        function dateDiff(date1, date2) {
            var diff = {};
            var tmp = date2 - date1;
            tmp = Math.floor(tmp / 1000);          
            diff.sec = tmp % 60;                  
            tmp = Math.floor((tmp - diff.sec) / 60);    
            diff.min = tmp % 60;                   
            tmp = Math.floor((tmp - diff.min) / 60);   
            diff.hour = tmp % 24;                   
            tmp = Math.floor((tmp - diff.hour) / 24);   
            diff.day = tmp;
            diff.year = date2.getFullYear() - date1.getFullYear();
            diff.month = (date2.getMonth() + 1) - (date1.getMonth() + 1);
            return diff;
        }

        function getFormattedDateAgo(date) {
            var diff = dateDiff(date, new Date());
            if (diff.year > 1) {
                return options.translate['years'].replace('%', diff.year);
            } else if (diff.year == 1) {
                return options.translate['year'].replace('%', diff.year);
            } else if (diff.month > 1) {
                return options.translate['months'].replace('%', diff.month);
            } else if (diff.month == 1) {
                return options.translate['month'].replace('%', diff.month);
            } else if (diff.day > 1) {
                return options.translate['days'].replace('%', diff.day);
            } else if (diff.day == 1) {
                return options.translate['day'].replace('%', diff.day);
            } else if (diff.hour > 1) {
                return options.translate['hours'].replace('%', diff.hour);
            } else if (diff.hour == 1) {
                return options.translate['hour'].replace('%', diff.hour);
            } else if (diff.min > 1) {
                return options.translate['minutes'].replace('%', diff.min);
            } else if (diff.min == 1) {
                return options.translate['minute'].replace('%', diff.min);
            } else if (diff.sec >= 1) {
                return options.translate['seconds'].replace('%', diff.sec);
            } else{
                return options.translate['error'];
            }
        }

        function refreshLive() {
            $('.liveTimeAgo-active').each(function () {
                var timeText = (typeof $(this).attr('data-lta-type') != 'undefined' && $(this).attr('data-lta-type') == 'timestamp') ? parseInt($(this).attr('data-lta-value')) : $(this).attr('data-lta-value');
                var time = new Date(timeText);
                $(this).text(getFormattedDateAgo(time));
            });
        }

        function runLive() {
            if (timeOutID !== null) {
                clearTimeout(timeOutID);
            }
            if (timeIntervalID !== null) {
                clearInterval(timeIntervalID);
            }
            var dateNow = new Date();
            var seconds = dateNow.getSeconds();
            var fake_secondes = 60 - seconds;
            /*console.log(fake_secondes); 往控制台输出log */
            var fakeInterval = setInterval(function () {
                    /*console.log(fake_secondes); 往控制台输出log*/
                    fake_secondes--;
                    if(fake_secondes < 0){
                        clearInterval(fakeInterval);
                    }
                }, 1000);
            timeOutID = setTimeout(function () {
                refreshLive();
                timeIntervalID = setInterval(function () {
                    refreshLive();
                }, 60 * 1000);
            }, (60 - seconds) * 1000);
        }

        this.each(function () {
            if(typeof $(this).attr('data-lta-value') != 'undefined') {
                var timeText = (typeof $(this).attr('data-lta-type') != 'undefined' && $(this).attr('data-lta-type') == 'timestamp') ? $(this).attr('data-lta-value') * 1000 : $(this).attr('data-lta-value');
            }else{
                var timeText = (typeof $(this).attr('data-lta-type') != 'undefined' && $(this).attr('data-lta-type') == 'timestamp') ? $(this).text() * 1000 : $(this).text();
            }
            var time = new Date(timeText);
            $(this)
                .attr('data-lta-value', timeText)
                .addClass('liveTimeAgo-active')
                .text(getFormattedDateAgo(time));
        });

        runLive();

        window.addEventListener('focus', function() {
            refreshLive();
            runLive();
        },false);

    };
}(jQuery));