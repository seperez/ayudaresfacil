<?php
	$SERVER_URL = "http://localhost/ayudaresfacil/api/";
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>AyudarEsFácil - Api</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta charset="utf-8">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
	<br/>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="jumbotron">
					<h1>AyudarEsFácil - Api</h1>
					<p>Hi! This is the AyudarEsFácil's api documentation.</p> 
					<p>AyudarEsFácil Api is a restfull PHP application. 
						Below you can find the list of available services.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				
				<!--Service Group-->
				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Authentication</h4>
					</a>
					
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Login</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>authentication <br>
							<strong>Method:</strong> <code>GET</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							username: 'foo',
							password: 'bar'
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">IsLoggedIn</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>authentication <br>
							<strong>Method:</strong> <code>GET</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							token:'Aadsjk34hjksad'
						}
						</code>
					</a>
				</div>
				<!--End of Service Group-->

				<!--Service Group-->
				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Account</h4>
					</a>
					
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Create</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>account <br>
							<strong>Method:</strong> <code>PUT</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							id: 1,
							email: 'bar',
							password: 'baz'
							name: 'foobar'
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Confirm</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>account/confirm <br>
							<strong>Method:</strong> <code>GET</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							token: 'Aadsjk34hjksad'
						}
						</code>
					</a>
				</div>
				<!--End of Service Group-->
				
				<!--Service Group-->
				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">User</h4>
					</a>
					
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetAll</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>user <br>
							<strong>Method:</strong> <code>GET</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetById</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>user <br>
							<strong>Method:</strong> <code>GET</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							id: 1
						}
						</code>
					</a>		

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Update</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>user <br>
							<strong>Method:</strong> <code>POST</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								name: 'foo',
								username: 'bar',
								lastname: 'baz',
								token: 'Aadsjk34hjksad'
							}
							</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">DeleteById</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>user <br>
							<strong>Method:</strong> <code>DELETE</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							id: 1,
							token: 'Aadsjk34hjksad'
						}
						</code>
					</a>
				</div>
				<!--End of Service Group-->

				<!--Service Group-->
				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Offer</h4>
					</a>
					
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetAll</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer<br>
							<strong>Method:</strong> <code>GET</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetById</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer<br>
							<strong>Method:</strong> <code>GET</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							publicationId: 87
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetByUser</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer<br>
							<strong>Method:</strong> <code>GET</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							UserId: 1
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Create</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer <br>
							<strong>Method:</strong> <code>POST</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								userId:2,
								publicationTypeId:1,
								creationDate:2014-06-01,
								title:Un titulo para la publicación,
								description:Una descripción para la publicación,
								expirationDate:2014-06-01,
								categoryId:1,
								subcategoryId:1,
								views:12,
								processStateId:V,
								objectId:2,
								quantity:3,
								processStateIdOffer:P,
								offerTypeId:3,
								quantityUsersToPaused:2
							}
							</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Update</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer <br>
							<strong>Method:</strong> <code>POST</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								publicationId:81
								userId:2,
								publicationTypeId:1,
								creationDate:2014-06-01,
								title:Un titulo para la publicación,
								description:Una descripción para la publicación,
								expirationDate:2014-06-01,
								categoryId:1,
								subcategoryId:1,
								views:12,
								processStateId:V,
								objectId:2,
								quantity:3,
								processStateIdOffer:P,
								offerTypeId:3,
								quantityUsersToPaused:2
							}
							</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Delete</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer<br>
							<strong>Method:</strong> <code>DELETE</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							publicationId: 81
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Pause</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer/pause<br>
							<strong>Method:</strong> <code>POST</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							publicationId: 83
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetFavoriteByUser</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer/favorite<br>
							<strong>Method:</strong> <code>POST</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							publicationId: 83
							userId: 1
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">SetAsFavorite</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer/favorite<br>
							<strong>Method:</strong> <code>POST</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							publicationId: 83
							userId: 1
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">DeleteFavorite</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>offer/favorite<br>
							<strong>Method:</strong> <code>DELETE</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							publicationId: 83
							userId: 1
						}
						</code>
					</a>
				</div>
				<!--End of Service Group-->

				<!--Service Group-->
				<div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Request</h4>
					</a>
					
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetAll</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>request<br>
							<strong>Method:</strong> <code>GET</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetById</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>request<br>
							<strong>Method:</strong> <code>GET</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							publicationId: 80
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetByUser</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>request<br>
							<strong>Method:</strong> <code>GET</code>
						</p>
						<strong>Params:</strong> 
						<code>
						{
							UserId: 1
						}
						</code>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Create</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>request <br>
							<strong>Method:</strong> <code>POST</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								userId:2,
								publicationTypeId:1,
								creationDate:2014-06-01,
								title:Un titulo para la publicación,
								description:Una descripción para la publicación,
								expirationDate:2014-06-01,
								categoryId:1,
								subcategoryId:1,
								views:12,
								processStateId:V,
								objectId:2,
								quantity:3
							}
							</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Update</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>request <br>
							<strong>Method:</strong> <code>POST</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								publicationId:81
								userId:2,
								publicationTypeId:1,
								creationDate:2014-06-01,
								title:Un titulo para la publicación,
								description:Una descripción para la publicación,
								expirationDate:2014-06-01,
								categoryId:1,
								subcategoryId:1,
								views:12,
								processStateId:V,
								objectId:2,
								quantity:3
							}
							</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Delete</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>request <br>
							<strong>Method:</strong> <code>DELETE</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								publicationId:133
							}
							</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetFavoriteByUser</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>request/favorite <br>
							<strong>Method:</strong> <code>GET</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								publicationId:133
							}
							</code>
						</p>
					</a>
				</div>
				<!--End of Service Group-->

				<!--Service Group-->
				<!-- <div class="list-group">
					<a href="#" class="list-group-item active">
						<h4 class="list-group-item-heading">Publication</h4>
					</a>
					
					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetAll</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>publication <br>
							<strong>Method:</strong> <code>GET</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">GetById</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>publication?id=1 <br>
							<strong>Method:</strong> <code>GET</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Add</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>publication <br>
							<strong>Method:</strong> <code>PUT</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								name:'foo'
							}
							</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">Update</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>publication <br>
							<strong>Method:</strong> <code>POST</code> <br>
							<strong>Params:</strong> 
							<code>
							{
								name: 'foo'
							}
							</code>
						</p>
					</a>

					<a href="#" class="list-group-item">
						<h4 class="list-group-item-heading">DeleteById</h4>
						<p class="list-group-item-text">
							<strong>Url:</strong> <?php echo $SERVER_URL?>publication?id=1 <br>
							<strong>Method:</strong> DELETE
						</p>
					</a>
				</div> -->
				<!--End of Service Group-->

			</div>
		</div>
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

	<script>
		$(function(){
			$(".list-group-item").on('click', function(){
				event.preventDefault();
			});
		});
	</script>
</body>
</html>