var Login = {
	$el: $('.loginContent'),
	init:function(){
		$("#btn-signin",self.$el).on("click", this, this.signIn);
	},
	getFormData: function (){
		return	{	
			username: $("#username",self.$el).val(),
			password: $("#password",self.$el).val()
		}
	},
	validateForm: function(formData){
		$("#errorMessage",self.$el).empty();
		$(".input",self.$el).parent().removeClass('has-error');
		
		if(formData.username.length < 1 && formData.password.length < 1){
			this.showMessage({message:"Completa el usuario y contraseña."});
			$("#username",self.$el).parent().addClass('has-error');
			$("#password",self.$el).parent().addClass('has-error');
			return false;
		}else if(formData.username.length < 1 ){
			this.showMessage({message:"Completa el usuario"});
			$("#username",self.$el).parent().addClass('has-error');
			return false;
		}else  if(formData.password.length < 1 ){
			this.showMessage({message:"Completa la contraseña."});
			$("#password",self.$el).parent().addClass('has-error');
			return false;
		}
		return true;
	},
	showMessage: function(options){
		$("#labelMessageErrorTmpl").tmpl({message: options.message}).prependTo("#errorMessage",self.$el);
	},
	signIn: function(event){
		event.preventDefault();
		var self = event.data;

		var formData = self.getFormData();
		if(!self.validateForm(formData))
			return false;
		
		var element = this;
		$.ajax({
			url:'/login.ssox',
			type: 'GET',
			dataType:'json',
			data: formData,
			context: self,
			beforeSend: function(){
				ButtonFeedback.loading(element);	
			},
			success: self.successfulSignIn,
			error: self.error
		});
	},
	successfulSignIn: function(response){
		if(response.status == "OK"){
			if(response.isSuccess){
				ButtonFeedback.complete("#btn-signin");
				location.href ='client.html';
			}else{
				ButtonFeedback.error("#btn-signin");
				this.showMessage({message:"Los datos ingresados son incorrectos."});		
			}
		} else if (response.status == "NOOK")
			this.error();
	},
	error: function(){
		ButtonFeedback.error("#btn-signin");
		this.showMessage({message:"Surgió un error al intentar iniciar sesión."});
	}
};

var Category = {
	el: '.categories',
	get: function(){
		$.ajax({
			url: app.baseUrl + 'category/getAll',
			type: 'GET',
			context: this,
			success: this.successfulGet,
			error: this.errorGet
		});
	},
	successfulGet: function(response){
		if (response.status == "OK") {
			$(this.el).empty();
			if(response.categories.length > 0)
				$("#categoryItemTmpl").tmpl(response.categories).appendTo(this.el);
		}else {
			this.errorGet();
		}  
	},
	errorGet: function(a,b,c){
		console.log(a, b, c);
	}
};

var FeaturedProduct = {
	el:".featuredProducts",
	get: function(){
		$.ajax({
			url: app.baseUrl + 'product/getAllFeatured',
			type: 'GET',
			context: this,
			success: this.successfulGet,
			error: this.errorGet
		});
	},
	successfulGet: function(response){
		if (response.status == "OK") {
			$(this.el).empty();
			if(response.products.length > 0){
				$("#featuredProductItemTmpl").tmpl(response.products).appendTo(this.el);
			}else{
				$("#blockquoteMessageTmpl").tmpl({
					message:"No encontramos clientes asociados...", 
					actionClass: 'btnRefresh',
					typeClass: 'text-primary'
				}).appendTo(this.el);
				$('.btnRefresh').on('click', this, this.get);
			}
		}else {
			this.errorGet();
		}  
	},
	errorGet: function(a,b,c){
		$("#blockquoteMessageTmpl").tmpl({
			message:"Surgió un error al intentar obtener los productos...", 
			actionClass: 'btnRefresh',
			typeClass: 'text-danger'
		}).appendTo(this.el);
	},
	render: function(){

	}
};