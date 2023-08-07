<?php
	
	include "funzioni.php";
	
	/*
		Bignamini Claudio ws_inviodati.php
		
		As a developer I want this code to check if the data got sent  so that it can start to search for the product informations for the javascript or return error
	
		Given the $_POST[id] is set and is recived an avaiable quantity, when the request is made, then the script will return the data of the query function in json format
		
		Given the $_POST[id] is set and is recived an unavaiable quantity, when the request is made, then the script will return an message "nessun prodotto trovato"
	
		Given the $_POST[id] is not set, when the request is made, then the script will return an message "Non è stato ricevuto nessun dato"
	
	*/
	
	if(isset($_POST["id"])) //checks if the $_POST variable is set
	{

		// query per cercare il prodotto con la quantità richiesta
		
		$res=query("SELECT fornitori.id as idFornitore, ragSoc, tCons, nome, prezzo, quantita FROM (prodotti INNER JOIN (fornprod INNER JOIN fornitori ON fornprod.idFornitori = fornitori.id) ON prodotti.id = fornprod.idProdotti) WHERE  prodotti.id =".$_POST["id"]." AND quantita >=".$_POST["quantity"].";");
		
		if($res!=null) //checks if any result is found
		{
			
			$jsonString=json_encode($res); // encodes in json the res variable
			
		}
		else
		{
			
			$jsonString="Nessun prodotto trovato";
			
		}
	}
	else
	{
		
		$jsonString="Non è stato ricevuto nessun dato";
		
	}
	
	echo $jsonString;
	
?>