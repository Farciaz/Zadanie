<?php


if (isset($_REQUEST['action']) && $_REQUEST['action'] == "register") {
    $db = new mysqli("localhost", "root", "", "auth");
    $email = $_REQUEST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    $password = $_REQUEST['password'];
    $passwordRepeat = $_REQUEST['passwordRepeat'];

    if($password == $passwordRepeat) {
        $q = $db->prepare("INSERT INTO register VALUES (NULL, ?, ?)");
        $passwordHash = password_hash($password, PASSWORD_ARGON2I);
        $q->bind_param("ss", $email, $passwordHash);
        $result = $q->execute();
        if($result) {
            echo "Konto utworzono poprawnie"; 
        } else {
            echo "Coś poszło nie tak!";
        }
    } else {

        echo "Hasła nie są zgodne - spróbuj ponownie!";
    }
}



?>
<link rel="stylesheet" href="style.css">
<div class="top-bar">
    <h2>Coś o nas</h2>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic quis sunt voluptas omnis saepe maxime nemo nihil ipsum magni architecto. Veritatis ratione, maiores nisi tempore nam numquam reprehenderit repellat soluta.
</div>
<h4>Co oferujemy?</h4>
Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus expedita libero voluptas doloribus harum voluptatem necessitatibus totam nesciunt atque voluptate? Deleniti, inventore! Tenetur minus dolor molestiae autem totam adipisci tempore!
<h3>Chcesz od nas dołączyć?</h3>
<h1>Zarejestruj się</h1>
<form action="index.php" method="post">
    <label for="emailInput">Email:</label>
    <input type="email" name="email" id="emailInput">
    <label for="passwordInput">Hasło:</label>
    <input type="password" name="password" id="passwordInput">
    <label for="passwordRepeatInput">Hasło ponownie:</label>
    <input type="password" name="passwordRepeat" id="passwordRepeatInput">
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Zarejerstuj">
</form>