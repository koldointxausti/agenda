<!DOCTYPE html>
<html>
<head>
	<title>Inicio - Agenda</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<form action="views/agenda.php" method="post">
		<label for="text">¿Cómo te llamas?</label>
		<input type="text" pattern="[a-z]+" name="user" required>
		<input type="submit">
	</form>
</body>
</html>