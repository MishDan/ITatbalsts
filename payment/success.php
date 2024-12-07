<?php
    if(!empty($_GET['session_id'])){
        session_start();
        $session_id = $_GET['session_id'];

        require_once '../../../stripe-php-master/init.php';
        require_once 'config.php';
    try{

        $checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
        $customer_email = $checkout_session->customer_details->email;

        $paymentIntent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);

        if($paymentIntent->status=='succeeded'){
            $transactionID = $paymentIntent->id;

             $statusMsg = "
                <h2>Maksajums veksmigi apstradats</h2>
                <p>Lai turpmak iegut pro privilegijas, veicot jaunu pieteikumu, izmantojot so e-pastu <b>$customer_email</b> </p>
                <p>Maksajuma reference: <b>$transactionID</b></p>
            ";
            require "../admin/database/con_db.php";


            if(!empty($customer_email) && !empty($paymentIntent) ){
                $vaicajums = $savienojums->prepare("INSERT INTO IT_maksajums (maksajums_ref, maks_epasts) VALUES (?, ?)");
                $vaicajums->bind_param("ss", $transactionID, $customer_email);
                if($vaicajums->execute()){
                    echo "Pieteikums veiksmīgi pievienots!";
                }else{
                    echo "Kļūda sistēmā: ".$vaicajums->error;
                }
                $vaicajums->close();
                $savienojums->close();
            }else{
                echo "Visi ievades lauki nav aizpildīti!";
            }
        
        
        }else{
             $statusMsg = "Problemas ar maksajuma apstradi!";
        }

    }catch(Exception $e){
        $statusMsg = "Nav iespejams iegut maksajuma informaciju: ".$e->getMessage();
    }
    $_SESSION['pazinojums'] = $statusMsg;
    }
    header("Location: ../");

?>