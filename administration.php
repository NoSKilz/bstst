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
    $delete=$_GET['delete'];
    $s_delete=strip_tags($delete);
    if(isset($adm,$delete)&&$s_adm=="orders.php")
    {
        $errors=[];
        $success=[];
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
if($s_adm=="products.php")
{
    $mod=$_GET['modify'];
    $s_mod=strip_tags($mod);
    $delete=$_GET['delete'];
    $s_delete=strip_tags($delete);
    if(isset($adm,$delete)&&$s_adm=="products.php")
    {
        $errors=[];
        $success=[];
        $result=$db1::execute_query("SELECT picture FROM product WHERE product_id=:id",[":id"=>$s_delete]);
        $file=$result->fetchColumn();
        if(file_exists('images/'.$file))
        {
            unlink("images/".$file);
        }
        $result0=$db1::execute_query('DELETE FROM product WHERE product_id=:id',[":id"=>$s_delete]);
        if($result0)
        {
            array_push($success,'Hra byla úspěšně smazána.');
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
    if(isset($adm,$_POST['prod-submit'])&&$s_adm=="products.php")
    {
        $errors=[];
        $success=[];
        $name=$_POST['prod-name'];
        $description=$_POST['prod-description'];
        $platform=$_POST['prod-platform'];
        $genre=$_POST['prod-genre'];
        $price=$_POST['prod-price'];
        $sold=$_POST['prod-sold'];
        $stock=$_POST['prod-stock'];
        $time=$_POST['prod-time'];
        $f_name=$_FILES['prod-image']['name'];
        $f_size=$_FILES['prod-image']['size'];
        $f_type=$_FILES['prod-image']['type'];
        $f_tmp=$_FILES['prod-image']['tmp_name'];
        $s_name=strip_tags($name);
        $s_description=strip_tags($description);
        $s_platform=strip_tags($platform);
        $s_genre=strip_tags($genre);
        $s_price=strip_tags($price);
        $s_sold=strip_tags($sold);
        $s_stock=strip_tags($stock);
        $s_time=strip_tags($time);
        $explode = explode('.', $f_name);
        $ext = end($explode);
        $allowed = array('jpg','jpeg','gif','bmp','png');
        if(isset($name,$description,$platform,$genre,$price,$sold,$stock))
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
        }
        if(strlen($s_name)<=50 && strlen($s_description)<=10000 && strlen($s_platform)<=20 && strlen($s_genre)<=30 && strlen($s_price)<=11 && strlen($s_sold)<=11 && strlen($s_stock)<=11 && strlen($s_time)<=4)
        {
            array_push($errors,'Byla překročena maximální délka vstupu.');
        }
        if(!empty($f_tmp))
        {
            if(in_array($ext, $allowed) == true) 
            {
                array_push($errors,'Vybraný soubor není obrázek.');
            }
            if(empty($errors))
            {
                $i=0;
                $n_name=$f_name;                          
                while(file_exists('images/'.$f_name))
                {
                    $a=explode('.', $n_name);
                    $b=count($a);
                    $i++;
                    $a[$b-1]=$a[$b-1].'('.$i.')';
                    $f_name=implode('.',$a);
                }
                if(move_uploaded_file($f_tmp, "images/".$f_name))
                {
                    $result=$db1::execute_query("INSERT INTO product(platform_name,genre_name,product_name,description,picture,price,uploaded,sold,in_stock,delivery_time) VALUES(:p_name,:g_name,:name,:desc,:picture,:price,Now(),:sold,:stock,:time)",
                        [":p_name"=>$s_platform,
                         ":g_name"=>$s_genre,
                         ":name"=>$s_name,
                         ":desc"=>$s_description,
                         ":picture"=>$f_name,
                         ":price"=>$s_price,
                         ":sold"=>$s_sold,
                         ":stock"=>$s_stock,
                         ":time"=>$s_time
                        ]);
                    if($result)
                    {
                        array_push($success,'Hra byla úspěšně přidána.');
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
                else
                {
                    array_push($errors,'Při nahrávání souboru došlo k chybě.');
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
        else 
        {
            if(empty($errors))
            {
                $result=$db1::execute_query("INSERT INTO product(platform_name,genre_name,product_name,description,picture,price,uploaded,sold,in_stock,delivery_time) VALUES(:p_name,:g_name,:name,:desc,default,:price,Now(),:sold,:stock,:time)",
                    [":p_name"=>$s_platform,
                     ":g_name"=>$s_genre,
                     ":name"=>$s_name,
                     ":desc"=>$s_description,
                     ":price"=>$s_price,
                     ":sold"=>$s_sold,
                     ":stock"=>$s_stock,
                     ":time"=>$s_time
                    ]);
                if($result)
                {
                    array_push($success,'Hra byla úspěšně přidána.');
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
            else
            {
                $_SESSION['errors']=$errors;
                header("Location:administration.php?adm=".$s_adm.""); 
            }
        }
    }
    if(isset($adm,$mod,$_POST['prod-m-submit'])&&$s_adm=="products.php")
    {
        $errors=[];
        $success=[];
        $name=$_POST['prod-m-name'];
        $description=$_POST['prod-m-description'];
        $platform=$_POST['prod-m-platform'];
        $genre=$_POST['prod-m-genre'];
        $price=$_POST['prod-m-price'];
        $sold=$_POST['prod-m-sold'];
        $stock=$_POST['prod-m-stock'];
        $time=$_POST['prod-m-time'];
        $f_name=$_FILES['prod-m-image']['name'];
        $f_size=$_FILES['prod-m-image']['size'];
        $f_type=$_FILES['prod-m-image']['type'];
        $f_tmp=$_FILES['prod-m-image']['tmp_name'];
        $s_name=strip_tags($name);
        $s_description=strip_tags($description);
        $s_platform=strip_tags($platform);
        $s_genre=strip_tags($genre);
        $s_price=strip_tags($price);
        $s_sold=strip_tags($sold);
        $s_stock=strip_tags($stock);
        $s_time=strip_tags($time);
        $explode = explode('.', $f_name);
        $ext = end($explode);
        $allowed = array('jpg','jpeg','gif','bmp','png');
        if(isset($name,$description,$platform,$genre,$price,$sold,$stock))
        {
            array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
        }
        if(strlen($s_name)<=50 && strlen($s_description)<=10000 && strlen($s_platform)<=20 && strlen($s_genre)<=30 && strlen($s_price)<=11 && strlen($s_sold)<=11 && strlen($s_stock)<=11 && strlen($s_time)<=4)
        {
            array_push($errors,'Byla překročena maximální délka vstupu.');
        }
        if(!empty($f_tmp))
        {
            if(in_array($ext, $allowed) == true) 
            {
                array_push($errors,'Vybraný soubor není obrázek.');
            }
            if(empty($errors))
            {
                if(file_exists('images/'.$result0['picture']))
                {
                    unlink("images/".$result0['picture']);
                }
                $i=0;
                $n_name=$f_name;                          
                while(file_exists('images/'.$f_name))
                {
                    $a=explode('.', $n_name);
                    $i++;
                    $a[0]=$a[0].'('.$i.')';
                    $f_name=implode('.',$a);
                }
                if(move_uploaded_file($f_tmp, "images/".$f_name))
                {
                    $result=$db1::execute_query("UPDATE product SET platform_name=:p_name,genre_name=:g_name,product_name=:name,description=:desc,picture=:picture,price=:price,sold=:sold,in_stock=:stock,delivery_time=:time WHERE product_id=:id",
                        [":p_name"=>$s_platform,
                         ":g_name"=>$s_genre,
                         ":name"=>$s_name,
                         ":desc"=>$s_description,
                         ":picture"=>$f_name,
                         ":price"=>$s_price,
                         ":sold"=>$s_sold,
                         ":stock"=>$s_stock,
                         ":time"=>$s_time,
                         ":id"=>$s_mod
                        ]);
                    if($result)
                    {
                        array_push($success,'Hra byla úspěšně upravena.');
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
                else
                {
                    array_push($errors,'Při nahrávání souboru došlo k chybě.');
                    $_SESSION['errors']=$errors;
                    header("Location:administration.php?adm=".$s_adm.""); 
                }
            }
        }
        else 
        {
            if(empty($errors))
            {
                $result=$db1::execute_query("UPDATE product SET platform_name=:p_name,genre_name=:g_name,product_name=:name,description=:desc,price=:price,sold=:sold,in_stock=:stock,delivery_time=:time WHERE product_id=:id",
                    [":p_name"=>$s_platform,
                     ":g_name"=>$s_genre,
                     ":name"=>$s_name,
                     ":desc"=>$s_description,
                     ":price"=>$s_price,
                     ":sold"=>$s_sold,
                     ":stock"=>$s_stock,
                     ":time"=>$s_time,
                     ":id"=>$s_mod
                    ]);
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