var myApp = angular.module('countdownApp', ['ngCart']);

myApp.directive('countdown', ['$timeout', '$interval', 'ngCart', '$parse', '$compile', function ($timeout, $interval, ngCart, $parse, $compile) {
    return {
        restrict: 'EA',
        link: function link(scope, element, attrs) {

            function convertDate(t) {
                var days, hours, minutes, seconds;
                //days = Math.floor(t / 86400);
                //t -= days * 86400;
                //hours = Math.floor(t / 3600) % 24;
                //t -= hours * 3600;
                minutes = Math.floor(t / 60) % 60;
                t -= minutes * 60;
                seconds = t % 60;
                return [
                    //days + 'd',
                    //hours + 'h',
                    minutes + 'm',
                    seconds + 's'
                ].join(' ');
            };

            debugger;

            var mytimeout = null; // the current timeoutID

            var itemObj = ngCart.getItemById(attrs.itemid);
            var countDowm = itemObj.getProductExpire();//angular.fromJson(attrs.expire)[0].exp;

            var future = new Date(countDowm);
            var diff = Math.floor((future.getTime() - new Date().getTime()) / 1000);

            var counter = itemObj.getProductExpire();

            element.text(convertDate(counter));

            // actual timer method, counts down every second, stops on zero
            function onTimeout () {
                if (counter <= 0) {
                 
                    console.log(counter);
                    console.log(convertDate(counter));
                    //scope.$broadcast('timer-stopped', attrs.itemid);
                    $timeout.cancel(mytimeout);
                    ngCart.removeItemById(attrs.itemid);

                    return;
                }

                counter--;
                //element.text(convertDate(counter));

                element.html(convertDate(counter));
                $compile(element.contents())(scope);

                console.log(attrs.itemid + ":" + convertDate(counter));
                mytimeout = $timeout(onTimeout, 1000);
            };

            //scope.$on('timer-stopped', function (event, itemId) {
            //    debugger;
            //    console.log('event', event);

            //    ngCart.removeItemById(itemId);
            //});

         
           
            mytimeout = $timeout(onTimeout, 1000);

         
        },
        transclude: true,
        scope: {},
        template: "<span>{{total}}</span>",
        controller: function ($scope) {
            console.log($scope);
        }
    };
}]);