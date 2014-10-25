angular.module( 'AyudarEsFacilApp.home', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider.state( 'web.home', {
        url: '/home',
        controller: 'HomeCtrl',
        templateUrl: 'home/home.tpl.html',
        data:{ pageTitle: 'Home' }
    });
})

.controller( 'HomeCtrl', function HomeController( $scope, Authentication ) {
	$scope.authentication = Authentication;
	console.log("Home - Auth: ", $scope.authentication);
});
