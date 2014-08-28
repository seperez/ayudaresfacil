angular.module( 'AyudarEsFacilApp.sponsor', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider
		.state( 'web.sponsor', {        
			url: '/sponsor',
			controller: 'SponsorCtrl',
			templateUrl: 'sponsor/sponsor.tpl.html',
			data:{ pageTitle: 'Sponsor' }
		});
})

.controller( 'SponsorCtrl', function SponsorCtrl( $scope ) {

})

;
