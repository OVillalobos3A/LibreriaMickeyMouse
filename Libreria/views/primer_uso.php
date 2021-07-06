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
			<br><br><br>
				<div class="card z-depth-0 rad center">
					<div class="card-content black-text valing-wrapper">
						<form action="post" id="register-form">		
						<input class="hide" type="number" id="id_usuario" name="id_usuario" />
							<h3 class="Titulos black-text">Cambio de contraseña</h3>
							<br>
							<span>Se ha detectado que tienes una contraseña generica, por favor procede a cambiarla.</span>
							<br><br>
							<div class="row">																													
								<!--Texbox Password-->
								<div class="input-field col s12 m6 l6">
									<input id="contra" name="contra" type="password" class="validate" required>
									<label for="contra">Contraseña</label>										
								</div>
								<!--Texbox Password-->
								<div class="input-field col s12 m6 l6">
									<input id="contra2" name="contra2" type="password" class="validate" required>
									<label for="contra2">Confirme su contraseña</label>										
								</div>
								<div class="col s12 m12 l12">
									<br><br>
								</div>
								<button type="submit" class="btn black waves-effect waves-light hoverable col s12">Cambiar Clave</button>
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
 Dashboard_Page::footerTemplate('primer_uso.js');
?>