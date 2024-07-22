<?php 
include 'library.php';

date_default_timezone_set("asia/kathmandu");

//submit_rating.php
// $connect = new PDO("mysql:host=localhost;dbname=ultima", "root", "");

//   server user name 
//   $servername = 'localhost';
//   $username = 'ultima_client';
//   $password = 'Ultima@2022';
//   $dbname = 'ultima_ultima';
    $connect = new PDO("mysql:host=localhost;dbname=kantipurfeed_delinepal","kantipurfeed_delinepalUser", "%pY9Kby9*k6b");

// $data = array();
// demo 
  // if($connect == true){
  //   echo "Connection established";
  // $sql = "SELECT * from productvariant pv 
  // inner JOIN colors c on pv.color_id=c.id 
  // inner join products p on pv.product_id=p.id
  // where pv.product_id=1;";
  // $query= "SELECT 
  // pv.id as product_id,p.product_name,c.color_name,p.img_path,p.primary_image,pv.available,p.actual_Price 
  // from productvariant pv 
  // inner JOIN colors c on pv.color_id=c.id 
  // inner join products p on pv.product_id=p.id
  // where pv.product_id=1;";
  // 	$result = $connect->query($query, PDO::FETCH_ASSOC);
  // foreach ($result as $row) {
  // 		$data[] = array(
  // 			'product_id' => $row["product_id"],
  // 			'product_name' => $row["product_name"],
  // 			'color_name' => $row["color_name"],
  // 			'img_path' => $row["img_path"],
  // 			'primary_image' => $row["primary_image"],
  // 			'available' => $row["available"],
  // 			'actual_Price' =>$row["actual_Price"]
  // 		);
  //   }
  // 	echo json_encode($data);
    // checking data acquired
      // foreach ($data as $row){
      //     echo "<br>Product ID : ".$row["product_id"]."<br>";
      //     echo "product_name : ".$row["product_name"]."<br>";
      //     echo "color_name : ".$row["color_name"]."<br>";
      //     echo "img_path : ".$row["img_path"]."<br>";
      //     echo "primary_image : ".$row["primary_image"]."<br>";
      //     echo "available : ".$row["available"]."<br>";
      //     echo "actual_Price : ".$row["actual_Price"]."<br>";
      //   }
    // checking data acquired
  // }
// demo end

//ger colors
if(isset($_POST['getColors'])){
  $id = $_POST['getColors'];
  if($id == null || $id == ''){
    $response = array('response'=>'provide some data');
	echo json_encode($response);
  }
  else{
    $data[]=array();
      $query= "SELECT pv.id as pv_id,p.product_name,p.actual_price,p.sell_price,clr.color_name, pvimg.img_path, pvimg.img from productvariant pv
INNER JOIN products p on pv.product_id = p.id
INNER JOIN colors clr on pv.color_id = clr.id
INNER JOIN productvariant_image pvimg on p.id = pvimg.product_varient_id
where p.id=$id;";
// echo $query;
      $result = $connect->query($query, PDO::FETCH_ASSOC);
      foreach ($result as $row) {
      		$data[] = array(
      			'pv_id' => $row["pv_id"],
      			'product_name' => $row["product_name"],
      			'actual_price' =>$row["actual_price"],
      			'sell_price' => $row["sell_price"],
            'color_name' => $row["color_name"],
      			'img_path' => $row["img_path"],
      			'img' => $row["img"]
      		);
        }
      	echo json_encode($data);
    //   	echo "something";
        // $response = array('response'=>'data acquired is id: '.$id);
      	// echo json_encode($response);
    }
}

?>