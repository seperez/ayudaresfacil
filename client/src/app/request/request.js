angular.module( 'AyudarEsFacilApp.request', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'web.requestList', {        
        url: '/pedidos',
        controller: 'RequestCtrl',
        templateUrl: 'request/request-list.tpl.html',
        data:{ pageTitle: 'Pedidos' }
    });
})

.controller( 'RequestCtrl', function RequestCtrl( $scope ) {

})

;
