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
        url: '/ofrecimiento-detalle',
        controller: 'OfferCtrl',
        templateUrl: 'offer/offer-detail.tpl.html',
        data:{ pageTitle: 'Detalle del Ofrecimiento' }
    });
})

// Users service used for communicating with the users REST endpoint
.factory('Offers', ['$resource',
    function($resource) {
        return $resource('http://localhost/ayudaresfacil/api/offer', {}, {
            update: {
                method: 'PUT'
            }
        });
    }
])

.controller( 'OfferCtrl', function OfferCtrl( $scope, Offers ) {
  $scope.myInterval = 5000;

  var offers = new Offers();

  /*Slides*/
  var slides = $scope.slides = [];
  $scope.addSlide = function() {
    var newWidth = 600 + slides.length;
    slides.push({
      image: 'assets/images/shop/img-shop.jpg',
      text: ['More','Extra','Lots of','Surplus'][slides.length % 4] + ' ' +
        ['Cats', 'Kittys', 'Felines', 'Cutes'][slides.length % 4]
    });
  };
  
  for (var i=0; i<4; i++) {
    $scope.addSlide();
  }
  /*Slides*/

  offers.$get(function(){
    $scope.offers=offers.data;
    //alert('alert: '+JSON.stringify($scope.offers));
  });

})

;
