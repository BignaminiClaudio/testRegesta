<?php

	
	/*
		Bignamini Claudio ws_sconto.php
		
		Analisi delle funzionalità 
		
		As a developer I want this code to check if the data got sent  so that it can start to search for the discount informations based on the supplier for the javascript or return error
		
		Given the $_POST[id] is set and is recived a valid id, when the request is made, then the script will return the data of the query function in json format 
		
		Given the $_POST[id] is set and is recived an invalid id, when the request is made, then the script will return an message "Nessuno sconto trovato"
		
		Given the $_POST[id] is not set , when the request is made, then the script will return an message "Nessun dato inviato"
	*/
	
	include "funzioni.php";

	if(isset($_POST["id"])) // checks if $_POST variable is set
	{
		
		// searches the data for all the discounts for the supplier
		
		$res=query("SELECT * FROM sconti INNER JOIN scoforn ON sconti.id = scoforn.idSconti WHERE idFornitori =". $_POST["id"] .";");
			
		if($res!=null) // checks if any resoult is found
		{
			
			$jsonString= json_encode($res); // encodes in json the res variable
			
		}
		else
		{
		
			$jsonString="Nessuno sconto trovato";
			
		}
	}
	else
	{
		
		$jsonString= "Errore nessun dato ricevuto";
		
	}
	
	echo $jsonString;

?>