<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		
		<?php

			include "funzioni.php";
			
		?>
		
		<!--
			Bignamini Claudio Home.php
		-->
		
		<title>
			TestRegesta
		</title>
		
	</head>
	<body>
	
		<script src="js/script.js">
			// exsternal javascript file inclusion
		</script>
		
		<form method="POST" > <!--form per la ricerca del prodotto da ordinare o confrontare le offerte disponibili-->
			
			<select name="products" id="products">
			
				<option value="0"> Seleziona Prodotto </option>
					
				<?php
					
					/*
						creazione delle opzioni di prodotti presenti sul database
						
						per ogni prodotto presente in $vet
							crea l'opzione della select con value uguale all'id del prodotto e che visualizza il nome del prodotto
					*/
					
					$vet=query("SELECT id, nome FROM prodotti WHERE id > 0");
					
					foreach($vet as $product)
					{
						
						echo "<option value=".$product["id"]."> ".$product["nome"]." </option>";
						
					}
				?>
			</select>
			
			<input type="number" name="quantity" id="quantity" min="1" placeholder="quantity">  <!--field for desired product quantity -->
			
			<button type="button" name="search" onclick="return find()"> search </button> <!--button for sending the data -->
			
		</form>
		
		<!--
			div used for visualizing the table created from the js
		-->
		
		<div id="risultati">
			
		</div>	
		
	</body>
</html>