<!doctype html>
<html lang="en}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->

    <title>Contratto</title>

</head>
<body style="font-size: 18px">
    <style>
        .text-center {
            text-align: center;
        
        }
        .my-2 {
            padding-top: 20px;
            padding-bottom: 20px
        } 
        .my-4 {
            padding-top: 40px;
            padding-bottom: 40px
        }      
        .my-3 {
            padding-top: 30px;
            padding-bottom: 30px
        }
        .page-break {
            page-break-after: always;
        }             
    </style>
    <div style="width: 600px; margin:auto">
        {{-- <a class="btn btn-primary" href="{{ URL::to('/employee/pdf') }}">Export to PDF</a> --}}

        <h1 class="text-center my-3">CONTRATTO DI NOLEGGIO BICICLETTA</h1>
        <p>Il sottoscritto <strong>{{$contract->nome}} {{$contract->nome}}</strong> nato a <strong>{{$contract->nato_a}}</strong>
        il <strong>{{$contract->nato_il}}</strong> e residente in <strong>{{$contract->comune_residenza}}</strong> via <strong>{{$contract->via_residenza}}</strong>,
        documento identità (passaporto/ carta d'identità), n. <strong>{{$contract->n_documento}}</strong> rilasciato il <strong>{{$contract->data_documento}}</strong>
        da <strong>{{$contract->ente_documento}}</strong>, recapito telefonico <strong>{{$contract->tel}}</strong>,
        residenza temporanea <strong>{{$contract->via_residenza}}</strong>, d'ora in poi per brevità identificato come "utente"
        </p>

        <h2 class="text-center my-4">Chiede</h2>
        <p>
            alla Kemedia s.r.l., d'ora in poi per brevità identificata come “proprietario”, la locazione delle
            seguenti (bicicletta muscolare / bicicletta a pedalata assistita)
            @foreach ($contract->bike as $bike )
                <strong>{{$bike->name}}</strong> 
            @endforeach
            dal <strong>{{$contract->data_inizio}}</strong> al {{$contract->data_fine}}.
            Con un costo totale definito in precedenza di {{$contract->costo}};
        </p>

        <h2 class="text-center my-4">DICHIARA A TAL FINE</h2>

        <p>
            ai sensi e per gli effetti degli artt.38 e 47 del DPR 28.12.2000 n.445 e consapevole delle
            conseguenze anche penali previste in caso di dichiarazioni mendaci degli artt.75 e 76 del
            medesimo DPR,
        </p>

        <ul class="my-2">
            <li>
                di avere preso visione del listino noleggio, servizi e risarcimento danni e del vigente
                regolamento perl’erogazione del servizio di noleggio biciclette (riportato sul retro) che
                costituisce, a tutti gli effetti dilegge, contratto di utenza, le cui condizioni contrattuali
                generali dichiara, ai sensi delle vigentinormative, di conoscere e di accettare, con
                particolare riferimento alle conseguenze incombenti sulnoleggiante in caso di danni
                procurati, durante l’uso del mezzo, a se stesso, alla bicicletta noleggiata, a terzi ed a
                cose ed all’esonero della responsabilità del gestore, ai sensi dell’art.1341, comma 2,
                del codice civile, che sono approvate per iscritto all’atto della sottoscrizione del
                presente modulo di richiesta;
            </li>
            <li>
                di noleggiare la bicicletta muscolare o la bicicletta a pedalata assistita in oggetto per se
                stesso o per conto di terzi e minorenni, di cui si assume tutte le responsabilità.
            </li>
        </ul>

        <p class="my-4">data: </p>

        <p>L'utente</p>
        <br>
        {{-- @dd(asset('storage\sign'.$contract->id.'.png')) --}}
        <img style="width: 50%;" src="{{ storage_path('app/public/sign'.$contract->id.'.jpg') }}" alt="">
        <div class="page-break"></div>
        <div>
            <h5 class="text-center my-3">REGOLAMENTO E CONDIZIONI DI NOLEGGIO</h5>
            <h6 class="text-center my-3">Premessa</h6>
            <p>
                <strong>Il noleggio e l’uso della bicicletta muscolare e della bicicletta a pedalata assistita presuppone la conoscenza ed accettazione incondizionata da parte dell’utente del
                    presente regolamento, delle tariffe, degli orari di apertura e chiusura, della Società Kemedia srl proprietaria del bene con sede in Catania Via VIII Strada n.7- P.iva
                    05245320873</strong>
            </p>
            <ol>
                <li><small>Per ottenere il noleggio di una bicicletta muscolare o di una bicicletta a pedalata assistita l'utente deve presentare preventivamente al punto di noleggio un documento
                    di identità valido, e formalizzare il contratto. Il noleggio è riservato ai maggiorenni. I minorenni necessitano dell’autorizzazione di un rappresentante legale.</small></li>

                <li><small>L'uso della bicicletta muscolare e della bicicletta a pedalata assistita presuppone l'idoneità fisica e la perizia tecnica di chi intende condurla. Pertanto l'utente
                    noleggiando la bicicletta muscolare o la bicicletta a pedalata assistita dichiara di essere dotato di adeguata capacità e di appropriata competenza, senza porre alcuna
                    riserva.</small></li>

                <li><small>La bicicletta muscolare o la bicicletta a pedalata assistita è da utilizzarsi esclusivamente come mezzo di trasporto ed è da trattarsi con attenzione, buon senso e
                    diligenza, in modo da evitare danni sia alla stessa che ai relativi accessori. È vietato servirsi della bicicletta muscolare o della bicicletta a pedalata assistita in maniera
                    illegale o per altri scopi non previsti dal contratto e/o metterla a disposizione di terzi. In particolare è vietato l'uso della bicicletta muscolare o della bicicletta a pedalata
                    assistita nell'ambito di gare o corse di qualsiasi tipo. E' altresì assolutamente vietato trasportare persone sul portapacchi.</small></li>

                <li><small>L'utente è responsabile della bicicletta muscolare o della bicicletta a pedalata assistita dalla consegna e fino alla sua restituzione al proprietario; è inoltre responsabile
                    dei danni causati a se stesso, alla bicicletta muscolare o alla bicicletta a pedalata assistita, a terzi e cose durante l'uso del mezzo. Al proprietario della bicicletta
                    muscolare o della bicicletta a pedalata assistita non potrà essere richiesta nessuna forma di indennizzo. Con la sottoscrizione della presente, pertanto, l'utente
                    dichiara di voler liberare ed esonerare Kemedia s.r.l. da ogni responsabilità e da tutte le azioni ad essa relative, cause e qualsivoglia tipo di procedimento giudiziario
                    e/o arbitrale. Altresì l'utente si impegna formalmente a rifondere direttamente o col tramite d’Assicurazioni eventuali danni causati, da se, o dal proprio figlio/a, a
                    persone, oggetti, infrastrutture e/o alle attrezzature messe a disposizione da Kemedia s.r.l.</small></li>

                <li><small>L'utente è tenuto a verificare lo stato della bicicletta muscolare o della bicicletta a pedalata assistita, nonché i danni o i difetti evidenti prima della partenza. Nel corso
                    di tale verifica vanno controllati in particolare il funzionamento di freni e luci e la pressione degli pneumatici. Se il risultato di tale verifica è negativo, la bicicletta
                    muscolare o la bicicletta a pedalata assistita non sono considerate idonee alla circolazione e non possono essere utilizzate. Nel caso delle biciclette a pedalata
                    assistita, oltre alla verifica di eventuali difetti, va controllato anche lo stato di carica della batteria. Il proprietario non può assicurare che la carica della batteria sia
                    sufficiente per il tragitto previsto. I difetti constatati vanno comunicati al proprietario prima della partenza. L'utente è ritenuto responsabile dei danni che non ha
                    segnalato prima della partenza.</small></li>

                <li><small>L'utente si impegna ad osservare durante l’utilizzo della bicicletta muscolare o della bicicletta a pedalata assistita le prescrizioni impartite dal Codice della Strada e da
                    ogni altro eventuale regolamento comunale, sollevando inoltre il proprietario da ogni violazione amministrativa il cui effetto si produca anche nei confronti dello stesso
                    e che venga rilevata durante l'uso del servizio di noleggio per infrazioni ex D. Lgs 30 aprile 1992 n.285 – Nuovo Codice della strada e successive modificazioni e
                    integrazioni e leggi in materia.</small></li>

                <li><small>Il proprietario può effettuare controlli agli Utenti durante l'uso delle biciclette muscolari o delle biciclette a pedalata assistita e può richiederne la restituzione se ravvisa
                    le condizioni di un utilizzo improprio del veicolo. Il proprietario potrà rifiutare il noleggio a persone in stato di ubriachezza o sotto effetto di sostanze stupefacenti (a
                    norma degli articoli 186-187 del Codice della strada) e per altri motivi ad insindacabile giudizio del proprietario stesso</small></li>

                <li><small>In caso di smarrimento delle chiavi, degli accessori della bicicletta o per danni il proprietario richiederà all'utente la somma necessaria per il ripristino originale del
                    veicolo, sulla base del listino e del preventivo del fornitore; in caso di furto totale l'utente dovrà risarcire il proprietario dell'importo stabilito in euro 3000,00 oltre IVA
                    per ogni bicicletta a pedalata assistita ed in € 1.600,00 oltre IVA per ogni bicicletta muscolare.</small></li>

                <li><small>Non è consentito il noleggio per più di dieci giorni consecutivi; pertanto chi desidera noleggiare la bicicletta o la bicicletta a pedalata assistita per un numero superiore
                    di giorni dovrà presentarsi al punto di noleggio di Kemedia s.r.l. prima dello scadere del settimo giorno e compilare un nuovo contratto di noleggio.</small></li>

                <li><small>La bicicletta muscolare o la bicicletta a pedalata assistita dovranno essere riconsegnate, nel rispetto degli orari comunicati, nello stesso luogo in cui sono state
                    noleggiate Per consegne fuori orario, verrà applicata una tariffa straordinaria oraria di € 5,00 a persona, per ogni ora, o frazione di ora, di ritardo di consegna. Nel
                    caso la riconsegna del materiale non possa avvenire entro l'orario di chiusura, il proprietario deve essere avvisato telefonicamente al numero 3927477337. La
                    bicicletta muscolare o la bicicletta a pedalata assistita sono considerate riconsegnate solo se restituite direttamente al proprietario; non può essere considerata
                    riconsegna il parcheggio della bicicletta muscolare o della bicicletta a pedalata assistita al di fuori del punto di noleggio durante l’orario di chiusura. La mancata
                    restituzione della bicicletta muscolare o della bicicletta a pedalata assistita senza preventiva comunicazione o comunque non motivata da casi eccezionali, sarà
                    considerata alla stregua di un reato di furto e pertanto denunciato alla Autorità Giudiziaria.</small></li>

                <li><small>L'utente potrà richiedere al proprietario un intervento per il ritiro della bicicletta muscolare o della bicicletta a pedalata assistita, il cui costo è indicato nel listino; il
                    proprietario non è tenuto all'intervento, quindi il mancato intervento non può essere causa di inadempimento. E' comunque interesse del proprietario procedere al
                    ritiro della bicicletta muscolare o della bicicletta a pedalata assistita e solo contingenze momentanee possono rendere impossibile l'intervento.</small></li>

                <li><small>L'Utente dovrà corrispondere il relativo pagamento dal momento dell'inizio del noleggio e fino a quando non si presenterà per la chiusura del contratto di noleggio,
                    oltre ad eventuali addebiti per danni, furti totali o parziali.</small></li>

                <li><small>In caso di furto della bicicletta muscolare o della bicicletta a pedalata assistita, l'utente dovrà presentare al proprietario copia della denuncia effettuata presso gli
                    organi competenti e versare l'importo pari al valore della bicicletta muscolare o della bicicletta a pedalata assistita oggetto del furto (vd. Art. 8), che gli verrà restituito
                    in caso di ritrovamento o recupero del veicolo stesso. Da tale somma verrà detratto l'importo corriispondente ad eventuali danni, riparazioni o asportazioni di parti
                    riscontrati sul mezzo.</small></li>

                <li><small>Qualsiasi tipo di pagamento o tassa relativi al noleggio della bicicletta muscolare o della bicicletta a pedalata assistita, come, per esempio, il costo dei biglietti per il
                    trasporto in traghetti, di accesso ad areee soggette al pagamento di un pedaggio, di tickets di parcheggio, ecc. dovrà essere effettuato dall'utente. Anche le spese di
                    eventuali riparazioni sono a carico dell'utente.</small></li>

                <li><small>Per quanto non citato nel presente regolamento il rapporto tra le Parti contraenti è regolato dalle norme del codice civile Per l'interpretazione e l'applicazione del
                    rapporto contrattuale è applicabile il diritto italiano.</small></li>

                <li><small>Per qualsiasi controversia insorta tra le Parti il foro competente è quello di Catania.</small></li>

                <li><small>Il presente contratto di noleggio è valido solo se compilato in ogni sua parte dietro presentazione di un documento d’identità valido per il periodo di noleggio richiesto,
                    e contro - rmato da un adulto/maggiorenne.</small></li>


            </ol>
 

            <p>
                Ai sensi degli artt. 1341 e 1342 cod. civ., l'utente dichiara di aver compreso le condizioni contrattuali e sottoscrive espressamente per accettazione le seguenti clausole: Artt. 1, 2, 3,
                4, 5, 6, 7, 8, 9, 10, 11, 12,13,14,15,16 17.
            </p>

            <p>
                L'utente
            </p>
            <br>
            <img style="width: 50%;" src="{{ storage_path('app/public/sign'.$contract->id.'.jpg') }}" alt="">
            <div class="page-break"></div>
            <br>

            <h4>INFORMATIVA AI SENSI DELL'ART. 13 D.Lgs 30/06/2003 N. 196 E DELL'ART. 13 DEL REGOLAMENTO UE 2016/676
                CONSENSO AL TRATTAMENTO DEI DATI PERSONALI</h4>
            <p>Il sottoscritto dichiara di essere informato ai sensi dell'art. 13 D.Lgs 30/06/2003 n. 196 e dell'art. 13 del Regolamento UE 2016/676 (Codice in materia di protezione dei dati
                personali) che:</p>

            <ul>
                <li>I dati raccolti saranno trattati esclusivamente per gli adempimenti necessari per la conclusione e l’esecuzione del contratto.</li>
                <li>I dati raccolti potrebbero essere comunicati a terzi per gli adempimenti necessari per la conclusione e l’esecuzione del contratto.</li>
                <li>Il conferimento dei dati da parte dell’interessato è obbligatorio sia al fine di poter accedere al servizio sia per consentire a Kemedia s.r.l. la gestione dei successivi
                    adempimenti procedimentali.</li>
                <li>Il trattamento dei dati personali forniti dall’utente sarà effettuato con modalità informatizzate e manuali.</li>
                <li>Titolare del trattamento è il Sig. Scalia Massimo, nato a Catania il 31/5/1977e residente in Valverde (CT) Via Cristaldi n.28 in qualità di legale rappresentante della
                    Kemedia s.r.l. come sopra identificata.</li>
                <li>Il dichiarante ha diritto di accedere ai dati raccolti, ivi compreso l’aggiornamento, la rettifica o la cancellazione degli stessi e può opporsi al trattamento degli stessi per
                    motivi legittimi, come prevede l’art. 7 dlgs 30/6/2003 n. 196.</li>
            </ul>
            <p>Esprimo il consenso <strong> SI </strong> NO</p>
            <p>I dati forniti potranno essere oggetto di trattamento per lo svolgimento di attività commerciali, quali ricerche di mercato, informazioni commerciali, offerte dirette di servizi o
                promozioni o raccolti al fine di rilevare il gradimento del servizio di noleggio.</p>
            <p>Esprimo il consenso <strong> SI </strong> NO</p>
            
            <p>L'utente</p>
            <br>
            <br>
        <img style="width: 50%;" src="{{ storage_path('app/public/sign'.$contract->id.'.jpg') }}" alt="">
            
        </div>
    </div>

</body>
</html>

