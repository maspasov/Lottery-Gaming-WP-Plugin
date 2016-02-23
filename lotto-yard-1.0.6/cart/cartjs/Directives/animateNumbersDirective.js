var myApp = angular.module('animateNumbersModule', ['ngCart']);
myApp.directive('animateNumbers', function ($timeout) {
    return {
        replace: false,
        scope: true,
        link: function (scope, element, attrs) {
            $(window).ready(function () {
                var e = element[0];
                var refreshInterval = 50;
                var duration = 1500; //milliseconds
                var currency = e.innerText[0];
                var numberAsText = e.innerText.substr(1); 
                var number = parseFloat(numberAsText.split(',').join(''));    
                var step = 0;
                var num = 0;
                var steps = Math.ceil(duration / refreshInterval);
                var increment = (number / steps);
                var percentCompleted = 0;
                var lastNumberSlowCount = 3;
                if (number > lastNumberSlowCount) {
                    number = number - lastNumberSlowCount;
                }
                scope.timoutId = null;
                var counter = function () {
                    scope.timoutId = $timeout(function () {
                        num += increment;
                        percentCompleted = Math.round((num / number) * 100);
                        if (percentCompleted > 60 && percentCompleted < 80) {
                            refreshInterval = refreshInterval + 10;
                        }
                        else if (percentCompleted > 90) {
                            refreshInterval = 200;
                        }
                        step++;
                        if (step >= steps) {
                            $timeout.cancel(scope.timoutId);
                            num = number;
                            e.textContent = currency + number.toLocaleString();
                            if (number > lastNumberSlowCount) {
                                slowCounter();
                            }
                        } else {
                            e.textContent = currency + Math.round(num).toLocaleString();
                            counter();
                        }
                    }, refreshInterval);
                }
                var slowCounter = function () {
                    scope.timoutId = $timeout(function () {
                        lastNumberSlowCount--;
                        if (lastNumberSlowCount < 0) {
                            $timeout.cancel(scope.timoutId);
                        } else {
                            number++;
                            e.textContent = currency + number.toLocaleString();
                            slowCounter();
                        }
                    }, 500);
                }
                counter();
                return true;
            });
            
        }
    }
});