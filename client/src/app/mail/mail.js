angular.module( 'AyudarEsFacilApp.mail', [
    'ui.router'
])

.config(function config( $stateProvider ) {
    $stateProvider
		.state( 'panel.mail', { 
			template: '<ui-view/>'
		})
		.state( 'panel.mail.inbox', {        
			url: '/mensajes/bandeja-de-entrada',
			controller: 'MailCtrl',
			templateUrl: 'mail/mail-inbox.tpl.html',
			data:{ pageTitle: 'Bandeja de Entrada' }
		})
		.state( 'panel.mail.read', {        
			url: '/mensajes/leer/:id',
			controller: 'MailCtrl',
			templateUrl: 'mail/mail-read.tpl.html',
			data:{ pageTitle: 'Mensaje' }
		});
})

.controller( 'MailCtrl', function OfferCtrl( $scope ) {

})

;
