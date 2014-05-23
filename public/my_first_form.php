<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8">
            <title>My First HTML Form</title>
    </head>
    <body>
    <?php
    var_dump($_GET);
    var_dump($_POST);
    ?>
        <form method="POST" action="/my_first_form.php">
            <p>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" placeholder="username here">
            </p>
            <p>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="password here">
            </p>
            <p>
                <input type="button" value="Login">
            </p>
        </form>
    </body>
</html>