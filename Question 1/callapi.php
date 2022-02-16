<?php

try
{
    $curl = curl_init();

    $postData = array(
        'APISECRET' => '6d5W6Hab-3fg3-414a-a192-be5Vwam11bf6'
    );

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://statusforever.gharkamart.in/EClasses/apiAllCategoryList.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POSTFIELDS => $postData,
        
    ));

    $response = curl_exec($curl);
    
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        echo $response;
    }
}
catch(Exception $ex)
{
    echo $ex->getMessage();
}
