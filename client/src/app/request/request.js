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
    $stateProvider.state( 'panel.requestCreate', {        
        url: '/pedir-ayuda',
        controller: 'RequestCreateCtrl',
        templateUrl: 'request/request-create.tpl.html',
        data:{ pageTitle: 'Crear Pedido' }
    });
    $stateProvider.state( 'web.favoriteCreate', {     
        //
    });
    $stateProvider.state( 'web.requestDetail', {     
        url: '/pedido-detalle',
        controller: 'RequestDetailCtrl',
        templateUrl: 'request/request-detail.tpl.html',
        data:{ pageTitle: 'Detalle del Pedido' }
    });
})

.controller( 'RequestDetailCtrl', function RequestCtrl( $scope ) {
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
})

;
