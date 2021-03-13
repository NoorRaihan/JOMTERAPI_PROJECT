<?php 
    
?>
<!DOCTYPE html>

<html>
    <head>
        <link rel="stylesheet" href="regis.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>

        <div class="shape1"></div>
        
        <section class="admin-text">
            <h1 class="regist">REGISTER</h1>
        </section>

        <section class="login-form">
            <div class="form-cont">
                <form name="regisform" action="thanks.php" method="POST" onsubmit="return compare()">
                    <label for="fname">First Name</label><br>
                    <input type="text" id="fname" name="fname" placeholder="First Name" value=""><br>

                    <label for="lname">Last Name</label><br>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" value=""><br>
                    
                    <br>

                    <input type="radio" id="male" name="gender" placeholder=""value="1">
                    <label for="male">Male</label>

                    <input type="radio" id="female" name="gender" placeholder="" value="2">
                    <label for="female">Female</label><br>
                    
                    <br>

                    <label for="p-num">pnumber</label><br>
                    <input type="number" id="pnumber" name="p-num" placeholder="Phone Number" value=""><br>

                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username" placeholder="Username" value=""><br>

                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" placeholder="Email address" value=""><br>

                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" placeholder="Password"><br>
                    
                    <label for="cpassword">Password</label><br>
                    <input type="password" id="cpassword" name="cpassword" placeholder="Retype Password"><br>

                    <input type="submit" name="submit" value="REGISTER"> 
                </form>
            </div>
        </section>

        <script>

            function compare() {
                f1 = document.forms["regisform"]["cpassword"].value;
                f2 = document.forms["regisform"]["password"].value;

                if (f1 != f2){
                    alert("Confirmation password not same!");
                    return false;
                }
            }
        
        </script>
        <script src="" async defer></script>
    </body>
</html>