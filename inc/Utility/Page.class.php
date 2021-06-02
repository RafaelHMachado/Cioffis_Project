<?php
class Page  {

    public static $title = "Please set your title!";
    public static $menu = false;

    static function header()   { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>

        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/skeleton.css">
        <link rel="stylesheet" href="css/materialize.css">
        <link rel="stylesheet" href="css/style.css">

        <title>Cioffi's Web-Based System</title>

        <!-- Favicon
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
        <link rel="icon" type="image/png" href="images/favicon.png">

        </head>
        <body>

        <!-- Primary Page Layout
        –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            <?php
            if(self::$title == 'Login'){
                echo '<div class="container">';
            }
            ?>
            <img src="images/cioffi-logo-250x110.png" style="max-width:250px" />
            <?php
            if(self::$menu){
            ?>
                <nav class="blue-grey darken-3" role="navigation">
                    <ul class="right hide-on-med-and-down">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="account.php">My Account</a></li>
                        <li><a href="users.php">Users</a></li>
                        <li><a href="customers.php">Customers</a></li>
                        <li><a href="dispatch.php">Dispatch</a></li>
                        <li><a href="login.php?logout=true">Log Out</a></li>
                    </ul>
                </nav>
            <?php
            }
            if(self::$title == 'User Edit' || self::$title == 'New User'){
                echo '<div class="container">';
            }
            ?>
            <!--div class="one-half column" style="margin-top: 5%"-->
                <h4><?php echo self::$title; ?></h4>
    <?php }

    static function footer()   { ?>
            <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
    </html>

    <?php }

    static function listUser($userData)    {

        if(self::$title != "My Account"){
            echo '<a href="users.php?action=newUser">Create new</a>';
        }

        echo '<table class="u-full-width">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>User</th>
            <th>Position</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tbody>';

        foreach ($userData as $user)    {
            echo '<tr>
            <td>'.$user->getEmpID().'</td>
            <td>'.$user->getName().'</td>
            <td>'.$user->getPhone().'</td>
            <td>'.$user->getEmail().'</td>
            <td>'.$user->getUser().'</td>
            <td>'.$user->getPosition().'</td>
            <td><a href="users.php?action=edit&empid='.$user->getEmpID().'">Edit</a></td>
            <td><a href="'.$_SERVER["PHP_SELF"].'?action=delete&empid='.$user->getEmpID().'
            ">Delete</A></td>
            </tr>';
        }
        
        echo '</tbody>
        </table>';
  
    }

    static function showLoginForm($err)   { ?>
            <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="row">


                <div class="eight columns">
                <label for="user">User</label>
                <input class="u-full-width" type="text" placeholder="Username" id="user" name="user">

                <label for="pass">Password</label>
                <input class="u-full-width" type="password" placeholder="Password" id="pass" name="pass">

                <?php
                if ($err) {
                    echo '<span style="color: red; font-size: small;">Wrong User or Password. Please, try again!</span><br /><br />';
                }
                ?>
    
                <input class="button-primary" type="submit" value="Submit">
                </div>
            

            </div>
            
            </form>
        </div>

    <?php }

    static function editUser($userData){ ?>
        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="row">

                <?php foreach($userData as $user) {

                    echo '<div class="eight columns">
                    <input type="hidden" name="empid" id="empid" value="'.$user->getEmpID().'" />
                    <label for="name">Name</label>
                    <input class="u-full-width" type="text" placeholder="Full Name" id="name" name="name" value="'.$user->getName().'">

                    <label for="phone">Phone</label>
                    <input class="u-full-width" type="text" placeholder="Phone Number" id="phone" name="phone" value="'.$user->getPhone().'">

                    <label for="email">Email</label>
                    <input class="u-full-width" type="text" placeholder="Email" id="email" name="email" value="'.$user->getEmail().'">
                    
                    <label for="user">User</label>
                    <input class="u-full-width" type="text" placeholder="Username" id="user" name="user" value="'.$user->getUser().'" readonly>

                    <label for="position">Position</label>
                    <input class="u-full-width" type="text" placeholder="Position" id="position" name="position" value="'.$user->getPosition().'">
        
                    <input class="button-primary" type="submit" value="Submit">
                    </div>';
                
                } ?>
            </div>
            
            </form>
        </div>
    <?php }

    static function newUser(){ ?>
        <form method="POST" ACTION="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="row">

                <div class="eight columns">
                    <label for="name">Name</label>
                    <input class="u-full-width" type="text" placeholder="Full Name" id="name" name="name">

                    <label for="phone">Phone</label>
                    <input class="u-full-width" type="text" placeholder="Phone Number" id="phone" name="phone">

                    <label for="email">Email</label>
                    <input class="u-full-width" type="text" placeholder="Email" id="email" name="email">
                    
                    <label for="user">User</label>
                    <input class="u-full-width" type="text" placeholder="Username" id="user" name="user">

                    <label for="pass">Password</label>
                    <input class="u-full-width" type="password" placeholder="Password" id="pass" name="pass">

                    <label for="position">Position</label>
                    <input class="u-full-width" type="text" placeholder="Position" id="position" name="position">
        
                    <input class="button-primary" type="submit" value="Submit">
                </div>
            </div>
        </form>
        </div>
    <?php }

    static function homepage(){
        echo '<div class="eleven columns homepage">
                <div class="two columns homepage">
                    <a href="account.php"><img src="images/account.png" />
                    <figcaption>My Account</figcaption></a>
                </div>
                <div class="two columns homepage">
                    <a href="users.php"><img src="images/users-17.png" />
                    <figcaption>Users</figcaption></a>
                </div>
                <div class="two columns homepage">
                    <a href="customers.php"><img src="images/customers-icon-12.png" />
                    <figcaption>Customers</figcaption></a>
                </div>
                <div class="two columns homepage">
                    <a href="dispatch.php"><img src="images/dispatch-15.png" />
                    <figcaption>Dispatch</figcaption></a>
                </div>
            </div>';
    }

    static function maintenance(){
        echo '<div class="eleven columns">
                <h1>Under Maintenance...</h1>
                <img src="images/maintenance.png" />
                <figcaption>Sorry for the inconvenience. We\'ll be back soon!</figcaption>
            </div>';
    }
} ?>