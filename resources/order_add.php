<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if(!isset($_SESSION['cart']))
{
    $output='';
    header('Location:index.php');
}
else 
{
    $output='<form id="order" method="post" action="order.php">
                <label for="delivery">
                    Způsob dopravy
                </label>    
                <select id="delivery" name="delivery">
                    <option value="Vyberte způsob dopravy" disabled selected>Vyberte způsob dopravy</option>
                    <option value="Česká pošta - balík do ruky" >Česká pošta - balík do ruky</option>
                    <option value="Osobní odběr - Ostrava" >Osobní odběr - Ostrava</option>
                    <option value="Přepravní služba PPL" >Přepravní služba PPL</option>
                </select>
                <label for="payment">
                    Způsob platby
                </label>    
                <select id="payment" name="payment">
                    <option value="Vyberte způsob platby" disabled selected>Vyberte způsob platby</option>
                    <option value="Převod předem">Převod předem</option>
                    <option value="Platba dobírkou(platba hotově řidiči)">Platba dobírkou (platba hotově řidiči)</option>
                </select>
                <label for="f-name">
                    Jméno
                </label>    
                <input type="text" name="f-name" id="f-name" placeholder="Jméno" maxlength="50" minlenght="1" required/>
                <label for="l-name">
                    Příjmení
                </label>    
                <input type="text" name="l-name" id="l-name" placeholder="Příjmení" maxlength="50" minlenght="1" required/>
                <label for="e-mail">
                    Email
                </label>    
                <input type="email" name="e-mail" id="e-mail" placeholder="E-mail" maxlength="50" minlenght="1" required/>
                <label for="phone">
                    Telefon
                </label>    
                <input type="text" name="phone" id="phone" placeholder="Telefon(bez mezer)" maxlength="12" minlenght="1" required/>
                <label for="street">
                    Ulice a číslo popisné
                </label>    
                <input type="text" name="street" id="street" placeholder="Ulice" maxlength="50" minlenght="1" required/>
                <label for="city">
                    Město
                </label>    
                <input type="text" name="city" id="city" placeholder="Město" maxlength="50" minlenght="1" required/>
                <label for="psc">
                    PSČ
                </label>    
                <input type="text" name="psc" id="psc" placeholder="PSČ(bez mezer)" maxlength="6" minlenght="1" required/>
                <label for="info">
                    Dodatečné informace
                </label>    
                <textarea id="info" name="info" form="order" maxlength="500" minlength="1" placeholder="Dodatečné informace"></textarea>
                <div id="charNum" data-count="500">Zbývající počet znaků: 500</div>
                <input type="submit" name="o-submit" value="Odeslat objednávku" id="order-submit"/>
            </form>';    
}
$errors=[];
$success=[];
if(isset($_POST['o-submit']))
{
    if(!isset($_SESSION['cart']))
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    $f_name=$_POST['f-name'];
    $l_name=$_POST['l-name'];
    $mail=$_POST['e-mail'];
    $phone=$_POST['phone'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    $psc=$_POST['psc'];
    $info=$_POST['info'];
    $delivery=$_POST['delivery'];
    $payment=$_POST['payment'];
    $s_f_name=strip_tags($f_name);
    $s_l_name=strip_tags($l_name);
    $s_mail=strip_tags($mail);
    $s_phone=strip_tags($phone);
    $s_street=strip_tags($street);
    $s_city=strip_tags($city);
    $s_psc=strip_tags($psc);
    $s_delivery=strip_tags($delivery);
    $s_payment=strip_tags($payment);
    $s_info=strip_tags($info);
    if(!isset($f_name,$l_name,$mail,$phone,$street,$city,$psc,$delivery,$payment))
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if(empty($f_name)||empty($l_name)||empty($mail)||empty($phone)||empty($street)||empty($city)||empty($psc)||empty($delivery)||empty($payment))
    {
        array_push($errors,'Musí být vyplněna všechna pole.');
    }
    if(strlen($s_f_name)>=50 && strlen($s_l_name)>=50 && strlen($s_mail)>=50 && strlen($s_phone)>=12 && strlen($s_street)>=50 && strlen($s_city)>=50 && strlen($s_psc)>=6 && strlen($s_info)>=500)
    {
        array_push($errors,'Byla překročena maximální délka vstupu.');
    }
    if($s_delivery!='Česká pošta - balík do ruky'&&$s_delivery!='Osobní odběr - Ostrava'&&$s_delivery!='Přepravní služba PPL')
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if($s_payment!='Převod předem'&&$s_payment!='Platba dobírkou(platba hotově řidiči)')
    {
        array_push($errors,'Došlo k neznámé chybě, zkuste to později.');
    }
    if(empty($errors))
    {
        if(isset($info))
        {
            $s_info=strip_tags($info);
        }
        else
        {
            $s_info=NULL;
        }
        if($user->loggedin())
        {
            $result=$db1::execute_query('INSERT INTO goods_order(user_id,price,first_name,last_name,e_mail,phone,street,city,psc,delivery_means,payment_means,delivered,info) VALUES(:userid,:price,:fname,:lname,:email,:phone,:street,:city,:psc,:delivery,:payment,0,:info)',[':userid' => $user->getid(), 
                                   ':price' => $_SESSION['price'],
                                   ':fname' => $s_f_name,
                                   ':lname' => $s_l_name,
                                   ':email' => $s_mail,
                                   ':phone' => $s_phone,
                                   ':street' => $s_street,
                                   ':city' => $s_city,
                                   ':psc' => $s_psc,
                                   ':delivery' => $s_delivery,
                                   ':payment' => $s_payment,
                                   ':info' => $s_info]);
        }
        else
        {
            $result=$db1::execute_query('INSERT INTO goods_order(user_id,price,first_name,last_name,e_mail,phone,street,city,psc,delivery_means,payment_means,delivered,info) VALUES(default,:price,:fname,:lname,:email,:phone,:street,:city,:psc,:delivery,:payment,0,:info)',[':price' => $_SESSION['price'],
                                   ':fname' => $s_f_name,
                                   ':lname' => $s_l_name,
                                   ':email' => $s_mail,
                                   ':phone' => $s_phone,
                                   ':street' => $s_street,
                                   ':city' => $s_city,
                                   ':psc' => $s_psc,
                                   ':delivery' => $s_delivery,
                                   ':payment' => $s_payment,
                                   ':info' => $s_info]);
        }
        foreach($_SESSION['cart'] as $i => $item )
        {
            $result=$db1::execute_query('SELECT product_id FROM product WHERE product_name LIKE :name',[':name' => "%{$_SESSION['cart'][$i]['name']}%"]);
            $result0=$result->fetch(PDO::FETCH_ASSOC);
            $result1=$db->query('SELECT COUNT(order_id) FROM goods_order');
            $result2=$result1->fetchColumn();
            if((int)$result2==0)
            {
                $order_id=1;
            }
            else
            {
                $result3=$db->query('SELECT MAX(order_id) FROM goods_order');
                $result4=$result3->fetchColumn();
                $order_id=(int)$result4;
            }
            $result5=$db1::execute_query('INSERT INTO order_content(order_id,product_id,count) VALUES(:ordid,:prodid,:count)',[':ordid' => $order_id,
                                    ':prodid' => $result0['product_id'],
                                    ':count' => $_SESSION['cart'][$i]['count']]);
            $result6=$db1::execute_query('UPDATE product SET sold=sold+:count,in_stock=in_stock-:count WHERE product_id=:id',[':id' => $result0['product_id'],
                                    ':count' => $_SESSION['cart'][$i]['count']]);
        }
        array_push($success,'Objednávka proběhla úspěšně.');
        $_SESSION['success']=$success;
        unset($_SESSION['cart']);
        header('Location:index.php');
    }
    else 
    {
        $_SESSION['errors']=$errors;
        header('Refresh:0');
    }
}