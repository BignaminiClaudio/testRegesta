<!DOCTYPE html>
<html>
	<head>
		
		<?php

			include "funzioni.php"; //inclusion of the extenal php file
			
		?>
		
		<!--
			Bignamini Claudio Home.php
			
			Analisi delle funzionalità
			
			As a developer i want this page to show a form with all the avaiable product and a quantity field so that the user will select what product he is searching and visualize the table with all the corrisponding product data
			
			Given the user inputs valid data, when the search button will be pressed, then the table with all the data will be viusalized
			
			Given the user inputs invalid data, when the search button will be pressed, then will appear an message "errore"
			
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
					
					$vet=query("SELECT id, nome FROM prodotti WHERE id > 0"); // call the functions and puts the id and name of the products into $vet
					
					foreach($vet as $product)
					{
						
						echo "<option value=".$product["id"]."> ".$product["nome"]." </option>"; //creates an option in the select for every product
						
					}
				?>
			</select>
			
			<input type="number" name="quantity" id="quantity" min="1" placeholder="quantity" required>  <!--field for desired product quantity -->
			
			<button type="button" name="search" onclick="return find()"> search </button> <!--button for sending the data -->
			
		</form>
		
		<!--
			div used for visualizing the table created from the js
		-->
		
		<div id="risultati">
			
		</div>	
		
	</body>
</html>