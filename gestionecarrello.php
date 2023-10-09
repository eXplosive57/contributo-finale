
<?php

require_once('config.php');
$con = new mysqli($host,$userName,$password,$dbName);

session_start();





if(isset($_SESSION['id']) && isset($_POST['aggiungi']))




    {
        if(isset($_SESSION['carrello']))
        {
            $miei_elementi = array_column($_SESSION['carrello'],'Nome');
            if(in_array($_POST['nome'], $miei_elementi))
            {
                $_SESSION['esiste'] = "Prodotto giá nel carrello!";
                header("location: carrello.php");
                
                
            }
            else{

            
            $count=count($_SESSION['carrello']);
            $_SESSION['carrello'][$count] = array('Nome' =>$_POST['nome'], 'Prezzo' =>$_POST['prezzo'],'Foto' =>$_POST['foto'], 'Quantita'=>$_POST['qty']);
            header("location: carrello.php");
            
            }
        }
        else
        {
            $_SESSION['carrello'][0]= array('Nome' =>$_POST['nome'], 'Prezzo' =>$_POST['prezzo'],'Foto' =>$_POST['foto'], 'Quantita'=>$_POST['qty']);
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



?>