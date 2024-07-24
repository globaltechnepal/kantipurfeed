<?php 
// include 'main/setting.php';

function pay_eSewa(){
    echo "called function eSewa";
    $url = "https://uat.esewa.com.np/epay/main";
    $data =[
        'amt'=> 100,
        'pdc'=> 0,
        'psc'=> 0,
        'txAmt'=> 0,
        'tAmt'=> 100,
        'pid'=>'454',
        'scd'=> 'EPAYTEST',
        'su'=>'https://ultimanepal.com/eSewa/main/success.php?q=su',
        'fu'=>'https://ultimanepal.com/eSewa/main/failed.php?q=fu'
    ];
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
        console.log($response);
}
// pay_eSewa();
?>