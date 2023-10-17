<?php

include('config.php');
$con = new mysqli($host,$userName,$password,$dbName);


session_start();



$cre = $con->real_escape_string($_POST['cre']);

$xmlDoc = new DOMDocument();
$xmlDoc->load("storico_cre.xml")

$richieste = $xmlDoc->getElementsByTagName("richiesta");

foreach ($richieste as $richiesta) {
    $nome = $richiesta->getElementsByTagName("nome")->item(0)->textContent;
    $cognome = $richiesta->getElementsByTagName("cognome")->item(0)->textContent;
    $qnt = $richiesta->getElementsByTagName("qnt")->item(0)->textContent;

?>


<div class='centro_tab'>
    <main class='table'>
      <section class='table_header'>
        <h1>RICHIESTE RICEVUTE</h1>
      </section>
          <section class="table__body">
                      <table>
                          <thead>
                              <tr>
                                  <th> NOME UTENTE <span class="icon-arrow">&UpArrow;</span></th>
                                  <th> QUANTITA <span class="icon-arrow">&UpArrow;</span></th>
                                  <th></th>
                              </tr>
                          </thead>
                          </tbody>
                      
            </section>
    
    <tr>
      <td><?php echo $nome . + $cognome ?></td>
      <td>x<?php echo $qnt ?></td>
    </tr>
</div>
</table>
</body>