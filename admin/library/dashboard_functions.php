<?php

// deliver module
// global_veriable_for Dashboard delivery section
$order_processing='';
$order_dispatched='';
$order_delivered='';
//calculations for order processing
$total_sales_count = '';
$order_processing_percentage='';
$order_dispatched_percentage='';
$order_delivered_percentage='';
// global_veriable_for Dashboard
function get_delivery_details(){
    $sql = "SELECT DISTINCT delivery_status, count(`delivery_status`) as counting FROM `delivery_payment_details` WHERE `delivery_status`='processing' UNION
SELECT DISTINCT delivery_status, count(`delivery_status`) as counting FROM `delivery_payment_details` WHERE `delivery_status`='dispatched' UNION
SELECT DISTINCT delivery_status, count(`delivery_status`) as counting FROM `delivery_payment_details` WHERE `delivery_status`='delivered';";
$list = get_table_data($sql);
// var_dump($list);
            global $order_processing;
            global $order_dispatched;
            global $order_delivered;
foreach ($list as $data){
    $case_is = strtolower($data['delivery_status']);
    // $value_is = $data['counting'];
    // echo $case_is."and value :".$value_is."<hr>";
    switch($case_is){
        case 'processing':
            $order_processing =$data['counting'];
            // echo "<br>Processing :".$data['counting'];
            break;
        case 'dispatched':
            // echo "<br>dispatched :".$data['counting'];
            $order_dispatched=$data['counting'];
            break;
        case 'delivered':
            $order_delivered = $data['counting'];
            // echo "<br>delivered :".$data['counting'];
            break;
    }
}
global $total_sales_count;
global $order_processing_percentage;
global $order_dispatched_percentage;
global $order_delivered_percentage;
$total_sales_count = $order_processing+$order_dispatched+$order_delivered; //echo "Total Saled ".$total_sales_count;
$order_processing_percentage=round(($order_processing/$total_sales_count)*100,2);  //echo '<br>'.$order_processing_percentage;
$order_dispatched_percentage=round(($order_dispatched/$total_sales_count)*100,2); //echo '<br>'.$order_dispatched_percentage;
$order_delivered_percentage=round(($order_delivered/$total_sales_count)*100,2); //echo '<br>'.$order_delivered_percentage;
}
// get_delivery_details();
// deliver module

//for earnings and transaction
function earning_rec($from,$to){
    $sql = "SELECT sum(`invoiceRecord`.`delivery_fee`+`invoiceRecord`.`amt_receivable`) as revenue FROM `invoiceRecord` 
INNER JOIN `delivery_payment_details` dpd on `invoiceRecord`.`refID`=dpd.reference_no
WHERE dpd.payment_status='paid' AND `invoiceRecord`.`create_date` BETWEEN '$from' AND '$to';";
// echo $sql;
$total_revenue = get_table_data($sql);
$revenue = '';
foreach($total_revenue as $rev){
    $revenue = $rev['revenue'];
}
return $revenue;
}
// echo date("H").":Hour<br>";
// echo date("i").":Minute<br>";
// echo date("s")."seconds<br>";
$current_time = date("H").':'.date("i").':'.date("s"); //echo "Time : ".$current_time;
$this_year = date("Y");
$this_month = date("m");
$this_day = date("j");
$this_day = $this_day;
$current_day_time = $this_day.' '.$current_time;
$today_earning=round(earning_rec($this_year.'-'.$this_month.'-'.$this_day,$this_year.'-'.$this_month.'-'.$current_day_time),0); //echo $today_earning.":today<br>";
$month_earning=round(earning_rec($this_year.'-'.$this_month.'-01',$this_year.'-'.$this_month.'-'.$this_day),0); //echo $month_earning.":month<br>";
$year_earning=round(earning_rec($this_year.'-01-01',$this_year.'-'.$this_month.'-'.$this_day),0); //echo $year_earning.":year<br>";
// echo earning_rec('2023-01-01','2023-12-01');

//for earnings and transaction

// for monthly sales of last 12 month
$month_names=array(0,"January","February","March","April","May","june","July");
$monthly_sales_value = array(0,50,18,29,21,30,49,60);
function monthly_sales_report(){
    global $month_names;
    global $monthly_sales_value;
    $sql = "SELECT DISTINCT MONTH(`modify_date`) as month,COUNT(`id`) as monthly_sales FROM `checkouts` WHERE `modify_date`>now() - INTERVAL 12 month GROUP BY MONTH(`modify_date`);";
    $data = get_table_data($sql);
    foreach($data as $da){
        $month_name = date("F", mktime(0, 0, 0, $da['month'], 10));
        array_push($month_names,$month_name);
        array_push($monthly_sales_value,$da['monthly_sales']);
    }
}
// monthly_sales_report();
// echo "<br>";
// print_r($month_names);
// echo "<br>";
// print_r($monthly_sales_value);
// echo "<br>";
//  echo json_encode($month_names, JSON_NUMERIC_CHECK);
//  echo json_encode($monthly_sales_value, JSON_NUMERIC_CHECK);

// for monthly sales of last 12 month

// for top 5 selling district
$district=array("Kathmandu", "Pokhara", "Dharan", "Gorkha", "Butwal");
$deliveryCount=array(55, 49, 44, 24, 15);
function top_selling_disticts(){
    global $district;
    global $deliveryCount;
    $sql = "SELECT DISTINCT `district`, COUNT(`district`) AS `delivered_count` FROM `delivery_payment_details` WHERE `delivery_status` = 'DELIVERED' GROUP BY `district` ORDER BY `delivered_count` DESC LIMIT 5;";
    $data = get_table_data($sql);
    // var_dump($data);
    foreach($data as $da){
        
        array_push ($district,$da['district']);
        array_push ($deliveryCount,$da['delivered_count']);
        
    }
    
}
// top_selling_disticts();
// for top 5 selling district
?>