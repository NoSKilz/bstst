<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(isset($adm)&&$s_adm=="users.php")
{
    $users=$db1::execute_fetchall('SELECT user_id,user_name,joined,user_email FROM user ORDER BY user_id');
    echo '<table>
          <tr>
              <th>ID</th>
              <th>Uživatelské Jméno</th>
              <th>E-mail Uživatele</th>
              <th>Datum Registrace</th>
              <th>Akce</th>
          </tr>';
    foreach($users as $user)
    {
        echo "<tr>
                  <td>{$user['user_id']}</td>
                  <td>{$user['user_name']}</td>
                  <td>{$user['user_email']}</td>
                  <td>{$user['joined']}</td>
                  <td><a href='administration.php?adm={$s_adm}&delete={$user['user_id']}'>Smazat</a></td>
              </tr>";
    }
    echo '</table>';
}