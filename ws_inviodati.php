<?php

	/*
		Bignamini Claudio ws_inviodati.php
	*/
	
	include "funzioni.php";
	
	if(/*provvisorio, ricorda di testare*/ $product==0)
	{
		$jsonString="Errore nessun prodotto inserito";
	}
	else
	{
		// query per cercare il prodotto con la quantità richiesta
		$res=query("SELECT * FROM (prodotti INNER JOIN (fornprod INNER JOIN (fornitori INNER JOIN (scoforn INNER JOIN sconti ON scoforn.idSconti = sconti.id) ON fornitori.id = scoforn.idFornitori) ON fornprod.idFornitori = fornitori.id) ON prodotti.id = fornprod.idFornitori) WHERE  prodotti.id =". $_POST["product"] ." AND quantita >=". $_POST["quantity"] .";");
		
		if($res!=null)
		{
			$jsonString= json_encode($res);
		}
		else
		{
			$jsonString="Nessun prodotto trovato";
		}
		
	}
?>