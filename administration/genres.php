<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$genres=$db1::execute_fetchall('SELECT genre_id,genre_name FROM genre ORDER BY genre_id');
if(isset($adm)&& !isset($mod)&&$s_adm=="genres.php")
{
    echo "<form method='post' action='administration.php?adm={$s_adm}'>
          <table>";
    echo '<tr>
              <th>ID</th>
              <th>Název kategorie</th>
              <th>Akce</th>
          </tr>
          <tr>
              <td></td>
              <td><input type="text" name="cat-name" id="cat-name" placeholder="Název kategorie" maxlength="30" minlength="1" required/></td>
              <td><input type="submit" name="cat-submit" value="Přidat kategorii" id="cat-submit"/></td>
          </tr>';
    foreach ($genres as $genre)
    {
    echo "<tr>
              <td>{$genre['genre_id']}</td>
              <td>{$genre['genre_name']}</td>
              <td>
                  <a href='administration.php?adm={$s_adm}&delete={$genre['genre_id']}'>Smazat</a>
                  </br>
                  <a href='administration.php?adm={$s_adm}&modify={$genre['genre_id']}'>Upravit</a>
              </td>
          </tr>";
    }
    echo '</table>
          </form>';
}
elseif(isset($adm,$mod)&&$s_adm=="genres.php") 
{
    $result=$db1::execute_query('SELECT genre_name FROM genre WHERE genre_id = :id',[':id' => $s_mod]);
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    echo "<form method='post' action='administration.php?adm={$s_adm}&modify={$s_mod}'>
          <table>";
    echo '<tr>
              <th>ID</th>
              <th>Název kategorie</th>
              <th>Akce</th>
          </tr>';
    echo '<tr>
              <td></td>
              <td><input type="text" name="cat-m-name" id="cat-m-name" placeholder="Upraveý název kategorie" maxlength="30" minlength="1" value="'.$result0['genre_name'].'" required/></td>
              <td><input type="submit" name="cat-m-submit" value="Upravit kategorii" id="cat-m-submit"/></td>
          </tr>';
    foreach ($genres as $genre)
    {
    echo "<tr>
              <td>{$genre['genre_id']}</td>
              <td>{$genre['genre_name']}</td>
              <td>
                  <a href='administration.php?adm={$s_adm}&delete={$genre['genre_id']}'>Smazat</a>
                  </br>
                  <a href='administration.php?adm={$s_adm}&modify={$genre['genre_id']}'>Upravit</a>
              </td>
          </tr>";
    }
    echo '</table>
          </form>';
}