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
						<form action="post" id="register-form">		
							<h3 class="Titulos black-text">Registro de Usuario</h3>
							<br>
							<span>Ingresa tus datos personales y de contacto</span>
							<br><br>
							<div class="row">
								<!--Texbox Nombre-->
								<div class="input-field col s12 m6 l6">
									<input id="nombre" name="nombre" type="text" class="validate" required>
									<label for="nombre">Nombres</label>										
								</div>
								<!--Texbox Apellidos-->
								<div class="input-field col s12 m6 l6">
									<input id="apellido" name="apellido" type="text" class="validate" required>
									<label for="apellido">Apellidos</label>										
								</div>
								<!--Texbox Correo-->
								<div class="input-field col s12 m12 l12">
									<input id="correo" name="correo" type="email" class="validate" required>
									<label for="correo">Correo</label>										
								</div>
								<!--Texbox teléfono-->
								<div class="input-field col s12 m6 l6">
									<input id="telefono" name="telefono" type="tel" class="validate" required>
									<label for="telefono">Teléfono: *Utiliza el siguiente formato 0000-0000</label>										
								</div>
								<!--Texbox DUI-->
								<div class="input-field col s12 m6 l6">
									<input id="dui" name="dui" type="text" class="validate" required>
									<label for="dui">DUI: *Utiliza el siguiente formato 00000000-0</label>										
								</div>
								<!--Texbox Nacimiento-->
								<div class="input-field col s12 m6 l6">
									<input id="fecha" name="fecha" type="date" class="datepicker" required>
									<label for="fecha">Fecha de nacimiento</label>										
								</div>
								<!--Combobox Género-->
								<div class="input-field col s12 m6 l6">
									<select id="genero" name="genero">
										<option value="" disabled selected>Selecciona tu género</option>
										<option value="F">Femenino</option>
										<option value="M">Masculino</option>
										<option value="N">Prefiero no decirlo</option>
									</select>	
									<label>Género</label>									
								</div>
								<div class="input-field col s12 m12 l12">
									<div class="file-field input-field">
										<div class="btn black">
											<span><i class="large material-icons">add_a_photo</i></span>
											<input id="foto" name="foto" type="file" accept=".gif, .jpg, .png">
										</div>
										<div class="file-path-wrapper">
											<input placeholder="Imagen" class="file-path validate" type="text">
										</div>
									</div>
								</div>
								<br><br>
								<span>Ingresa tus credenciales para acceder al sistema</span>
								<br><br>
								<!--Texbox Nombre-->
								<div class="input-field col s12 m6 l6">
									<input id="alias" name="alias" type="text" class="validate" required>
									<label for="alias">Nombre de usuario</label>										
								</div>
								<!--Combobox Género-->
								<div class="input-field col s12 m6 l6">
									<select id="tipo" name="tipo">
										<option value="1" selected>Root</option>
									</select>	
									<label>Su Tipo de Usuario será:</label>									
								</div>
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
								<button type="submit" class="btn black waves-effect waves-light hoverable col s12">Registrarme</button>
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