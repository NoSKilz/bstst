<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($_GET['order'])&&$s_adm=="orders.php")
{
    $orders=$db1::execute_fetchall('SELECT * from goods_order');
    echo '<div id="scroll"><table>
              <tbody>
                  <tr>
                      <th>ID objednávky</th>
                      <th>ID uživatele</th>
                      <th>Jméno</th>
                      <th>Příjmení</th>
                      <th>Telefon</th>
                      <th>Ulice</th>
                      <th>Město</th>
                      <th>PSC</th>
                      <th>Celková cena</th>
                      <th>Doručeno</th>
                      <th>Akce</th>
                  </tr>';
    foreach($orders as $order)
    {
        echo "<tr>
                  <td>{$order['order_id']}</td>
                  <td>{$order['user_id']}</td>
                  <td>{$order['first_name']}</td>
                  <td>{$order['last_name']}</td>
                  <td>{$order['phone']}</td>
                  <td>{$order['street']}</td>
                  <td>{$order['city']}</td>
                  <td>{$order['psc']}</td>
                  <td>{$order['price']}</td>";
                  if($order['delivered']==0)
                  {
                      echo '<td>Nedoručeno</td>';
                  }
                  else
                  {
                      echo '<td>Doručeno</td>';
                  }
            echo "<td><a href='administration.php?adm={$s_adm}&order={$order['order_id']}' style='border-bottom:1px solid #191919;'>Detaily objednávky</a>
                      </br>
                      <a href='administration.php?adm={$s_adm}&delete={$order['order_id']}'>Smazat</a></td>
              </tr>";
    }
        echo '</tbody>
    </table></div>';
}
if(isset($_GET['order'],$adm)&&$s_adm=="orders.php")
{
    $order=$_GET['order'];
    $s_order=strip_tags($order);
    $games=$db1::execute_fetchall("SELECT p.product_name,o.count FROM order_content o INNER JOIN product p using(product_id) WHERE o.order_id=:id",[":id"=>$s_order]);
    echo '<table>
              <tbody>
                  <tr>
                      <th>Název hry</th>
                      <th>Počet kusů</th>
                  </tr>';
    foreach($games as $game)
    {
        echo "<tr>
                  <td>{$game['product_name']}</td>
                  <td>{$game['count']}</td>
              </tr>";
    }
    echo '</tbody>
    </table>';
}