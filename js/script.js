/*
	Bignaminin Claudio script.js
	
	Analisi delle funzionalità: function find
	
	As a developer i want this code to call a php script, sending data in POST, so that it can generate the table with all the found information
	
	Given the user inputted a valid product and a quantity wich is available, when the function sends the request to the php script then the function creates a table containing all the following data: supplier name, singular price, total price (w/o discounts), total price with discounts, total discount, discount description, delivery time and order button
	
	Given the user inputted a valid product and a quantity wich is not avaiable, when the function sends the request to the php script then the function creates an empty table
	
	Given the user inputted an invalid product or an invalid quantity, when the function sends the request, then the function does nothing
	
*/

function find()
{
	
	let product = document.getElementById("products").value; //gets the form inputted data in products and puts it in a variable
	let quantity = document.getElementById("quantity").value; //gets the form inputted data in quantity and puts it in a variable
	let request= new XMLHttpRequest(); // creates the request
	
	request.open("POST","ws_inviodati.php",false); //opens the request to the php script
	request.onreadystatechange=function()
	{
		
		if(request.readyState==4 && request.status==200) //enters if the response is positive
		{

			let objResponse=JSON.parse(request.responseText); //response from the php script 
			let div = "<table border=2>"; // variable that will contain the table
			let totop=objResponse.length; //length of the array of the response
				
			div = div + "<tr> <th> Fornitore </th> <th> Prezzo Unitario </th> <th> Prezzo Totale Non Scontato </th>"; 
			div = div + "<th> Prezzo Totale Scontato </th> <th> Sconto totale </th> <th> Motivo Sconto </th> <th> Tempo consegna </th> <th> </th> </tr> ";
				
			for(let i=0; i<totop; i=i+1) //will create a row for every result in the objResponse array
			{
				
				let prezzoTotale = objResponse[i].prezzo * quantity;
				let objSconti = sconto(objResponse[i].idFornitore); // array which contains all the resoult discounts for inputted supplier
				let objLenght= objSconti.length;//length of the array for the discount informations
				let prezzoTotSco = prezzoTotale;
				let scontoTot = 0;
				let descrizione = " ";
					
				for(let s=0; s<objLenght; s=s+1) // cicle that will elaborate the data of the various discounts
				{
					if(objSconti[s].minOrd >= prezzoTotale || quantity >= objSconti[s].qtaOrd) // checks if the discount is applicable
					{
						prezzoTotSco =prezzoTotale - (prezzoTotale * (objSconti[s].percentuale / 100));
						scontoTot = scontoTot + objSconti[s].percentuale;
						scontoTot = scontoTot + "%";
						descrizione = descrizione + objSconti[s].descrizione;
					}
					
				}
				
				if(scontoTot == 0)
				{
					descrizione = "Sconto non applicabile";
				}
				
				//creating the rows of the table
				
				div = div + "<tr>";
				div = div + "<td>"+ objResponse[i].ragSoc +"</td>" ;
				div = div + "<td>"+ objResponse[i].prezzo +"</td> <td>"+ prezzoTotale +"</td> <td>"+ prezzoTotSco +"</td>";
				div = div + "<td>"+ scontoTot +"</td> <td>"+ descrizione +"</td> <td>"+ objResponse[i].tCons +"</td> ";
				div = div + "<td> <button> ordina </button> </td></tr> "; // places the button for ordering
			}
			
			div = div + "</table>"; // closing the table
			
			document.getElementById("risultati").innerHTML= div; //printing the table to it's place
		}
		else
		{
			document.getElementById("risultati").innerHTML= "errore"; // prints an error message if no data is recived
		}
	};
	
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	
	request.send("id="+product+"&quantity="+quantity); /*sends the data to the php script*/
	
}

/*
	Analisi delle funzionalità: function sconto(idSupplier)
	
	As a developer i want this code to to call a php script so that it can find all the discount related to the supplier equal to idSupplier

	Given the function recived an invalid idSupplier, when the function will make the request then the function will do nothing
	
	Given the function recived a valid idSupplier when the function will make the request then the function will return the variable whit all the discount information

*/

function sconto(idSupplier)
{
	let request= new XMLHttpRequest(); //creates the request
	
	let objResp="" ;
	
	request.open("POST", "ws_sconto.php",false); //opens the request to the script
	
	request.onreadystatechange=function() 
	{
		
		if(request.readyState==4 && request.status==200)
		{
			
			objResp = JSON.parse(request.responseText); //parses the json into an associative array
			
		}
	};
	
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("id="+idSupplier); // sends the data to the script
	
	return objResp; // returns the associative array 
}