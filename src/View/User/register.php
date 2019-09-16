<?php 
    if (isset($statusMessage)) {
        echo $statusMessage;
    }
?>
<title>Register</title>
<p>Formulaire register : </p>
<form action="" method="POST">
    <label for="user_mail"><b>Mail</b></label>
    <input type="email" placeholder="Enter your mail" name="user_mail" required>
    <label for="user_pwd"><b>Nickname</b></label>
    <input type="password" placeholder="Enter your password" name="user_pwd" required>
    <br>
    <br>
    <button type="submit">Send</button>
</form>

<?php 
// foreach ($tweets as $tweet) {
//     echo 'Le mot est : '. $tweet . '<br>';
// }
?>