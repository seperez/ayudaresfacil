angular.module('directives.sessionNav', [])

.directive('sessionNav', function() {
    return {
        restrict: 'E',
        replace: true,
        template: '<div class="pull-right" style="margin:8px 0">' +
            '<a ui-sref="account.signin" class="text-muted" style="margin:0 15px" data-ng-if="!authentication.user">Inicia Sésion</a>' +
            '<button ui-sref="account.signup" class="btn btn-warning" data-ng-if="!authentication.user">Registrate</button>' +
            '<a href="#" data-ng-click="signout()" class="text-muted" style="margin:0 15px" data-ng-if="authentication.user">Cerrar Sésion</a>' +
            '<button ui-sref="panel.user.data" class="btn btn-warning" data-ng-if="authentication.user">Mi Cuenta</button>' +
            '</div>',
        controller: "AuthenticationCtrl",
        link: function(scope, element, attrs, ctrl) {
        }
    };
});
