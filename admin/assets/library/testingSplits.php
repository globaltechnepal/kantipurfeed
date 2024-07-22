
<?php

echo "<br>";
  $data="45#2,33#5,55#9,43#1";
  $data_arr=explode(",",$data);
print_r($data_arr);
echo "<br>";
$count = count($data_arr);
  for($i=0;$i<$count;$i++){
    $detail_arr=explode("#",$data_arr[$i]);
echo "<br>";
    echo $detail_arr[0]." ";
    echo $detail_arr[1];
echo "<br>";
}
  ?>