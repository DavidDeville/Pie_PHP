<title>Login</title>
<p>Formulaire de login : </p>
<form action="/PiePHP/login" method="POST">
    <label for="user_mail"><b>Mail</b></label>
    <input type="email" placeholder="Enter your mail" name="user_mail" required>
    <label for="user_pwd"><b>Nickname</b></label>
    <input type="password" placeholder="Enter your password" name="user_pwd" required>
    <button type="submit">Send</button>
</form>

<?php
    if (isset($statusMessage)) {
        echo $statusMessage;
    }
?>