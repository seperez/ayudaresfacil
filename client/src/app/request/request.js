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
    $stateProvider.state( 'web.requestCreate', {        
        url: '/pedir-ayuda',
        controller: 'RequestCreateCtrl',
        templateUrl: 'request/request-create.tpl.html',
        data:{ pageTitle: 'Crear Pedido' }
    });
    $stateProvider.state( 'web.FavoriteCreate', {     
        //
    });
})

.controller( 'RequestCtrl', function RequestCtrl( $scope ) {

})

;
