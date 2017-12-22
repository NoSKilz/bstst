<?php
include_once 'resources/headers.php';
include_once 'resources/functions.php';
spl_autoload_register('loadclass');
$db1=new database();
$db=$db1::connect('localhost','project','root','');
$user=new user($db1);
include_once 'resources/register.php';
include_once 'resources/login.php';
if($_GET['action']=='logout')
{
    $user->logout();
}
$result=$db1::execute_query('SELECT admin FROM user WHERE user_id = :id',[':id' => $_SESSION['user_id']]);
$isadmin=$result->fetch(PDO::FETCH_ASSOC);
if(!$user->loggedin()||(int)$isadmin!=1)
{
    header("Location:index.php");
}
$adm=$_GET['adm'];
$s_adm=strip_tags($adm);
if($s_adm=="users.php")
{
    $delete=$_GET['delete'];
    $s_delete=strip_tags($delete);
    if(isset($adm,$delete)&&!empty($delete))
    {
        $errors=[];
        $success=[];
        $result=$db1::execute_query('DELETE FROM user WHERE user_id=:id',[":id"=>$s_delete]);
        if($result)
        {
            array_push($success,'Uživatel byl úspěšně smazána.');
            $_SESSION['success']=$success;
            header("Location:administration.php?adm={$s_adm}");
        }
        else
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
            $_SESSION['errors']=$errors;
            header('Refresh:0'); 
        }
    }
}
if($s_adm=="genres.php")
{
    $mod=$_GET['modify'];
    $s_mod=strip_tags($mod);
    $delete=$_GET['delete'];
    $s_delete=strip_tags($delete);
    if(isset($adm,$delete)&&$s_adm=="genres.php")
    {
        $errors=[];
        $success=[];
        $result=$db1::execute_query('DELETE FROM genre WHERE genre_id=:id',[":id"=>$s_delete]);
        if($result)
        {
            array_push($success,'Kategorie byla úspěšně smazána.');
            $_SESSION['success']=$success;
            header("Location:administration.php?adm=".$s_adm."");
        }
        else
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
            $_SESSION['errors']=$errors;
            header("Location:administration.php?adm=".$s_adm.""); 
        }
    }
    if(isset($adm,$mod,$_POST['cat-m-submit'])&&$s_adm=="genres.php")
    {
        $errors=[];
        $success=[];
        $name=$_POST['cat-m-name'];
        $s_name=strip_tags($name);
        if(!isset($name))
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
        }
        if(empty($name))
        {
            array_push($errors,'Musí být vyplněna všechna pole.');
        }
        if(empty($errors))
        {
            try
            {
                $result=$db1::execute_query('UPDATE genre SET genre_name=:name WHERE genre_id=:id',[":name"=>$s_name,":id"=>$s_mod]);
                if($result)
                {
                    array_push($success,'Kategorie byla úspěšně upravena.');
                    $_SESSION['success']=$success;
                    header("Location:administration.php?adm=".$s_adm."");
                }
                else
                {
                    array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
                    $_SESSION['errors']=$errors;
                    header("Location:administration.php?adm=".$s_adm.""); 
                }
            }
            catch(Exception $e)
            {
                array_push($errors,'Kategorie se stejným jménem již existuje');
                $_SESSION['errors']=$errors;
                header("Location:administration.php?adm=".$s_adm."");
            }
        }
        else
        {
            $_SESSION['errors']=$errors;
            header("Location:administration.php?adm=".$s_adm."");
        }
    }
    if(isset($adm,$_POST['cat-submit'])&&$s_adm=="genres.php")
    {
        $errors=[];
        $success=[];
        $category=$_POST['cat-name'];
        $s_category=strip_tags($category);
        if(!isset($category))
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
        }
        if(empty($category))
        {
            array_push($errors,'Musí být vyplněna všechna pole.');
        }
        if(empty($errors))
        {
            try
            {
                $result=$db1::execute_query("INSERT INTO genre(genre_name) VALUES(:gname)",[":gname"=>$s_category]);
                if($result)
                {
                    array_push($success,'Kategorie byla úspěšně přidána.');
                    $_SESSION['success']=$success;
                    header("Location:administration.php?adm=".$s_adm."");
                }
                else
                {
                    array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
                    $_SESSION['errors']=$errors;
                    header("Location:administration.php?adm=".$s_adm."");
                }
            }
            catch(Exception $e)
            {
                array_push($errors,'Kategorie se stejným jménem již existuje');
                $_SESSION['errors']=$errors;
                header("Location:administration.php?adm=".$s_adm."");
            }
        }
        else
        {
            $_SESSION['errors']=$errors;
            header("Location:administration.php?adm=".$s_adm."");
        }
    }
}
if($s_adm=="orders.php")
{
    if(isset($adm,$_GET['delete'])&&$s_adm=="orders.php")
    {
        $delete=$_GET['delete'];
        $s_delete=strip_tags($delete);
        $result=$db1::execute_query('DELETE FROM goods_order WHERE order_id=:id',[":id"=>$s_delete]);
        if($result)
        {
            array_push($success,'Objednávka byla úspěšně smazána.');
            $_SESSION['success']=$success;
            header("Location:administration.php?adm=".$s_adm."");
        }
        else
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
            $_SESSION['errors']=$errors;
            header("Location:administration.php?adm=".$s_adm.""); 
        }
    }
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
        <meta charset="UTF-8">
        <title>Maturita</title>
        <link href="custom/css/adm-main.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
    </head>
    <body>
        <div id="all">
            <?php
                include_once 'resources/success.php';
                include_once 'resources/errors.php';
            ?>
            <div id="content">
                <div id="list">
                    <ul>
                        <li><a href="index.php">Zpět do obchodu</a></li>
                        <li><a href="administration.php?adm=users.php">Registrovaní uživatelé</a></li>
                        <li><a href="administration.php?adm=products.php">Produkty</a></li>
                        <li><a href="administration.php?adm=orders.php">Objednávky</a></li>
                        <li><a href="administration.php?adm=genres.php">Kategorie</a></li>
                    </ul>
                </div>
                <?php
                    if(isset($_GET['adm']))
                    {
                        include 'administration/'.$_GET['adm'].'';
                    }
                ?>
            </div>
            <footer>
                    <p>© 2016 <a href="#">Radek Šimíček</a>, All Rights Reserved.</p>
            </footer>
        </div>
        <script src="custom/js/main.script.min.js" nonce="<?php echo $nonce;?>"></script>
    </body>
</html>