
<?php
	include "funzioni.php";
?>

<!DOCTYPE html>
<html>
	<head>
		<!--
		Bignamini Claudio Home.php
		
		$dsn="mysql:host=127.0.0.1;dbname=testingresso";
		$username="root";
		$password="";
		
		apri una connessione con il db
		se la connessione non è aperta
		allora
			stammpa l'errore 
		altrimenti
			crea un form con i seguenti campi: un campo select per selezionare gli oggetti da ordinare; un campo numerico per il numero di oggetti da ordinare
			
		-->
		<title>
			Prova
		</title>
	</head>
	<body>
		<form action="Home.php" method="POST"> <!-- form per la ricerca del prodotto da ordinare o confrontare le offerte disponibili-->
			<select name="products">
				<option value="0"> Seleziona Prodotto </option>
				<?php
					/*
						creazione delle opzioni di prodotti presenti sul database
					*/
					$vet=query("SELECT id, nome FROM prodotti WHERE id > 0");
					foreach($vet as $product)
					{
						echo "<option value=".$product["id"]."> ".$product["nome"]." </option>";
					}
				?>
			</select>
			<input type="number" name="quantity" min="1" placeholder="quantity'"> <!-- campo per inserire la quantita richiesta del prodotto -->
			<input type="submit" name="search" value="search"> <!-- bottone per inviare i dati -->
		</form>
	</body>
</html>