var app = {
    baseUrl: 'http://localhost/crossfit/',
    initialize: function() {
        this.bindEvents();
    },
    bindEvents: function() {
        $(document).on('ready', this, this.onReady);
    },
    onReady: function() {
        $.fn.exist = function(){ return $(this).length > 0; }
        //$.backstretch('images/background.jpg');

        PageTransition.init();
        HTMLTemplate.load(init);
        UIEvents.init();
    }
};

app.initialize();