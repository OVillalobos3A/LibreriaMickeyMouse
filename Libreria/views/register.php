<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Registro');
?>
<section class="login-background">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<br><br>
			</div>
			<div class="col s12 m12 l12">
				<div class="card z-depth-0 rad center">
					<div class="card-content black-text valing-wrapper">
						<h3 class="Titulos black-text">Registro de Usuario</h3>
						<span>Ingresa tus datos</span>
						<br><br>
						<form>		
							<div class="row">
								<!--Texbox Email-->
								<div class="input-field col s12 m12 l12">
									<input id="correo" type="email" class="validate">
									<label for="correo">Correo</label>										
								</div>
								<!--Texbox Password-->
								<div class="input-field col s12 m12 l12">
									<input id="pass" type="password" class="validate">
									<label for="pass">Contraseña</label>										
								</div>
								<button class="btn black waves-effect waves-light hoverable col s12" href="graficas.php">Iniciar Sesión</button><br><br>
								<a href="recu_contra.php">Olvide mi Contraseña</a>
							</div>								  
						</form>
					</div>       
				</div>
			</div>
			<div class="col s4 m4 l4 hide-on-small-only"><br><br><br>
				
			</div>
			<div class="col s12">
				<br><br>
			</div>
		</div>		
	</div>
</section>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
 Dashboard_Page::footerTemplate('register.js');
?>