<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($user->loggedin())
{
    $result=$db1::execute_query('SELECT admin FROM user WHERE user_id = :id',[':id' => $user->getid()]);
    $result0=$result->fetch(PDO::FETCH_ASSOC);
    if((int)$result0['admin']==1)
    {
        echo  "<p>Jste přihlášen jako Admin</p>
              <div class='adm-container'>
                  <a href='administration.php' class='adm'>Vstup do Administrace</a>
              </div>";
              if(strpos($_SERVER['REQUEST_URI'],'?')!=FALSE)
              {
                  echo "<a href='{$_SERVER['REQUEST_URI']}&action=logout' class='logout'>Odhlásit se</a>";
              }
              else
              {
                  echo "<a href='{$_SERVER['REQUEST_URI']}?action=logout' class='logout'>Odhlásit se</a>";
              }
    }
    else
    {
        echo "<p>Jste přihlášen jako {$user->getname()}</p>
              <div class='adm-container'>
                <a href='user_interface.php' class='adm'>Vstup do Uživatelského rozhraní</a>
              </div>";
              if(strpos($_SERVER['REQUEST_URI'],'?')!=FALSE)
              {
                  echo "<a href='{$_SERVER['REQUEST_URI']}&action=logout' class='logout'>Odhlásit se</a>";
              }
              else
              {
                  echo "<a href='{$_SERVER['REQUEST_URI']}?action=logout' class='logout'>Odhlásit se</a>";
              }
    }
}
else
{
    echo "<div id='reglog-modal' style='display: none;'>
            <form id='login' method='post' action='{$_SERVER['REQUEST_URI']}' style='display: none;'>
                <span class='close cursor'>&times;</span>
                <label for='l-username'>
                    Uživatelské jméno
                </label>    
                <input id='l-username' type='text' name='l-username' placeholder='Uživatelské jméno' maxlength='20' minlength='1' autocomplete='off' required/>
                <label for='l-password'>
                    Heslo
                </label>    
                <input id='l-password' type='password' name='l-password' placeholder='Heslo' minlength='4' autocomplete='off' required/>
                <input type='submit' name='l-submit' value='Přihlásit'/>
                <p id='login-p'>Nemáte účet? <span id='login-span'>Zaregistrujte se.</span></p>
            </form> 
            <form id='register' method='post' action='{$_SERVER['REQUEST_URI']}' style='display: none;'>
                <span class='close'>&times;</span>
                <label for='r-username'>
                    Uživatelské jméno
                </label>    
                <input id='r-username' type='text' name='r-username' placeholder='Uživatelské jméno' maxlength='20' minlength='1' autocomplete='off' required/>
                <label for='r-password'>
                    Heslo
                </label>    
                <input id='r-password' type='password' name='password' placeholder='Heslo' minlength='4' autocomplete='off' required/>
                <label for='r-check-password'>
                    Kontrola Hesla
                </label>    
                <input id='r-check-password' type='password' name='check-password' placeholder='Heslo Znovu' minlength='4' autocomplete='off' required/>
                <label for='r-e-mail'>
                    Email
                </label>    
                <input id='r-e-mail' type='email' name='e-mail' placeholder='E-mail' maxlength='40' minlength='1' autocomplete='off' required/>
                <label for='r-check-e-mail'>
                    Kontrola E-mailu
                </label>    
                <input id='r-check-e-mail' type='email' name='check-e-mail' placeholder='E-mail Znovu' maxlength='40' minlength='1' autocomplete='off' required/>
                <input type='submit' name='r-submit' value='Registrovat' class='c_sub_input'/>
                <p id='register-p'>Už máte účet? <span id='register-span'>Přihlásit se.</span></p>
            </form></div>
          <button id='register-button'>
              Registrace
          </button>
          <button id='login-button'>
              Přihlášení
          </button>";
}