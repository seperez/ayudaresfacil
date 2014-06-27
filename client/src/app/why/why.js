angular.module( 'AyudarEsFacilApp.why', [
  'ui.router'
])

.config(function config( $stateProvider ) {
  $stateProvider.state( 'why', {
    url: '/por-que-ayudar',
    views: {
      "main": {
        controller: 'WhyCtrl',
        templateUrl: 'why/why.tpl.html'
      }
    },
    data:{ pageTitle: 'Por que ayudar?' }
  });
})

.controller( 'WhyCtrl', function WhyCtrl( $scope ) {
});

