/*
	Bignaminin Claudio script.js
	
	Analisi delle funzionalità: function find
	
	As a developer i want this code to call a php script so that it can generate the table with all the found information
	
*/

function find()
{
	
	let product = document.getElementById("products").value; //gets the form inputted data in products and puts it in a variable
	let quantity = document.getElementById("quantity").value; //gets the form inputted data in quantity and puts it in a variable
	let request= new XMLHttpRequest(); // creates the request
	//let dati = "id="+product+"&quantity="+quantity; creates the post data to send to the php script
	
	request.open("POST","ws_inviodati.php",false); //opens the request to the php script
	request.onreadystatechange=function()
	{
		
		if(request.readyState==4 && request.status==200)
		{

			let objResponse=JSON.parse(request.responseText);
			let div = "<table border=2>"; 
			let totop=objResponse.length;
				
			div = div + "<tr> <th> Fornitore </th> <th> Prezzo Unitario </th> <th> Prezzo Totale Non Scontato </th>"; 
			div = div + "<th> Prezzo Totale Scontato </th> <th> Sconto totale </th> <th> Motivo Sconto </th> <th> Tempo consegna </th> </tr> ";
				
			for(let i=0; i<totop; i=i+1)
			{
				
				let prezzoTotale = objResponse[i].prezzo * quantity;
				let objSconti = sconto(objResponse[i].idFornitore);
				let objLenght= objSconti.length;
				let prezzoTotSco = prezzoTotale;
				let scontoTot = 0;
				let descrizione = " ";
					
				for(let s=0; s<objLenght; s=s+1)
				{
					if(objSconti[s].minOrd >= prezzoTotale || quantity >= objSconti[s].qtaOrd)
					{
						prezzoTotSco =prezzoTotale - (prezzoTotale * (objSconti[s].percentuale / 100));
						scontoTot = scontoTot + objSconti[s].percentuale;
						descrizione = descrizione + objSconti[s].descrizione;
					}
					
				}
				
				if(scontoTot == 0)
				{
					descrizione = "Sconto non applicabile";
				}
				
				div = div + "<tr>";
				div = div + "<td>"+ objResponse[i].ragSoc +"</td>" ;
				div = div + "<td>"+ objResponse[i].prezzo +"</td> <td>"+ prezzoTotale +"</td> <td>"+ prezzoTotSco +"</td>";
				div = div + "<td>"+ scontoTot +"</td> <td>"+ descrizione +"</td> <td>"+ objResponse[i].tCons +"</td> ";
				div = div + "</tr>";
			}
			
			div = div + "</table>";
			
			document.getElementById("risultati").innerHTML= div;
		}
		else
		{
			document.getElementById("risultati").innerHTML= "errore";
		}
	};
	
	request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	
	/*request.setRequestHeader("Content-lenght", dati.length);*/
	
	request.send("id="+product+"&quantity="+quantity); /*sends the data to the php script*/
	
}

/*
	Analisi delle funzionalità: function sconto(idSupplier)
	
	As a developer i want this code to to call a php script so that it can find all the discount related to the supplier equal to idSupplier
*/

function sconto(idSupplier)
{
	let request= new XMLHttpRequest();
	
	let objResp="" ;
	
	request.open("POST", "ws_sconto.php",false);
	
	request.onreadystatechange=function()
	{
		
		if(request.readyState==4 && request.status==200)
		{
			
			objResp = JSON.parse(request.responseText);
			
		}
	};
	
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.send("id="+idSupplier);
	
	return objResp;
}