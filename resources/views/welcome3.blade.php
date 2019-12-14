<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>MILK EXPRESS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie-edge"> 


	<!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">

	 <!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/estilo.css')}}">

	      
    <style>
        html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 6vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
    </style>

</head>
<body>

	<div class="flex-center position-ref full-height">

		@if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
        @endif
	</div>
	<div class="content">
	<div class="row titulo">
			<h1 id="title">MILK EXPRESS</h1>
	</div>


	<nav class="navbar navbar-expand-lg navbar-light navegacion">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation" >
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavDropdown">
    			<ul class="navbar-nav">
      				<li class="nav-item dropdown">
        				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          PRODUCTOS
		        		</a>
			        	<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			          	<a class="dropdown-item" href="#">LACTEOS</a>
			          	<a class="dropdown-item" href="#">DERIVADOS</a>
			         	<a class="dropdown-item" href="#">BEBIDAS</a>
			       		</div>
      				</li> 

      				<li class="nav-item">
      					<a href="#" class="nav-link" >CONOCENOS</a>
      				</li>


      				<li class="nav-item">
      					<a href="#" class="nav-link" >CONTACTANOS</a>
      				</li>
    			</ul>
 			 </div>
		</nav>	

	<div class="container fluid">
		
		<div class="row contenedor-cuadros" >

					<div class="col-6  subcontenedor-cuadros">
							<div class="caja1"></div>
							<div class="caja2">LACTEOS</div>
					</div>
	
					<div class="col-6  subcontenedor-cuadros ">
						<div class="caja1"></div>
						<div class="caja2">BEBIDAS</div>
					</div>

		</div>

		<div class="row contenedor-cuadros">
			<div class="card">

				<div class="image">
					<img src="img/paisaje1.jpg">
				</div>
					
				<div class="card-body">
					<p>Paisaje 1</p>
				</div>
			</div>

			<div class="card">

				<div class="image">
					<img src="img/paisaje2.jpg">
				</div>
					
				<div class="card-body">
					<p>Paisaje 2</p>
				</div>
			</div>

			<div class="card">

				<div class="image">
					<img src="img/paisaje3.jpg">
				</div>
					
				<div class="card-body">
					<p>Paisaje 3</p>
				</div>
			</div>
		</div>



		<div class="row">
			<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link head-text-color-personal navItem1" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Info #1 </a>
				  </li>
				  <li class="nav-item" >
				    <a class="nav-link head-text-color-personal navItem2" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Info #2</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link head-text-color-personal navItem3" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Info #3</a>
				  </li>
			</ul>
			<div class="tab-content" id="pills-tabContent">
				  <div class="tab-pane fade  card-text-color-personal textItem1" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"> HOLA MUNDO 1Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente aperiam ab aspernatur atque hic alias provident unde sit maxime beatae exercitationem est obcaecati odio magnam sunt ullam eius molestias, quo!
				  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nulla beatae, adipisci eius doloremque nisi accusantium amet minima, commodi deserunt ullam eaque aperiam aut perspiciatis molestiae, incidunt itaque nesciunt veniam sint.
				  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum corrupti magnam expedita, optio harum explicabo laudantium ipsa. Veritatis veniam, aliquid nobis natus pariatur quae, eum iure odio necessitatibus quas accusamus?
				  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum debitis, animi dicta! Facere sit aliquid inventore similique, sed, illo dolores officiis tenetur, itaque iste eius! Rerum dolorem, sapiente dignissimos nemo.</div>
				  <div class="tab-pane fade card-text-color-personal textItem2" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...  HOLA MUNDO 2 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga explicabo voluptate perspiciatis a ipsum accusantium incidunt laboriosam porro, quia perferendis reprehenderit adipisci fugiat sint ipsa, in ut animi voluptatibus iure!
				  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestias esse accusamus temporibus iusto alias, error eius nostrum autem perferendis, sapiente, modi quas nulla officia ut aliquid! Laudantium nam ipsa vel.
				  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos natus labore sit possimus suscipit reprehenderit optio aut aperiam accusantium dolorem harum cumque assumenda, necessitatibus, eos repudiandae amet debitis quo doloremque?

				  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia velit, minima neque! Tempora consequuntur aliquam, possimus quia error sequi mollitia ab eligendi delectus expedita impedit nisi aspernatur est nam et!
				</div>
				  <div class="tab-pane fade card-text-color-personal textItem3" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...  HOLA MUNDO 3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet harum libero itaque voluptatibus at iste sint voluptate officia quisquam ipsa suscipit nisi vero, dolor distinctio blanditiis commodi. Hic, tempore, similique! 
				  
				 	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est inventore deserunt temporibus optio eos exercitationem ex architecto quae nesciunt vero ducimus, odio tempore cumque, veniam explicabo. Sunt architecto voluptatum ducimus.

				 	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				 	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				 	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				 	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				 	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				 	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					</div>
			</div>

		</div>
	

	<div class="row justify-content-center">
		<button class="botonEnlace btn btn-light"><a href="#title">	SUBIR</a></button>

	</div>

	</div>

	</div>
	<script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
	<script src="{{asset('js/popper.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
</body>
</html>