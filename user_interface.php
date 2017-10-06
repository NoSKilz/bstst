<?php
error_reporting(0);
include_once 'resources/headers.php';
include_once 'resources/functions.php';
spl_autoload_register('loadclass');
$db1=new database();
$db=$db1::connect('localhost','project','root','');
$user=new user();
include_once 'resources/register.php';
include_once 'resources/login.php';
include_once 'resources/change_p_m.php';
if($_GET['action']=='logout')
{
    $user->logout();
}
$result=$db1::execute_query('SELECT admin FROM user WHERE user_id = :id',[':id' => $_SESSION['user_id']]);
$result0=$result->fetch(PDO::FETCH_ASSOC);
if(!$user->loggedin()||(int)$result0['admin']==1)
{
    header("Location:index.php");
}
?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
        <title>Some title</title>
        <link rel="canonical" href="http://www.bstst.8u.cz">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="keywords" content="maturita,eshop" >
        <meta name="description" content="Projekt dlouhodobé maturitní práce.">
        <!--GOOGLE+-->
        <link rel="author" href="https://plus.google.com/u/0/115111710746527975391">
        <link rel="publisher" href="">
        <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
        <link href="custom/css/interface.min.css" rel="stylesheet" type="text/css"/>
        <link rel="icon" type="image/gif" href="favicon.ico" />
        <?php
        if($user->loggedin())
        {
           echo '<link type="text/css" href="custom/css/logged.min.css" rel="stylesheet">';
        }
        ?>
    </head>
    <body>
        <noscript>
            K správnému chodu stránky je potřeba mít aktivovaný JavaScript.
        </noscript>
        <div id="content">
            <?php
                include_once 'resources/success.php';
                include_once 'resources/errors.php';
            ?>
            <header>
                <div id="reg-log">
                    <?php
                    include_once 'resources/islogged.php';
                    ?>
                </div>
                <div id="search">
                    <div id="form-container">
                        <form method="get" action="result.php">
                            <div id="suggestions-container">
                                <input id="search-input" type="search" name="search" placeholder="Vyhledat hru" autocomplete="off"/>
                                <div id="suggestions"></div>
                            </div>
                            <input type="submit" name="s-submit" value="Hledat"/>
                        </form>
                    </div>
                    <a href="cart.php"><button id="cart-btn" class>Košík    <?php if(isset($_SESSION['cart'])){echo "({$_SESSION['number']})";}else{} ?></button></a>
                </div>
                <div id="navigation">
                    <div id="navigation-container">
                        <ul id="navigation-ul">
                            <?php
                                include_once 'resources/navigation.php';
                            ?>
                        </ul>
                    </div>
                    <div id="accordion-container">
                        <?php
                            include_once 'resources/acc_navigation.php';
                        ?>
                    </div>
                </div>
            </header>
            <div id="main">
                <div id="product">
                    <div id="interface-container">
                        <form id="new-mail" method="post" action="user_interface.php">
                            <fieldset>
                                <legend>Změna e-mailu</legend>
                                <label for="n-mail">
                                    Nový email
                                </label>    
                                <input type="email" name="n-mail" id="n-mail" placeholder="Nový e-mail" maxlength="40" minlength="1" required/>
                                <label for="n-mail-c">
                                    Nový email znovu
                                </label>    
                                <input type="email" name="n-mail-c" id="n-mail-c" placeholder="Nový e-mail znovu" maxlength="40" minlength="1" required/>
                                <label for="e-password">
                                    Heslo
                                </label>    
                                <input type="password" name="e-password" id="e-password" placeholder="Heslo" minlength="4" required/>
                                <input type="submit" name="mail-submit" value="Změnit email" id="n-e-submit"/>
                            </fieldset>
                        </form>  
                        <form id="new-pass" method="post" action="user_interface.php">
                            <fieldset>
                                <legend>Změna hesla</legend>
                                <label for="n-pass">
                                    Nové heslo
                                </label>    
                                <input type="password" name="n-pass" id="n-pass" placeholder="Nové heslo" maxlength="40" minlength="1" required/>
                                <label for="n-pass-c">
                                    Nové heslo znovu
                                </label>    
                                <input type="password" name="n-pass-c" id="n-pass-c" placeholder="Nové heslo znovu" maxlength="40" minlength="1" required/>
                                <label for="o-password">
                                    Staré heslo
                                </label>    
                                <input type="password" name="o-password" id="o-password" placeholder="Staré heslo" minlength="4" required/>
                                <input type="submit" name="pass-submit" value="Změnit heslo" id="n-p-submit"/>
                            </fieldset>
                        </form> 
                        <div id="table-container">
                        <?php
                            include_once 'resources/show_orders.php';
                        ?>
                        </div>
                    </div>
                </div>
                <div id="new">
                    <p id="n-p">NOVĚ VYDANÉ HRY</p>
                    <div id="new-container">
                        <?php
                            include_once 'resources/newest_games.php';
                        ?>
                    </div>
                </div>
                <div id="best">
                    <p id="b-p">NEJPRODÁVANĚJŠÍ HRY</p>
                    <?php
                        include_once 'resources/best_games.php';
                    ?>
                </div>
            </div>
            <footer>
                    <p>© 2016 <a href="#">Radek Šimíček</a>, All Rights Reserved.</p>
            </footer>
        </div>
      <script src="custom/js/main.script.min.js" nonce="<?php echo $nonce;?>"></script>
      <script src="custom/js/suggestions.min.js" nonce="<?php echo $nonce;?>"></script>
    </body>
</html>
