angular.module( 'AyudarEsFacilApp.offer', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'web.offerList', {        
        url: '/ofrecimientos',
        controller: 'OfferCtrl',
        templateUrl: 'offer/offer-list.tpl.html',
        data:{ pageTitle: 'Ofrecimientos' }
    });
    $stateProvider.state( 'panel.offerCreate', {        
        url: '/ofrecer-ayuda',
        controller: 'OfferCreateCtrl',
        templateUrl: 'offer/offer-create.tpl.html',
        data:{ pageTitle: 'Crear Ofrecimiento' }
    });
})

.controller( 'OfferCtrl', function OfferCtrl( $scope ) {

})

;
