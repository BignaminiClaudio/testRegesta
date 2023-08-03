<?php
	/*
		Bignaminini Claudio funzioni.php
	*/
	
	$dsn="mysql:host=127.0.0.1;dbname=testingresso";
	$username="root";
	$password="";
	
	function query($query) /*funzione che data una query sql ritorna i dati ottenuti*/
	{
		$resultVet=[];
		
		$dsn="mysql:host=127.0.0.1;dbname=testingresso";
		$username="root";
		$password="";
	
		try
		{
			$db=new PDO($dsn, $username, $password); /*connessione al database*/
			$queryResult=$db->query($query); 
			while ($result=$queryResult->fetch(PDO::FETCH_ASSOC))
			{
				$resultVet[] = $result;
			}
		}
		catch (PDOException $e)
		{
			$error = $e -> getMessage();
		}
		
		return $resultVet;
		
	}
	
?>