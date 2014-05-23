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
        <h3>User Login</h3>
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
                <input type="submit" value="Login">
            </p>
        </form>

        <h3>Compose an Email</h3>
        <form method="Post" action="/my_first_form.php">
            <p>
                <label for="To">To</label>
                <input id="To" name="To" type="email" placeholder="email address here">
            </p>
            <p>
                <label for="From">From</label>
                <input id="From" name="From" type="email" placeholder="email address here">
            </p>
            <p>
                <label for="Subject">Subject</label>
                <input id="Subject" name="Subject" type="text" placeholder="subject">
            </p>
             <p>
                <label for="email_body">Email Body</label>
                <textarea id="email_body" name="email_body" rows="20" cols="100" type="text">
            </textarea>

            <p>
                <input type="submit" value="Send">

            </p>
        </form> 


    </body>
</html>