angular.module('directives.sessionNav', [])

.directive('sessionNav', function() {
    return {
        restrict: 'E',
        replace: true,
        templateUrl: 'directives/session/session-nav.tpl.html',
        controller: "AuthenticationCtrl",
        link: function (scope, element, attrs) {
            $(element).find().click()
            scope.text = '1';
            element.click(function() {
                 scope.text = '2';
            });
        }
    };
});
