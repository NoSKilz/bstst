<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
$products=$db1::execute_fetchall("SELECT * FROM product ORDER BY product_id");
$platforms=$db1::execute_fetchall("SELECT platform_name FROM platform");
$genres=$db1::execute_fetchall("SELECT genre_name FROM genre");
if(isset($adm)&& !isset($_GET['modify']) && $s_adm=="products.php")
{
    echo "<div id='scroll'>
          <form method='post' action='administration.php?adm={$s_adm}' enctype='multipart/form-data'>
          <table>";
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
                    foreach ($platforms as $platform) 
                    {
                        echo "<option value='{$platform['platform_name']}'>{$platform['platform_name']}</option>";
                    }
    echo'          </select>
              </td>
              <td><select name="prod-genre" requiered>
                    <option value="Vyberte žánr" disabled selected>Vyberte žánr</option>';
                    foreach ($genres as $genre) 
                    {
                        echo "<option value='{$genre['genre_name']}'>{$genre['genre_name']}</option>";
                    }
    echo'          </select>
              </td>
              <td><input type="text" name="prod-price" id="prod-price" placeholder="Cena" maxlength="11" minlength="1" required/></td>
              <td><input type="text" name="prod-sold" id="prod-sold" placeholder="Prodáno" maxlength="11" minlength="1" required/></td>
              <td><input type="text" name="prod-stock" id="prod-stock" placeholder="Na skladě" maxlength="11" minlength="1" required/></td>
              <td><input type="text" name="prod-time" id="prod-time" placeholder="Doba dodání (v dnech)" maxlength="4" minlength="1" required/></td>
              <td><input type="submit" name="prod-submit" value="Přidat hru" id="prod-submit"/></td>
          </tr>';
    foreach ($products as $product)
    {
        $description = substr($product['description'],0,30);
        echo "<tr>
                  <td>{$product['product_id']}</td>
                  <td>{$product['product_name']}</td>
                  <td>{$description}</td>
                  <td>{$product['picture']}</td>
                  <td>{$product['platform_name']}</td>
                  <td>{$product['genre_name']}</td>
                  <td>{$product['price']} Kč</td>
                  <td>{$product['sold']}</td>
                  <td>{$product['in_stock']}</td>
                  <td>{$product['delivery_time']}</td>
                  <td>
                      <a href='administration.php?adm={$s_adm}&delete={$product['product_id']}'>Smazat</a>
                      </br>
                      <a href='administration.php?adm={$s_adm}&modify={$product['product_id']}'>Upravit</a>
                  </td>
              </tr>";
    }
    echo '</table>
          </form>
          </div>';
}
elseif(isset($adm,$_GET['modify']) && $s_adm=="products.php") 
{
    $mod=$_GET['modify'];
    $s_mod=strip_tags($mod);
    $result=$db1::execute_query('SELECT * FROM product WHERE product_id = :id',[':id' => $s_mod]);
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    echo "<div id='scroll'>
          <form method='post' action='administration.php?adm={$s_adm}&modify={$s_mod}' enctype='multipart/form-data'>
          <table>";
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
                    foreach ($platforms as $platform) 
                    {
                        if($result0['platform_name']==$platform['platform_name'])
                        {
                            echo "<option value='{$platform['platform_name']}' selected>{$platform['platform_name']}</option>";
                        }
                        else
                        {
                            echo "<option value='{$platform['platform_name']}'>{$platform['platform_name']}</option>";
                        }
                    }
    echo'          </select>
              </td>
              <td><select name="prod-m-genre" requiered>';
                    foreach ($genres as $genre) 
                    {
                        if($result0['genre_name']==$genre['genre_name'])
                        {
                            echo "<option value='{$genre['genre_name']}' selected>{$genre['genre_name']}</option>";
                        }
                        {
                            echo "<option value='{$genre['genre_name']}'>{$genre['genre_name']}</option>";
                        }
                    }
    echo"</select>
              </td>
              <td><input type='text' name='prod-m-price' id='prod-m-price' placeholder='Cena' maxlength='11' minlength='1' value='{$result0['price']}' required/></td>
              <td><input type='text' name='prod-m-sold' id='prod-m-sold' placeholder='Prodáno' maxlength='11' minlength='1' value='{$result0['sold']}' required/></td>
              <td><input type='text' name='prod-m-stock' id='prod-m-stock' placeholder='Na skladě' maxlength='11' minlength='1' value='{$result0['in_stock']}' required/></td>
              <td><input type='text' name='prod-m-time' id='prod-m-time' placeholder='Doba dodání (v dnech)' maxlength='4' minlength='1' value='{$result0['delivery_time']}' required/></td>
              <td><input type='submit' name='prod-m-submit' value='Upravit hru' id='prod-m-submit'/></td>
          </tr>";
    foreach ($db->query($sql0) as $row)
    {
        $description = substr($product['description'],0,30);
        echo "<tr>
                  <td>{$product['product_id']}</td>
                  <td>{$product['product_name']}</td>
                  <td>{$description}</td>
                  <td>{$product['picture']}</td>
                  <td>{$product['platform_name']}</td>
                  <td>{$product['genre_name']}</td>
                  <td>{$product['price']} Kč</td>
                  <td>{$product['sold']}</td>
                  <td>{$product['in_stock']}</td>
                  <td>{$product['delivery_time']}</td>
                  <td>
                      <a href='administration.php?adm={$s_adm}&delete={$product['product_id']}'>Smazat</a>
                      </br>
                      <a href='administration.php?adm={$s_adm}&modify={$product['product_id']}'>Upravit</a>
                  </td>
              </tr>";
    }
    echo '</table>
          </form>
          </div>';
}