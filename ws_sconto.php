<?php

	session_start();
	/*
		Bignamini Claudio ws_sconto.php
		
		Analisi delle funzionalità 
		
		As a developer I want this code to check if the data got sent  so that it can start to search for the discount informations based on the supplier for the javascript or return error
	*/
	
	include "funzioni.php";

	if(isset($_POST["id"])) // checks if $_POST variable is set
	{
		
		$res=query("SELECT * FROM sconti INNER JOIN scoforn ON sconti.id = scoforn.idSconti WHERE idFornitori =". $_POST["id"] .";");
			
		if($res!=null) // checks if any resoult is found
		{
			
			$jsonString= json_encode($res);
			
		}
		else
		{
		
			$jsonString="Nessun prodotto trovato";
			
		}
	}
	else
	{
		
		$jsonString= "Errore nessun dato ricevuto";
		
	}
	
	echo $jsonString;
	
	return $jsonString;

?>