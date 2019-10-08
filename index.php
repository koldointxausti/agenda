<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agenda</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<form action="" method="POST">
		<input type="text" name="nombre" placeholder="Nombre" pattern="[A-Za-z]+" required value=<?php
			if(!empty($_POST['submit']))
				echo $_POST['nombre'];
		?>>
		<input type="email" name="email" placeholder="Correo electrónico" value=<?php
			if(!empty($_POST['submit']) && !empty($_POST['email']))
				echo $_POST['email'];
		?>>
		<input type="submit" name="submit" value="Añadir">
	</form>
	<div id="agenda">
		<?php
			if(!empty($_POST['submit'])){
				if(!empty($_POST['nombre']) && !empty($_POST['email'])){
					$_SESSION['agenda'][$_POST['nombre']] = $_POST['email'];
				}elseif(empty($_POST['email']) && !empty($_POST['nombre'])){
					unset($_SESSION['agenda'][$_POST['nombre']]);
				}
				foreach($_SESSION['agenda'] as $nombre => $email)
					echo '<div class="contacto"><span class="name">'.$nombre.'</span><span>'.$email.'</span></div>';	
			}else
				echo 'Introduce los datos solicitados';
		?>
	</div>
</body>
</html>