/*
	Bignaminin Claudio script.js
*/
function search(product,quantity)
{
	let request= new XMLHttpRequest();
	request.open("POST","ws_inviodati.php",true);
	request.onreadystatechange=function()
	{
		if(request.readyState==4 && request.status==200)
		{
			let objResponse = JSON.parse(request.responseText);
			let div = "<table border=2> <tr> <th> Fornitore </th> <th> Prezzo Unitario </th> <th> Prezzo Totale </th> <th> Sconto totale </th> ";
		}
	}
	request.send("id="+product+"&quantity="+quantity);
}