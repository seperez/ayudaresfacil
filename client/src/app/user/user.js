angular.module( 'AyudarEsFacilApp.user', [
    'ui.router','ui.bootstrap'

])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'panel.user', {
			template: '<ui-view/>'
		})
		.state( 'panel.user.data', {
			url: '/user/data',
			controller: 'UserCtrl',
			templateUrl: 'user/user-data.tpl.html',
			data:{ pageTitle: 'Información del usuario' }
		});
})

.controller( 'UserCtrl', function UserCtrl($scope) {
  $scope.today = function() {
    $scope.datepicker = new Date();
  };
  $scope.today();
  $scope.clear = function () {
    $scope.datepicker = null;
  };
  $scope.dateOptions = {
    formatYear: 'yyyy',
    startingDay: 1
  };
})

;