<?php
session_start();
  $ref = $_GET['reference'];
  if($ref == ""){
    header("location:error-404.html");
  }

  $curl = curl_init();
  
  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.paystack.co/transaction/verify/".rawurlencode($ref),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "Authorization: Bearer PAYSTACK_SECRET_KEY",
      "Cache-Control: no-cache",
    ),
  ));
  
  $response = curl_exec($curl);
  $err = curl_error($curl);
  curl_close($curl);
  
  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    // echo $response;
    $result = json_decode($response);

  }

  if($result ->data->status == "success"){
    $user_id = $_SESSION['author_id'];
    $status = $result->data->status;
    $reference = $result->data->reference;
    $lname = $result->data->customer->last_name;
    $fname = $result->data->customer->first_name;
    $amount = $result->data->amount;
    $amount = $amount / 100;

    $full_name = $fname." ".$lname;
    $email = $result->data->customer->email;
    date_default_timezone_set('Africa/Lagos');
    $date = Date('m/d/Y h:i:s a', time());
    // exit($full_name);
    include("../../includes/db_conn.php");
    $query = mysqli_query($conn,"UPDATE users SET payed = 'true' WHERE id = '$user_id'");
    if(!$query){
      exit(mysqli_error($conn));
    }else{
      // header("location:../../index.php");
    }

    

  }else{
    header("location:register.php");
  }
?>