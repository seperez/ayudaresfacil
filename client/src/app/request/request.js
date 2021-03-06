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
        controller: 'RequestCtrl',
        templateUrl: 'request/request-detail.tpl.html',
        data:{ pageTitle: 'Detalle del Pedido' }
    });
})

// Users service used for communicating with the users REST endpoint
.factory('Requests', ['$resource',
    function($resource) {
        return $resource('http://localhost/ayudaresfacil/api/request', {}, {
            update: {
                method: 'PUT'
            }
        });
    }
])

.controller( 'RequestCtrl', function RequestCtrl( $scope, Requests ) {
  $scope.myInterval = 5000;

  var requests = new Requests();

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

  requests.$get(function(){
    $scope.requests=requests.data;
    //alert('alert: '+JSON.stringify($scope.requests));
  });
})

;
