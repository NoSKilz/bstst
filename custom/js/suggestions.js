/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
document.getElementById('search-input').addEventListener('input',function(){
    var sug_text=this.value;
    if(sug_text!='')
    {
        if(window.XMLHttpRequest)
        {
            xhttp = new XMLHttpRequest();
        }
        else
        {
            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
                if(this.responseText)
                {
                    document.getElementById('suggestions').innerHTML = this.responseText;
                }
                else
                {
                }
            }
        };
        xhttp.open('POST', 'http://localhost/better_shop/resources/suggestions.php', true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send('text='+sug_text);
    }
    else
    {
        document.getElementById('suggestions').innerHTML ='';
    }
});