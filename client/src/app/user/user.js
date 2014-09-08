angular.module( 'AyudarEsFacilApp.user', [
    'ui.router'
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

.controller( 'UserCtrl', function UserCtrl( $scope ) {

})

;
