<?php 
	session_start();
	$_SESSION["matriz"] = array();
	if (isset($_GET["tamaño"])) {
		# code...
		$_SESSION["fi"]=$_GET["Filas"];
		$_SESSION["co"]=$_GET["Columnas"];
		for ($i=0; $i < $_GET["Filas"]; $i++) { 
			# code...
			for ($j=0; $j < $_GET["Columnas"] ; $j++) { 
				# code...
				$_SESSION["matriz"][$i][$j]="";
			}
		}
		echo "ya cree la matriz";
	}
	if(isset($_POST["posiciones"])){
		for ($i=0; $i < $_SESSION["fi"]; $i++) { 
				# code...	
			for ($j=0; $j < $_SESSION["co"]; $j++) { 
				# code...			

					error_reporting(E_ALL ^ E_NOTICE);					
					$_SESSION ["matriz"][$i][$j] = $_POST["$i,$j"];									
			}								
		}
		echo "matriz cargada";
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>intersecciones</title>
		<meta charset="utf-8"/>

		<style>
			.tablero{
				position: relative;
				float: left;				
				border: solid 1px;
				border-color:  #1554d3;
			}
			.colores{
				position: relative;
				float: left;
				
				border: solid 1px;
				border-color:  #1554d3;
			}
			
		</style>
	</head>
	<body>
		
			<form action="" method="GET">
				Filas:<input type="text" name="Filas" /><br>
				Columnas:<input type="text" name="Columnas" />
				<input type="submit" name="tamaño" value="enviar" />
			</form>
			<div class="tablero">
				<form action="" method="POST">
					<?php 
						if (!is_null($_SESSION["fi"]) and !is_null($_SESSION["co"])) {
							# code...
							echo "<table border='1px'>";
							for ($i=0; $i < $_SESSION["fi"]; $i++) { 
								# code...
								echo "<tr>";
								for ($j=0; $j < $_SESSION["co"]; $j++) { 
									# code...							
									error_reporting(E_ALL ^ E_NOTICE);
									$value = $_SESSION ["matriz"][$i][$j];
									echo "<td><input type='text' name='$i,$j' value='$value' style='width: 40px;'/></td>";								
								}
								echo "</tr>";
							}
							echo "</table>";
						}
						
					?>
					<input type="submit" name="posiciones" value="seleccionar"/>
				</form>
			</div>
			<div class="colores">				
					<form action="" method="POST">
						<input type="text" name="amarillo" placeholder="amarillo"/>
						<input type="text" name="azul" placeholder="azul"/>
						<input type="text" name="rojo" placeholder="rojo"/>
						<input type="submit" name="color" value="pinta!">
					</form>				
			</div>
			<h3>marque en 2 casillas con un . de donde a donde quiere pintar, escriba "este" sobre el color y de click en pinta!</h3>
			<?php 


			?>
		
	</body>
</html>