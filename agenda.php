<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Agenda</title>
	<meta charset="utf-8">
	<style>
		#agenda{
			margin-top: 5%;
			display: grid;
			grid-template-columns: 25% 25% 25% 25%;
		}
		.contacto{
			display: flex;
			flex-direction: column;
			justify-content: center;
			align-items: center;
			box-shadow: 1px 1px 7px lightgray;
			max-width: 70%;
			padding: 10% 5%;
			margin: 1% 0;
		}
		.name{
			font-weight: bold;
			padding-bottom: 5%;
			text-transform: uppercase;
			letter-spacing: 5px;
		}
	</style>
</head>
<body>
	<form action="" method="POST">
		<input type="text" name="nombre" placeholder="Nombre" pattern="[A-Za-z]+" required>
		<input type="email" name="email" placeholder="Correo electrónico">
		<input type="submit" name="submit" value="Añadir">
	</form>
	<div id="agenda">
		<?php
			if(!empty($_POST['nombre']) && !empty($_POST['email'])){
				$_SESSION['agenda'][$_POST['nombre']] = $_POST['email'];
			}elseif(empty($_POST['email']) && !empty($_POST['nombre'])){
				unset($_SESSION['agenda'][$_POST['nombre']]);
			}else{
				echo 'Introduce un contacto';
			}
			foreach($_SESSION['agenda'] as $nombre => $email)
				echo '<div class="contacto"><span class="name">'.$nombre.'</span><span>'.$email.'</span></div>';
		?>
	</div>
</body>
</html>