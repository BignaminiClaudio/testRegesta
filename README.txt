README.txt

Questo file contiene tutte le informazioni, in maniera semplificata, del programma.

Nei file è inclusa la guida all'utilizzo del programma. Li è presente una spiegazione del utilizzo del programma.

Struttura del programma

Il programma è scritto principalmente in php e javascript, è formato da cinque file: quattro sono file.php e uno è un file.js.
Il file.js è contenuto nella cartella js e si chiama script.js, contiene le funzioni javascript che servono per creare la tabella e 
per visualizzarla nella home o visualizzare un messaggio di errore nella home in caso di dati non ricevuti o errore nella richiesta.
I quattro file.php si chiamano: Home.php, funzioni.php, ws_inviodati.php e ws_sconti.php. Home.php è il file aperto di default e che contiene 
il php che genera il form e poi conterrà la tabella dei fornitori da cui ordinare o i vari messaggi di errore dei file. Il file funzioni.php 
contiene la funzione php necessaria ad eseguire delle query, sul database, inserite tramite un parametro di tipo stringa. Il file 
ws_inviodati.php è il file che cerca il prodotto richiesto dall'utente con la quantità richiesta, ritornando poi una stringa json contenente
il risultato della ricerca o ritornando l'errore appropiato. Il file ws_sconti.php è il file che ricerca gli sconti associati al fornitore,
ritornandoli sotto forma di stringa json o ritornando l'errore appropiato. 

Scelte tecniche:

Ho usato il php e il javascript come linguaggi di programmazione per creare il codice perchè sono quelli con cui ho lavorato di più 
recentemente e con cui avevo già una conoscenza dell'implementazione di database nel programma web. Il database usato nel test del programma
è MariaDB, accompagnato da Xampp come server locale. Per la connessione al database tramite php ho utilizzato la classe PDO che permette di
creare un oggetto che rappresenta la connessione al server e richiede tre dati per essere istanziato: il destination name che è formato dal
indirizzo IP del host e dal nome del database; il nome dell'utente che si vuole che effettui la connessione al DB e la password dell'utente.
Per inviare i dati e creare la tabella che contiene i risultati, ho utilizzato l'AJAX/AJAJ che permette di inviare a delle pagine php delle 
richieste http, in modo da poter ottenere i dati con cui poi lavorare per ottenere la tabella. 
Ho creato un documento in PDF che contiene tutte le informazioni riguardanti il database creato per questo programma, includendo anche il suo
schema relazionale per semplificare la comprensione della formazione del database.

Bignamini Claudio