<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id=$_GET['product'];
$s_id=strip_tags($id);
if($user->loggedin())
{
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
$result=$db1::execute_fetchall('SELECT c.user_id,c.comment_text,r.user_name FROM comments c INNER JOIN user r ON r.user_id=c.user_id WHERE c.product_id=:id ORDER BY c.uploaded',[':id'=>$s_id]);
echo '<div id="comment-div" style="word-wrap:break-word;overflow=hidden;">';
foreach($result as $row)
{
    echo "<p><b style='color:red;'>{$row['user_name']}: </b>{$row['comment_text']}</p>";
}
echo '</div>';