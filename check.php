<?php
	session_start();
?>
<?php
	include 'connection.php';
	$email = $_POST['email'];
	$password = $_POST['pass'];
	$sql = "SELECT * FROM USUARIO WHERE CORREO = '$email'";
	echo $sql;
	$result = $conector->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	 if ($password==$row['PASSWORD']) {
	    $_SESSION['loggedin'] = true;
	    $_SESSION['username'] =$email;
	    $_SESSION['start'] = time();
	    $_SESSION['id'] = $row['ID_USUARIO'];
	    $_SESSION['id_rol'] = $row['ID_ROL'];
	    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
	    header("Location: examples/index.php");
	 } else {
	   header("Location: index.php");
	 }
	 mysqli_close($conector);
 ?>
