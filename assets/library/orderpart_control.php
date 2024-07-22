<?php 
include 'library.php';
//display images from folder
//display images from folder
if(isset($_POST['get_images_from_folder'])){
  $path = $_POST['get_images_from_folder'];
  $img_list= display_image_in_folder($path);
  $count = count($img_list);
  $response=array("status_code"=>"500","message"=>"Unknown","path"=>$path,"data"=>$img_list);
  if($count>0){
    $response=array("status_code"=>"200","message"=>"success","path"=>$path,"data"=>$img_list);
  }
  else{
  $response=array("status_code"=>"501","message"=>"failure","path"=>$path,"data"=>$img_list);
  }
  echo json_encode($response);
  // for($i=1;$i<$count;$i++){
  // echo $img_list[$i]."<br>";}
}
  function display_image_in_folder($dir){
    //get current directory
    $working_dir = getcwd();
    // echo $working_dir."<br>";
    //get image directory
    $img_dir = $working_dir."/../../".$dir;
    // echo $img_dir;
    //change current directory to image directory
    chdir($img_dir);
    //using glob() function get images 
    $files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE );
    //again change the directory to working directory
    chdir($working_dir);
    return $files;
  }
//display images from folder
//display images from folder

//extract product details for order part 
//extract product details for order part 

//extract product details for order part 
//extract product details for order part 

?>