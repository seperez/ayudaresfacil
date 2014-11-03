angular.module( 'AyudarEsFacilApp.offer', [
  'ui.router','ui.bootstrap'
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
  $stateProvider.state( 'web.offerDetail', {     
    url: '/ofrecimiento-detalle/:id',
    controller: 'OfferCtrl',
    templateUrl: 'offer/offer-detail.tpl.html',
    data:{ pageTitle: 'Detalle del Ofrecimiento' }
  });
})

// Users service used for communicating with the users REST endpoint
.factory('Offers', ['$resource',
  function($resource) {
    return $resource('http://localhost/ayudaresfacil/api/offer', {publicationId:'@id'}, {}, {
      update: {
        method: 'PUT'
      }
    });
  }
  ])

.controller( 'OfferCtrl', function OfferCtrl( $scope, Offers, $stateParams ) {
  var offers = new Offers();
  
  if ($stateParams.id === undefined){
      offers.$get(function(response){
      $scope.offers = offers.data;
    });
  }else{
      offers.$get({publicationId:$stateParams.id},function(response){
      $scope.offer = offers.data[0];
    });
  }

})

;
