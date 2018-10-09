# Cantina
Lo scopo dell'applicativo consiste nel creare un'interfaccia Web 
per la consultazione dello storico dei valori di temperatura ed umidità 
registrati nel locale Cantina attraverso arduino e depositati su un
DataBase MySql.

Attualmente lo schema di funzionamento è il seguente.
-Arduino viene collegato ad una porta USB.
-Viene caricato il codice su Arduino.
-Viene inizializzato un cron che legge dalla porta USB relativa di Arduino.
-Viene lanciato il SERVER APACHE (LAMP).
-Viene inizializzato un cron che lancia uno script PHP per la scrittura sul DB.

Cartella arduino_code
-Contiene i file relativi al codice di arduino
Cartella sh_code
-Contiene i file relativi al codice sh per la lettura dei dati
Cartella web_code
-Contiene i file relativi all'applicazione web
Cartella write_db_code
-Contiene i file relativi allo script per la scrittura sul DB

---Nel File schema_install_t_u.ods si trovano infarmozioni più specifiche per ogni sezione




