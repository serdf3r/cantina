<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand btn <?php echo $cantina_disable; ?>"  href="index.php">Cantina</a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link btn <?php echo $inserimento_disable; ?>" href="inserimento_dati.php">Inserimento Dati </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link btn" href="dati_generali.php">Visualizzazione Dati</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link btn disabled" href="ricerca_specifica.php">Ricerca specifica </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link btn disabled" href="anno_corrente.php">Anno Corrente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  btn disabled" href="storico.php">Storico</a>
            </li>
            <li class="nav-item">
                <a class="nav-link btn disabled" href="analisi_vino.php">Analisi Vino</a>
            </li>
             <li class="nav-item">
                <a class="nav-link btn <?php echo $gestisci_disable; ?>" href="gestione_bottiglie.php">Gestisci Bottiglie</a>
            </li>
        </ul>
<!--        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="Cerca qualcosa">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Cerca</button>
        </form>-->
    </div>
</nav>