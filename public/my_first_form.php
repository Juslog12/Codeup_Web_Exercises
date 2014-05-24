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
            <label for="mailing_list">Would you like to save this message to your sent folder?
            <input type="checkbox" id="mailing_list" name="mailing_list" value="yes" checked> 
            </label>
        </form> 

        <h3>Multiple Choice Test</h3>
        <form method="Post" action="/my_first_form.php"> 
            <p>What is the capital of Texas?</p>
                <label for="q1a">
                    <input type="radio" id="q1a" name="q1" value="Houston">
                    Houston
                </label> 
                <label for="q1b">
                    <input type="radio" id="q1b" name="q1" value="Dallas">
                    Dallas
                </label> <label for="q1c">
                    <input type="radio" id="q1c" name="q1" value="Austin">
                    Austin
                </label> <label for="q1d">
                    <input type="radio" id="q1d" name="q1" value="San Antonio">
                    San Antonio
                </label>  

            <p>What is the capital of California?</p>
                <label for="q2a">
                    <input type="radio" id="q2a" name="q2" value="Los Angeles">
                    Los Angeles
                </label> 
                <label for="q2b">
                    <input type="radio" id="q2b" name="q2" value="San Francisco">
                    San Francisco
                </label> <label for="q2c">
                    <input type="radio" id="q2c" name="q2" value="Fresno">
                    Fresno
                </label> <label for="q2d">
                    <input type="radio" id="q2d" name="q2" value="Sacramento">
                    Sacramento
                </label> 
            <p>
                <input type="submit" value="Submit">
            </p>   

            <p>What states have you lived in?</p> 
                <label for="state1"><input type="checkbox" id=state1 name="state of[]" value ="California">California</label>    
                <label for="state2"><input type="checkbox" id=state2 name="state of[]" value ="Texas">Texas</label>    
                <label for="state3"><input type="checkbox" id=state3 name="state of[]" value ="North Carolina">North Carolina</label>    
                <label for="state4"><input type="checkbox" id=state3 name="state of[]" value ="Florida">Florida</label>    
            <p>
                <input type="submit" value="Submit">
            </p> 
            <label for="os">What type of mobile phone do you have?</label>
            <select id="os" name="os">
                <option>iOS</option>
                <option>Android</option>
                <option>Windows</option>
            </select>  
            <p>
                <input type="submit" value="Submit">
            </p>        
        </form>  

        <h3>Select Testing</h3>
        <form>
            <label for="phone">Do you have a mobile phone?</label>
            <select id="phone" name="phone">
                <option value="1">yes</option>
                <option value="0">no</option>
            </select>  
            <p>
                <input type="submit" value="Submit">
            </p>      
        </form>  

    </body>
</html>