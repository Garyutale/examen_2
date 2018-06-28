<!DOCTYPE html>
<html>
<head>
	<title> Esto ya funciona</title>
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>
<?php

$servername="localhost";
$username="root";
$password="";
$database="examen2";

$conexion=mysqli_connect($servername,$username,$password,$database);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  else{
  	

		//identificar el archivo local
		$archivoOrigen = $_FILES["fileToUpload"]["tmp_name"];//[local][posicion del buffer, temporal del servidor]
		$archivoDestino = "img/".$_FILES["fileToUpload"]["name"];
		echo "El archivo a subir es: ".$archivoDestino;
		echo "</br>";
		$imageFileType=pathinfo($archivoDestino, PATHINFO_EXTENSION);
		$check= gettype($archivoOrigen);
		echo "la extencion del archivo es ".$imageFileType."</br>";
		if ($imageFileType.""=='png') {
			echo "el archivo es una imagen";
			move_uploaded_file($archivoOrigen,$archivoDestino);
			//transmision del archivo
			$query="insert into empleados(nombre_empleado,salario_empleado,foto) values('".$_POST['nombre']."','".$_POST['salario']."','".$archivoDestino."')";
			
			if ($conexion->query($query) === TRUE) {
			    echo "<br>";
			    $sql1 = "SELECT * FROM empleados";
				$result = $conexion->query($sql1);

				if ($result->num_rows > 0) {
				    // output data of each row
				    while($row = $result->fetch_assoc()) {
				    	echo '
				    	<table width="70%" border="3px" align="center" class="table">
					    	<tr> 
					    		<td>'.$row["id_empleado"].'    </td>
					    		<td>'.$row["nombre_empleado"].'    </td>
					    		<td>'.$row["salario_empleado"].'    </td>
					    		<td><img src=" '.$row["foto"].'" > </td>
					    	</tr>
					    </table>
				    	';
				    }
				} else {
				    echo "0 results";
}
			} 
			else {
 			   echo "Error: " . $query . "<br>" . $conexion->error;
			}
		}
  		
  	}
?>

</body>
</html>
