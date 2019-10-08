<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agenda</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
	<h1>Agenda de <?php echo $_POST['user'] ?></h1>
	<form action="" method="POST">
		<h3>Añadir contactos</h3>
		<input type="hidden" name="user" value=<?php echo $_POST['user'] ?>>
		<!-- Los input también hacen una comprobación. El nombre comprueba usando pattern, para solo aceptar letras, y el email se comprueba si es válido siendo un input de tipo email. De todas formas, también lo he checkeado con PHP, y he añadido campos para mostrar los errores  -->

		<input type="text" name="nombre" placeholder="Nombre" pattern="[a-zA-Z]+" required value=<?php
			// si se ha envíado el formulario, el valor del nombre en el formulario será el que se ha enviado antes
			if(!empty($_POST['submit'])) echo $_POST['nombre'];
		?>>
		<!-- Campo error nombre -->
		<span class="error"><?php 
			if(empty($_POST['nombre'])) echo 'Debe rellenar este campo';
			elseif(!empty($_POST['nombre']) && !preg_match('/^[a-z]+/i', $_POST['nombre'])) echo 'Nombre incorrecto, no debe tener números ni símbolos';
		?></span>

		<input type="email" name="email" placeholder="Correo electrónico" value=<?php
			// si se ha envíado el formulario y tenía email, el valor del email en el formulario será el que se ha enviado antes
			if(!empty($_POST['submit']) && !empty($_POST['email'])) echo $_POST['email'];
		?>>
		<!-- Campo error email -->
		<span class="error"><?php if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['email'])) echo 'Email incorrecto'?></span>
		<input type="submit" name="submit" value="Añadir">
	</form>
	
	<h3>Contactos</h3>
	<div id="agenda">
		<?php
			// si ya hay algún elemento en la agenda
			if(sizeof($_SESSION['agenda'])!=0){

				// si los campos del nombre y el email están ambos rellenos
				if(!empty($_POST['nombre']) && !empty($_POST['email'])){

					// comprueba si el email y el nombre son válidos, y si lo son los añade a la sesión
					// el nombre se compara con una expresión regular para saber si sólo son letras, para evitar injecciones SQL
					if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && preg_match('/^[a-z]+/i', $_POST['nombre']))
						$_SESSION['agenda'][$_POST['nombre']] = $_POST['email'];

				// si el campo nombre está relleno, pero el del email no, elimina ese contacto de la agenda
				}elseif(empty($_POST['email']) && !empty($_POST['nombre'])){
					unset($_SESSION['agenda'][$_POST['nombre']]);
				}

				// muestra los datos de la agenda
				foreach($_SESSION['agenda'] as $nombre => $email)
					echo '<div class="contacto"><span class="name">'.$nombre.'</span><span>'.$email.'</span></div>';	
			}else
				echo 'Introduce los datos solicitados';
		?>
	</div>
</body>
</html>