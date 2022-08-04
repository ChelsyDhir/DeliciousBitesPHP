<?php

class CustomerPage  {

    public static $notifications;

    
    static function showHeader() { ?>
          <!DOCTYPE html>
        <html>
            <head>
                <title>Delicious Bites!</title>
                <meta charset="utf-8">
                <meta name="author" content="Chelsy, Chelsy">
                <link rel="stylesheet" href="css/styles.css">
            </head>
            <body>
                <section>
                    <h1>Welcome to Delicious Foods!</h1> 
        </section>   
    <?php }

    
    static function showFooter()   { ?>        
            </div>
                </body>
            </html>
    <?php }
    
    static function showLogin() { ?>
        <!-- login section -->        
        <section>
            <div>                
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <h2>Please Sign in</h2>
                    <div>
                        <label for="email">Email Address</label>
                        <input type="email" name="email" placeholder="Email address for login" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div>
                        <input type="submit" name="submit" value="Login">
                    </div>
                    <p>Do not have an account? Please <a href="FinalProject_register.php">register</a></p>                
                </form>
            </div>
        </section>
    </body>
</html>
    <?php }

    
    static function showRegistration() { ?>
        <!-- register section -->
        <section>
            <div>
                <p>Have an account? Please <a href="FinalProject_login.php">login</a></p>                
                    
                    <?php 
                    if(!empty(Validate::$valid_status)){
                         ?><p class="error">All inputs are required. 
                            <br><?php
                    foreach(Validate::$valid_status as self::$notifications){
                       echo self::$notifications ."<br>";
                    }}?>
                <form action="" method="post">
                    <h2>Please fill the form</h2>
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Customer Name" required>
                    </div>
                    <div>
                        <label for="email">Email Address</label>
                        <input type="email" name="email" placeholder="Email address for login" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <div>
                        <label for="password">Password confirm</label>
                        <input type="password" name="password2" placeholder="Password confirm" required>
                    </div>                    
                    <div>
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" placeholder="(XXX) XXX XXXX" required>
                    </div>                                        
                    <div>
                        <input type="submit" name="submit" value="Register">
                    </div>
                </form>
            </div>
        </section>

    </body>
</html>
    <?php }
    
}