<?php
include("../app/helpers/dashboard.php");
Dashboard_Page::headerTemplate('Log In');
?>
<section class="Texto">
	<div class="container">
		<div class="row">
			<div class="col s12">
				<br><br>
			</div>
			<div class="col s5 m5 l5 center hide-on-small-only"><br><br><br>
				<img src="../resources/multimedia/login/ea (1).png" width="200" height="200">
				<h5 class="Titulos white-text">ENTRONO DE ADMINISTRACIÓN DE LIBRERÍAS</h5><br>
			</div>
			<div class="col s2">
				<br><br>
			</div>
			<div class="col s12 m5 l5">
				<div class="card z-depth-0 rad center">
					<div class="card-content black-text valing-wrapper">
						<h3 class="Titulos black-text">Iniciar Sesión</h3>
						<span>Ingresa tus credenciales</span>
						<br><br>
						<div class="row">
							<form method="post" id="session-form" action="#" autocomplete="off">
								<div class="col s12">
									<div class="row">
										<!--Texbox Email-->
										<div class="input-field col s12 m12 l12">
											<i class="material-icons prefix">assignment_ind</i>
											<input placeholder="Ingresa tu nombre de Usuario" id="user" name="user" type="text" class="validate" required>
											<label for="user">Usuario</label>										
										</div>
										<!--Texbox Password-->
										<div class="input-field col s12 m12 l12">
											<i class="material-icons prefix">lock</i>
											<input placeholder="Ingresa tu contraseña" id="pass" name="pass" type="password" class="validate" required>
											<label for="pass">Contraseña</label>										
										</div>
									</div>
									<div class="row">
										<button type="submit" class="btn black waves-effect waves-light hoverable col s12">Iniciar Sesión</button><br><br>
										<a href="recu_contra.php">Olvide mi Contraseña</a>
									</div>
								</div>																  
							</form>
						</div>
					</div>       
				</div>
			</div>
			<div class="col s12">
				<br><br>
			</div>
		</div>		
	</div>
</section>
<?php
//Se imprime la plantilla del pie y se envía el nombre del controlador para la página web
 Dashboard_Page::footerTemplate('index.js');
?>