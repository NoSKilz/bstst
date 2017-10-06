<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($user->loggedin())
{
    $id=$_GET['product'];
    $s_id=strip_tags($id);
    echo "<div id='c-f-container'><form id='comment-form' method='post' action='product.php?product=$s_id'><div>
              <textarea id='com' name='comment' form='comment-form' maxlength='500' minlength='1' placeholder='Text komentáře' requiered></textarea>
              <input type='submit' name='c-submit' value='Odeslat komentář' id='comment-submit'/></div>
          </form>
          <div id='charNum' data-count='500'>Zbývající počet znaků: 500</div></div>";
}
else
{
    echo '<p id="err">Pro přidávání komentářů musíte být příhlášeni.</p>';
}
$id=$_GET['product'];
$s_id=strip_tags($id);
$result=$db1::execute_query('SELECT user_id,comment_text FROM comments WHERE product_id=:id',[':id'=>$s_id]);
echo '<div id="comment-div">';
foreach($result as $row)
{
    $result=$db1::execute_query('SELECT user_name FROM user WHERE user_id= :usid',[':usid' => $row['user_id']]);
    $com_name=$result->fetchColumn();
    echo "<p><b style='color:red;'>$com_name: </b>{$row['comment_text']}</p>";
}
echo '</div>';