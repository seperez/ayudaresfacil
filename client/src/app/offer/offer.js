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
        controller: 'OfferDetailCtrl',
        templateUrl: 'offer/offer-detail.tpl.html',
        data:{ pageTitle: 'Detalle del Ofrecimiento' }
    });
})

.controller( 'OfferDetailCtrl', function OfferCtrl( $scope ) {
  $scope.myInterval = 5000;
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
});
