<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "tecnleaf@tecnleaf.com.br";
    $email_subject = "tecnleaf";
 
    function died($error) {
        // your error code can go here
        echo "Lamentamos, mas foram encontrados erros no formulário que você preencheu.";
        echo "Esses erros aparecem abaixo.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor, Volte e corrija esses erros.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['message'])) {
        died('Lamentamos, mas parece haver um problema com o formulário que você preencheu.');       
    }
 
     
 
    $first_name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['subject']; // not required
    $comments = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'O endereço de email digitado não parece ser válido.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'O Nome digitado não parece ser válido.<br />';
  }
 
  #if(!preg_match($string_exp,$last_name)) {
  #  $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  #}
 
  if(strlen($comments) < 2) {
    $error_message .= 'Os comentários inseridos no campo de texto não parecem ser válidos.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Detalhes do Forumlário abaixo:\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($first_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Subject: ".clean_string($telephone)."\n";
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Obrigado por nos contatar. Entraremos em contato o mais rápido possível.
 
<meta http-equiv="refresh" content="4;url=http://tecnleaf.com.br">

<?php
 
}
?>