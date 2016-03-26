# Prakiraan-Cuaca-API
cURL website BMKG and return JSON
<h3>Install:</h3>
<pre>&lt;?php

    // include cuaca.php
    require("cuaca.php");
    
    // call function cuaca
    $cuaca = cuaca(); // return array print_r($cuaca);
    
    // JSON
    header('Content-Type: application/json');
    
    // mengijinkan semua host/domain/ip untuk menggunakan data JSON ini bila menggunakan AJAX
    // atau rubah tanda * menjadi domain yg di tentukan
    header('Access-Control-Allow-Origin: *');
    
    // convert array to JSON
    echo json_encode($cuaca, JSON_PRETTY_PRINT);
    
?&gt;</pre>
<a href="http://ibacor.com/api/prakiraan-cuaca" target="_BLANK"><h2>DEMO</h2></a>
