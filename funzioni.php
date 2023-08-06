<?php
	/*
		Bignaminini Claudio funzioni.php
	*/
	
	/*
		Analisi delle funzionalità: function query($query)
		
		As a developer i want this function to connect to the database in order to execute the recived query and return the results found
	*/
	
	function query($query) /*$query is a string and contains the query to be executed*/
	{

		$dsn="mysql:host=127.0.0.1;dbname=testingresso";
		$username="root";
		$password="";
	
		try
		{
			$db=new PDO($dsn, $username, $password); /*connection to the database*/
			$queryResult=$db->query($query);  /*query excecution*/
			while ($result=$queryResult->fetch(PDO::FETCH_ASSOC)) /*cicle that puts all found resoults into the associative array $resultVet*/
			{
				$resultVet[]=$result;
			}
		}
		catch (PDOException $e)
		{
			$error = $e->getMessage();
		}
		
		return $resultVet;
		
	}
	
?>