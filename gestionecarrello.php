
<?php

require_once('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

session_start();





if(isset($_SESSION['id']) && isset($_POST['aggiungi']))




    {
        if(isset($_SESSION['carrello']))
        {
            //controllo se l'elemento gia esiste nel carrello
            $miei_elementi = array_column($_SESSION['carrello'],'Nome');
            if(in_array($_POST['nome'], $miei_elementi))
            {
                
                foreach ($_SESSION['carrello'] as &$item) {
                    if ($item['Nome'] == $_POST['nome']) {
                        $item['Quantita']++;
                        break;
                    }
                }
                header("location: carrello.php");
                
                
            }
            else{

            //se non esiste aggiungo l'elemento
            $count=count($_SESSION['carrello']);
            $_SESSION['carrello'][$count] = array('Nome' =>$_POST['nome'], 'Prezzo' =>$_POST['prezzo'],'Foto' =>$_POST['foto'], 'Quantita'=>'1');
            header("location: carrello.php");
            
            }
        }
        else
        {
            //se il carrello non é stato ancora creato allora lo creo
            $_SESSION['carrello'][0]= array('Nome' =>$_POST['nome'], 'Prezzo' =>$_POST['prezzo'],'Foto' =>$_POST['foto'], 'Quantita'=>'1');
            header("location: carrello.php");
        }
    
    }




if(isset($_POST['rimuovi']))
{
    
    foreach($_SESSION['carrello'] as $key => $value)
    {
        if($value['Nome']==$_POST['nome'])
        {
            unset($_SESSION['carrello'][$key]);
            $_SESSION['carrello']=array_values($_SESSION['carrello']);
            
        }

    }
    header("location: carrello.php");

}
if(isset($_POST['diminuisci']))
{
    
    foreach ($_SESSION['carrello'] as &$item) {
        if ($item['Nome'] == $_POST['nome']) {
            $item['Quantita']--;
            break;
        }
    }
    header("location: carrello.php");
    }

    if(isset($_POST['aumenta']))
{
    
    foreach ($_SESSION['carrello'] as &$item) {
        if ($item['Nome'] == $_POST['nome']) {
            $item['Quantita']++;
            break;
        }
    }
    header("location: carrello.php");
    }
    




?>