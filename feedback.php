<?php
    
    ini_set("display_errors", 1); 
        
    if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
      if (isset($_POST['message']) AND isset($_POST['address'])) {
        $to = 'bitdust.io@gmail.com';

        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        $sent = email($to, $address, $message);
        if ($sent) {
          echo 'Message sent!';
        } else {
          echo 'Message couldn\'t sent!';
        }
      } else {
        echo 'All Fields are required';
      }
      return;
    }

    function email($to, $address, $message){
      $header = array();
      $header[] = "MIME-Version: 1.0";
      $header[] = "From: {$to}<{$to}>";
      $header[] = "Content-type:text/html; charset=iso-8859-1";
      $header[] = "Content-Transfer-Encoding: 7bit";
      $body = '\r\n\r\n';
      $body = $body . 'IP: ' . $_SERVER['REMOTE_ADDR'] . '\r\n';
      $body = $body . 'Contact: ' . $address . '\r\n';
      $body = $body . 'Message:\r\n' . $message . '\r\n';
      if(mail($to, 'message received from [bitdust.io]', $body, implode("\r\n", $header)))
          return true; 
      return false;
    }
  
?>    