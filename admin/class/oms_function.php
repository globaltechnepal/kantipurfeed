<?php
    session_start();
   include_once 'oms_connect.php';

   class oms_function extends oms_connect
   {

    public function __construct()
    {
        parent::__construct();

    }
    

    public function OMS_EXECUTE($qry) 
    {
        $rs = $this->connection->query($qry);
        if ($rs == false) {
            echo 'Duplicate or Invalid Record. Try Again.';
            return false;
        } else {
            return true;
        }        
    }
    
 
    public function escape_string($val)
    {
        return $this->connection->real_escape_string($val);
    }

    public function RETURN_FIELD($TAB, $DESC, $FIELD, $VAL) {
        
        $CID = "001";
        $RET = NULL;  
        $qry = "SELECT " . $DESC . " AS RET FROM " . $TAB . " WHERE " . $FIELD . "='" . $VAL . "' AND ccode='$CID'"; 

        $rs = $this->connection->query($qry);
        while ($row = $rs->fetch_assoc()) {
            $RET = $row['RET'];
        }
        if (strlen($RET)==0) { $RET = Null; } 
        return $RET;
    } 



   public function OMS_INFO($QID, $P1=NULL, $P2=NULL, $P3=NULL, $P4=NULL, $P5=NULL)
    {        


        $rs = $this->connection->query($QRY);

        while ($row = $rs->fetch_assoc()) {
            $RET = $row['RET'];
        }

	if (strlen($RET)==0) { $RET = 0; } 
        return $RET;
        

   } 

    public function OMS_DATA($QID, $P1=NULL, $P2=NULL, $P3=NULL, $P4=NULL, $P5=NULL)
    {        

    	if ($QID=='PASSWORD_INFO')  { $QRY = "SELECT admin_pass FROM admin WHERE email='$P1'"; } 

        $rs = $this->connection->query($QRY);
        
        if ($rs == false) {
            return false;
        } 
        
        $rows = array();
        
        while ($row = $rs->fetch_assoc()) {
            $rows[] = $row;
        }
        
        return $rows;
   }


}

?>