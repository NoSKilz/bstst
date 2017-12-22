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
    foreach($orders as $row)
    {
        echo "<tr>
                  <td>{$row['order_id']}</td>
                  <td>{$row['user_id']}</td>
                  <td>{$row['first_name']}</td>
                  <td>{$row['last_name']}</td>
                  <td>{$row['phone']}</td>
                  <td>{$row['street']}</td>
                  <td>{$row['city']}</td>
                  <td>{$row['psc']}</td>
                  <td>{$row['price']}</td>";
                  if($row['delivered']==0)
                  {
                      echo '<td>Nedoručeno</td>';
                  }
                  else
                  {
                      echo '<td>Doručeno</td>';
                  }
            echo "<td><a href='administration.php?adm={$s_adm}&order={$row['order_id']}' style='border-bottom:1px solid #191919;'>Detaily objednávky</a>
                      </br>
                      <a href='administration.php?adm={$s_adm}&delete={$row['order_id']}'>Smazat</a></td>
              </tr>";
    }
        echo '</tbody>
    </table></div>';
}
if(isset($_GET['order'],$adm)&&$s_adm=="orders.php")
{
    $order=$_GET['order'];
    $s_order=strip_tags($order);
    $result=$db1::execute_fetchall("SELECT p.product_name,o.count FROM order_content o INNER JOIN product p using(product_id) WHERE o.order_id=:id",[":id"=>$s_order]);
    echo '<table>
              <tbody>
                  <tr>
                      <th>Název hry</th>
                      <th>Počet kusů</th>
                  </tr>';
    foreach($result as $result1)
    {
        echo "<tr>
                  <td>{$result1['product_name']}</td>
                  <td>{$result1['count']}</td>
              </tr>";
    }
    echo '</tbody>
    </table>';
}