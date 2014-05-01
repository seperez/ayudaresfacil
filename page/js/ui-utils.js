var HTMLTemplate = {
	el: '#template',
	files: [
		'js/templates/ui.html',
		'js/templates/app.html',
	],
	load: function(callback){
		var self = this;
		$("body").append('<div id="template"></div>');
		jQuery.ajaxSetup({ async: false });
		$.each(this.files, function(key, file) {
			$.get(file, '', function (data) { 
				$(self.el).append(data); 
			});
		});
		jQuery.ajaxSetup({ async: true });
		callback();
	}
};

var ButtonFeedback = {
	loading: function(element){
		$(element).button('loading');
	},
	reset: function(element){
		$(element).button('reset');
	},
	complete: function(element){
		var self = this;
		$(element).button('complete');
		$(element).toggleClass("btn-success");
	    setTimeout(function(){
	        self.reset(element);
	        $(element).toggleClass("btn-success");
	    }, 1000);
	},
	error: function(element){
		var self = this;
		$(element).button('error');
		$(element).toggleClass("btn-danger");
	    setTimeout(function(){
	        self.reset(element);
	        $(element).toggleClass("btn-danger");
	    }, 1000);
		
	},
	custom: function(element, data){
		$(element).button(data);
	}
};

var Loading = {
	el: "#loading",
	render: function(){
		$("#loadingTmpl").tmpl({}).appendTo(".main-body");
	},
	show: function(){
		if(!this.isExist()) 
			this.render();
		$(this.el).fadeIn();
	}, 
	hide: function(){
		$(this.el).hide();
	},
	isExist: function(){
		return $(this.el).lenght > 0 ? true: false;
	}
};

var Alert = {
	el: '.alert',
	render: function(options){
		$("#alertTmpl").tmpl(options).prependTo(".main-body");
	},
	show: function(options){
		var self = this;
		var guid = GUID.get();
		options = $.extend({guid:guid}, options);
		this.render(options);
		$("#alert_" + guid).slideDown("fast");
		setTimeout(function(){
			self.hide(guid);
	    }, 2000);
	},
	hide: function(guid){
		$("#alert_" + guid).slideUp("fast");
	}
};

var GUID = {
	get: function(){
		var s = [];
	    var hexDigits = "0123456789abcdef";
	    for (var i = 0; i < 36; i++) {
	        s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
	    }
	    s[14] = "4";  // bits 12-15 of the time_hi_and_version field to 0010
	    s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1);  // bits 6-7 of the clock_seq_hi_and_reserved to 01
	    s[8] = s[13] = s[18] = s[23] = "-";

	    var uuid = s.join("");
	    return uuid;
	}
};

var PageTransition = {
	init: function(){
		$('.page').fadeIn('slow', function() {
	        $('a[href], button[href]').click(function(event) {
	            var url = $(this).attr('href');
	            if (url.indexOf('#') == 0 || url.indexOf('javascript:') == 0) return;
	            event.preventDefault();
	            $('.page').fadeOut('slow', function() {
	                window.location = url;
	            });
	        });
	    });
	}
};

var UIEvents = {
	init: function(){
		
	}
};