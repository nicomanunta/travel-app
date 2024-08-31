# Travel-App

Travel-App è un'applicazione web progettata per la creazione e l'organizzazione di viaggi. Gli utenti possono registrarsi, creare nuovi viaggi, suddividerli in giornate e tappe, e gestire i dettagli di ogni tappa, inclusi descrizioni, immagini e note.

## Funzionalità

- **Registrazione Utente**: Gli utenti possono registrarsi per creare e gestire i propri viaggi.
- **Creazione di Viaggi**: Gli utenti possono creare un nuovo viaggio specificando un titolo e dettagli, e suddividerlo in giornate e tappe.
- **Gestione delle Giornate e delle Tappe**: Ogni viaggio può essere organizzato in giornate, e ogni giornata può includere multiple tappe con descrizioni, immagini e note.
- **Modifica e Aggiornamento**: Gli utenti possono modificare o aggiornare i viaggi, le giornate e le tappe esistenti.
- **Eliminazione**: Gli utenti possono eliminare viaggi, giornate e tappe non più necessari.
- **Visualizzazione delle Mappe**: Ogni tappa del viaggio può essere visualizzata su una mappa interattiva. Un marker viene automaticamente aggiunto per ogni località salvata, permettendo agli utenti di visualizzare la posizione esatta delle loro tappe.

## Tecnologie Utilizzate

- **Laravel**: Framework PHP per lo sviluppo dell'applicazione web.
- **JavaScript**: Utilizzato per migliorare l'interattività dell'interfaccia utente e per gestire le mappe.
- **HTML**: Linguaggio di markup per la struttura delle pagine web.
- **SCSS**: Linguaggio di pre-processamento CSS utilizzato per lo stile dell'applicazione.
- **Bootstrap**: Framework CSS per il design responsive e il layout.
- **PHP**: Linguaggio di scripting lato server utilizzato in combinazione con Laravel.
- **Leaflet.js**: Libreria JavaScript per la visualizzazione e la gestione delle mappe interattive.

## Requisiti

- **PHP**: Versione 7.4 o superiore.
- **Composer**: Strumento per la gestione delle dipendenze PHP.
- **Node.js e NPM**: Per la gestione dei pacchetti JavaScript e per il pre-processamento SCSS.
- **MySQL o altro database compatibile**: Per la gestione dei dati dell'applicazione.

## Installazione

1. **Clona il Repository**:
   ```bash
   git clone https://github.com/tuo-username/travel-app.git
2. **Naviga nella Directory del Progetto**:
   ```bash
   cd travel-app
3. **Installa le Dipendenze PHP**:
   ```bash
   git clone https://github.com/tuo-username/travel-app.git
4. **Installa le Dipendenze JavaScript**:
   ```bash
   git clone https://github.com/tuo-username/travel-app.git
5. **Configura l'Ambiente**:
   Copia il file .env.example e rinominalo in .env. Configura le impostazioni del database e altre variabili ambientali nel file .env.
6. **Genera la Chiave dell'Applicazione**:
   ```bash
   php artisan key:generate
7. **Esegui le Migrazioni del Database**:
   ```bash
   php artisan migrate
8. **Compila le Risorse**:
   ```bash
   npm run dev
9. **Avvia il Server di Sviluppo**:
   ```bash
   php artisan serve

L'applicazione sarà accessibile all'indirizzo http://localhost:8000.




