<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$sql="SELECT * FROM product ORDER BY product_id";
$sql4="SELECT platform_name FROM platform";
$sql3="SELECT genre_name FROM genre";
$adm=$_GET['adm'];
$s_adm=strip_tags($adm);
$mod=$_GET['modify'];
$s_mod=strip_tags($mod);
if(isset($adm,$_POST['prod-submit'])&&$s_adm=="products.php")
{
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
    if(!empty($f_tmp))
    {
        if(isset($name,$description,$platform,$genre,$price,$sold,$stock))
        {
            if(!empty($f_tmp))
            {
                if(in_array($ext, $allowed) == true) 
                {
                    if(strlen($s_name)<=50 && strlen($s_description)<=10000 && strlen($s_platform)<=20 && strlen($s_genre)<=30 && strlen($s_price)<=11 && strlen($s_sold)<=11 && strlen($s_stock)<=11 && strlen($s_time)<=4)
                    {
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
                            $sql="INSERT INTO product(platform_name,genre_name,product_name,description,picture,price,uploaded,sold,in_stock,delivery_time) VALUES(:p_name,:g_name,:name,:desc,:picture,:price,Now(),:sold,:stock,:time)";
                            $result=$db->prepare($sql);
                            $result->execute(array(":p_name"=>$s_platform,
                                                   ":g_name"=>$s_genre,
                                                   ":name"=>$s_name,
                                                   ":desc"=>$s_description,
                                                   ":picture"=>$f_name,
                                                   ":price"=>$s_price,
                                                   ":sold"=>$s_sold,
                                                   ":stock"=>$s_stock,
                                                   ":time"=>$s_time
                                                   ));
                            if($result)
                            {
                                $_SESSION['prod-succes']=true;
                                header("Refresh:0"); 
                            }
                            else
                            {
                                $_SESSION['prod-error']=true;
                                header("Refresh:0"); 
                            }
                        }
                    }
                    else 
                    {
                        $_SESSION['prod-err2']=true;
                        header("Refresh:0");  
                    }
                }
                else
                {
                    $_SESSION['prod-err1']=true;
                    header("Refresh:0");  
                }
            }
            else 
            {
                $_SESSION['prod-err0']=true;
                header("Refresh:0");    
            }
        }
        else 
        {
            $_SESSION['prod-err']=true;
            header("Refresh:0");    
        }
    }
    else
    {
        if(isset($name,$description,$platform,$genre,$price,$sold,$stock))
        {
            if(strlen($s_name)<=50 && strlen($s_description)<=10000 && strlen($s_platform)<=20 && strlen($s_genre)<=30 && strlen($s_price)<=11 && strlen($s_sold)<=11 && strlen($s_stock)<=11 && strlen($s_time)<=4)
            {
                $sql="INSERT INTO product(platform_name,genre_name,product_name,description,picture,price,uploaded,sold,in_stock,delivery_time) VALUES(:p_name,:g_name,:name,:desc,default,:price,Now(),:sold,:stock,:time)";
                $result=$db->prepare($sql);
                $result->execute(array(":p_name"=>$s_platform,
                                       ":g_name"=>$s_genre,
                                       ":name"=>$s_name,
                                       ":desc"=>$s_description,
                                       ":price"=>$s_price,
                                       ":sold"=>$s_sold,
                                       ":stock"=>$s_stock,
                                       ":time"=>$s_time
                                       ));
                if($result)
                {
                    $_SESSION['prod-succes']=true;
                    header("Refresh:0"); 
                }
                else
                {
                    $_SESSION['prod-error']=true;
                    header("Refresh:0"); 
                }
            }
            else 
            {
                $_SESSION['prod-err2']=true;
                header("Refresh:0");  
            }
        }
        else 
        {
            $_SESSION['prod-err']=true;
            header("Refresh:0");    
        }
    }
}
if(isset($_SESSION['prod-error']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Došlo k neznámé chybě, zkuste to později.');</script>";
    unset($_SESSION['prod-error']);
}
if(isset($_SESSION['prod-err']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Musí být vyplněna všechna pole.');</script>";
    unset($_SESSION['prod-err']);
}
if(isset($_SESSION['prod-err0']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Musí být vybrán alespoň jeden soubor.');</script>";
    unset($_SESSION['prod-err0']);
}
if(isset($_SESSION['prod-err1']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Vybraný soubor není obrázek.');</script>";
    unset($_SESSION['prod-err1']);
}
if(isset($_SESSION['prod-err2']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Byla překročena maximální délka vstupu.');</script>";
    unset($_SESSION['prod-err2']);
}
if(isset($_SESSION['prod-err3']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Hra se zadaným jménem již existuje.');</script>";
    unset($_SESSION['prod-err3']);
}
if(isset($_SESSION['prod-succes']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Hra byla úspěšně přidána.');</script>";
    unset($_SESSION['prod-succes']);
}
if(isset($_SESSION['prod-d-succes']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Hra byla úspěšně smazána.');</script>";
    unset($_SESSION['prod-d-succes']);
}
if(isset($_SESSION['prod-m-succes']))
{
    echo "<script type='text/javascript' nonce='".$nonce."'>alert('Hra byla úspěšně upravena.');</script>";
    unset($_SESSION['prod-m-succes']);
}
if(isset($adm,$_GET['delete'])&&$s_adm=="products.php")
{
    $delete=$_GET['delete'];
    $s_delete=strip_tags($delete);
    $sql="SELECT picture FROM product WHERE product_id=:id";
    $result=$db->prepare($sql);
    $result->execute(array(":id"=>$s_delete));
    $file=$result->fetchColumn();
    if(file_exists('images/'.$file))
    {
        unlink("images/".$file);
    }
    $sql0='DELETE FROM product WHERE product_id=:id';
    $result0=$db->prepare($sql0);
    $result0->execute(array(":id"=>$s_delete));
    if($result)
    {
        $_SESSION['prod-d-succes']=true;
        header("Location:administration.php?adm=".$s_adm."");
    }
}
if(isset($adm,$mod,$_POST['prod-m-submit'])&&$s_adm=="products.php")
{
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
    if(!empty($f_tmp))
    {
        if(isset($name,$description,$platform,$genre,$price,$sold,$stock))
        {
            if(!empty($f_tmp))
            {
                if(in_array($ext, $allowed) == true) 
                {
                    if(strlen($s_name)<=50 && strlen($s_description)<=10000 && strlen($s_platform)<=20 && strlen($s_genre)<=30 && strlen($s_price)<=11 && strlen($s_sold)<=11 && strlen($s_stock)<=11 && strlen($s_time)<=4)
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
                            $sql="UPDATE product SET platform_name=:p_name,genre_name=:g_name,product_name=:name,description=:desc,picture=:picture,price=:price,sold=:sold,in_stock=:stock,delivery_time=:time WHERE product_id=:id";
                            $result=$db->prepare($sql);
                            $result->execute(array(":p_name"=>$s_platform,
                                                   ":g_name"=>$s_genre,
                                                   ":name"=>$s_name,
                                                   ":desc"=>$s_description,
                                                   ":picture"=>$f_name,
                                                   ":price"=>$s_price,
                                                   ":sold"=>$s_sold,
                                                   ":stock"=>$s_stock,
                                                   ":time"=>$s_time,
                                                   ":id"=>$s_mod
                                                   ));
                            if($result)
                            {
                                $_SESSION['prod-m-succes']=true;
                                header("Location:administration.php?adm=".$s_adm.""); 
                            }
                            else
                            {
                                $_SESSION['prod-error']=true;
                                header("Location:administration.php?adm=".$s_adm.""); 
                            }
                        }
                    }
                    else 
                    {
                        $_SESSION['prod-err2']=true;
                        header("Location:administration.php?adm=".$s_adm."");  
                    }
                }
                else
                {
                    $_SESSION['prod-err1']=true;
                    header("Location:administration.php?adm=".$s_adm."");  
                }
            }
            else 
            {
                $_SESSION['prod-err0']=true;
                header("Location:administration.php?adm=".$s_adm."");    
            }
        }
        else 
        {
            $_SESSION['prod-err']=true;
            header("Location:administration.php?adm=".$s_adm."");    
        }
    }
    else
    {
        if(isset($name,$description,$platform,$genre,$price,$sold,$stock))
        {
            if(strlen($s_name)<=50 && strlen($s_description)<=10000 && strlen($s_platform)<=20 && strlen($s_genre)<=30 && strlen($s_price)<=11 && strlen($s_sold)<=11 && strlen($s_stock)<=11 && strlen($s_time)<=4)
            {
                $sql="UPDATE product SET platform_name=:p_name,genre_name=:g_name,product_name=:name,description=:desc,price=:price,sold=:sold,in_stock=:stock,delivery_time=:time WHERE product_id=:id";
                $result=$db->prepare($sql);
                $result->execute(array(":p_name"=>$s_platform,
                                       ":g_name"=>$s_genre,
                                       ":name"=>$s_name,
                                       ":desc"=>$s_description,
                                       ":price"=>$s_price,
                                       ":sold"=>$s_sold,
                                       ":stock"=>$s_stock,
                                       ":time"=>$s_time,
                                       ":id"=>$s_mod
                                       ));
                if($result)
                {
                    $_SESSION['prod-m-succes']=true;
                    header("Location:administration.php?adm=".$s_adm.""); 
                }
                else
                {
                    $_SESSION['prod-error']=true;
                    header("Location:administration.php?adm=".$s_adm.""); 
                }
            }
            else 
            {
                $_SESSION['prod-err2']=true;
                header("Location:administration.php?adm=".$s_adm."");  
            }
        }
        else 
        {
            $_SESSION['prod-err']=true;
            header("Location:administration.php?adm=".$s_adm."");    
        }
    }
}
if(isset($adm)&& !isset($_GET['modify']))
{
    echo '<div id="scroll">
          <form method="post" action="administration.php?adm='.$s_adm.'" enctype="multipart/form-data">
          <table>';
    echo '<tr>
              <th>ID</th>
              <th>Jméno hry</th>
              <th>Popis</th>
              <th>Obrázek</th>
              <th>Platforma</th>
              <th>Kategorie</th>
              <th>Cena</th>
              <th>Prodáno</th>
              <th>Na skladě</th>
              <th>Doba dodání  (v dnech)</th>
              <th>Akce</th>
          </tr>';
    echo '<tr>
              <td></td>
              <td><input type="text" name="prod-name" id="prod-name" placeholder="Název hry" maxlength="50" minlength="1" required/></td>
              <td><textarea id="prod-description" name="prod-description" maxlength="10000" minlength="1" placeholder="Popis hry" requiered></textarea></td>
              <td><input type="file" name="prod-image" id="prod-image"/></td>
              <td><select name="prod-platform" requiered>
                    <option value="Vyberte plattformu" disabled selected>Vyberte platformu</option>';
                    foreach ($db->query($sql4) as $row1) 
                    {
                        echo '<option value="'.$row1['platform_name'].'">'.$row1['platform_name'].'</option>';
                    }
    echo'          </select>
              </td>
              <td><select name="prod-genre" requiered>
                    <option value="Vyberte žánr" disabled selected>Vyberte žánr</option>';
                    foreach ($db->query($sql3) as $row0) 
                    {
                        echo '<option value="'.$row0['genre_name'].'">'.$row0['genre_name'].'</option>';
                    }
    echo'          </select>
              </td>
              <td><input type="text" name="prod-price" id="prod-price" placeholder="Cena" maxlength="11" minlength="1" required/></td>
              <td><input type="text" name="prod-sold" id="prod-sold" placeholder="Prodáno" maxlength="11" minlength="1" required/></td>
              <td><input type="text" name="prod-stock" id="prod-stock" placeholder="Na skladě" maxlength="11" minlength="1" required/></td>
              <td><input type="text" name="prod-time" id="prod-time" placeholder="Doba dodání (v dnech)" maxlength="4" minlength="1" required/></td>
              <td><input type="submit" name="prod-submit" value="Přidat hru" id="prod-submit"/></td>
          </tr>';
    foreach ($db->query($sql) as $row)
    {
    echo '<tr>
              <td>'.$row['product_id'].'</td>
              <td>'.$row['product_name'].'</td>
              <td>'.substr($row['description'],0,30).'</td>
              <td>'.$row['picture'].'</td>
              <td>'.$row['platform_name'].'</td>
              <td>'.$row['genre_name'].'</td>
              <td>'.$row['price'].' Kč</td>
              <td>'.$row['sold'].'</td>
              <td>'.$row['in_stock'].'</td>
              <td>'.$row['delivery_time'].'</td>
              <td>
                  <a href="administration.php?adm='.$s_adm.'&delete='.$row['product_id'].'">Smazat</a>
                  </br>
                  <a href="administration.php?adm='.$s_adm.'&modify='.$row['product_id'].'">Upravit</a>
              </td>
          </tr>';
    }
    echo '</table>
          </form>
          </div>';
}
elseif(isset($adm,$mod)) 
{
    $mod=$_GET['modify'];
    $s_mod=strip_tags($mod);
    $sql='SELECT * FROM product WHERE product_id = :id';
    $result=$db->prepare($sql);
    $result->execute(array(':id' => $s_mod));
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    $sql0='SELECT * FROM product ORDER BY product_id';
    echo '<div id="scroll">
          <form method="post" action="administration.php?adm='.$s_adm.'&modify='.$s_mod.'" enctype="multipart/form-data">
          <table>';
    echo '<tr>
              <th>ID</th>
              <th>Jméno hry</th>
              <th>Popis</th>
              <th>Obrázek</th>
              <th>Platforma</th>
              <th>Kategorie</th>
              <th>Cena</th>
              <th>Prodáno</th>
              <th>Na skladě</th>
              <th>Doba dodání  (v dnech)</th>
              <th>Akce</th>
          </tr>';
    echo '<tr>
              <td></td>
              <td><input type="text" name="prod-m-name" id="prod-name" placeholder="Název hry" maxlength="50" minlength="1" value="'.$result0['product_name'].'" required/></td>
              <td><textarea id="prod-m-description" name="prod-m-description" maxlength="10000" minlength="1" placeholder="Popis hry" requiered>'.$result0['description'].'</textarea></td>
              <td><input type="file" name="prod-m-image" id="prod-m-image" placeholder="Vyberte obrázek"/></td>
              <td><select name="prod-m-platform" requiered>';
                    foreach ($db->query($sql4) as $row1) 
                    {
                        if($result0['platform_name']==$row1['platform_name'])
                        {
                            echo '<option value="'.$row1['platform_name'].'" selected>'.$row1['platform_name'].'</option>';
                        }
                        else
                        {
                            echo '<option value="'.$row1['platform_name'].'">'.$row1['platform_name'].'</option>';
                        }
                    }
    echo'          </select>
              </td>
              <td><select name="prod-m-genre" requiered>';
                    foreach ($db->query($sql3) as $row0) 
                    {
                        if($result0['genre_name']==$row0['genre_name'])
                        {
                            echo '<option value="'.$row0['genre_name'].'" selected>'.$row0['genre_name'].'</option>';
                        }
                        {
                            echo '<option value="'.$row0['genre_name'].'">'.$row0['genre_name'].'</option>';
                        }
                    }
    echo'          </select>
              </td>
              <td><input type="text" name="prod-m-price" id="prod-m-price" placeholder="Cena" maxlength="11" minlength="1" value="'.$result0['price'].'" required/></td>
              <td><input type="text" name="prod-m-sold" id="prod-m-sold" placeholder="Prodáno" maxlength="11" minlength="1" value="'.$result0['sold'].'" required/></td>
              <td><input type="text" name="prod-m-stock" id="prod-m-stock" placeholder="Na skladě" maxlength="11" minlength="1" value="'.$result0['in_stock'].'" required/></td>
              <td><input type="text" name="prod-m-time" id="prod-m-time" placeholder="Doba dodání (v dnech)" maxlength="4" minlength="1" value="'.$result0['delivery_time'].'" required/></td>
              <td><input type="submit" name="prod-m-submit" value="Upravit hru" id="prod-m-submit"/></td>
          </tr>';
    foreach ($db->query($sql0) as $row)
    {
    echo '<tr>
              <td>'.$row['product_id'].'</td>
              <td>'.$row['product_name'].'</td>
              <td>'.substr($row['description'],0,30).'</td>
              <td>'.$row['picture'].'</td>
              <td>'.$row['platform_name'].'</td>
              <td>'.$row['genre_name'].'</td>
              <td>'.$row['price'].' Kč</td>
              <td>'.$row['sold'].'</td>
              <td>'.$row['in_stock'].'</td>
              <td>'.$row['delivery_time'].'</td>
              <td>
                  <a href="administration.php?adm='.$s_adm.'&delete='.$row['product_id'].'">Smazat</a>
                  </br>
                  <a href="administration.php?adm='.$s_adm.'&modify='.$row['product_id'].'">Upravit</a>
              </td>
          </tr>';
    }
    echo '</table>
          </form>
          </div>';
}