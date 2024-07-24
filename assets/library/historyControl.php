<?php
function check_total_row_affected($conn)
{
    $rows = mysqli_affected_rows($conn);
    return $rows;
} //returns number of rows that has been affected on the particular connection 

function run_my_basic_query($query)
{
    try {
        $conn = connectdb();
        $req = mysqli_query($conn, $query);
        if ($req) {
            //check rows affected
            return check_total_row_affected($conn); // checking how many rows has been affected
        } else if (!$req) {
            echo mysqli_errore($conn);
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
} //run query global function.

function maintain_history_table($query, $status)
{
    if($status==true){
        $status=1;
    }
    else if($status==false){
        $status=0;
    }else{
        $status=0;
    }
    
    $id = get_primary_id("history_table");
    $query = modify_my_query($query);
    // echo $query . "<br>";
    $executed_by = give_executed_by();
    $history_query = "INSERT INTO `history_table`(id, `querys`,`executed_by`, `executed`,`remarks`) VALUES ('$id','$query','$executed_by',$status,'');";
    // echo $history_query;
    //now executing query
    $returned_response = run_my_basic_query($history_query);
    // echo "run basic query:".$returned_response;
    if ($returned_response > 0) {
        //success code
        // echo "success";
        return 1;
    } else if ($returned_response == 0) {
        //failure code
        // echo "failure";
        return 0;
    }
} // history table exist of all the query that has been executed in admin dashboard


function modify_my_query($query)
{
    try {
        $data = str_replace("'", "''", "$query");
        return $data;
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
} //function to make query insertable in table. 

function give_executed_by(){
    session_start();
    if(isset($_SESSION['email'])){
        return $_SESSION['email'];
    }else{
        return 'session email not set';
    }
}

?>