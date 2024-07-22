<?php
function print_My_Invoice($get_ref_id){
        $html = '';
        $html .='';
    $CheckoutQry = "SELECT dpd.`id`, dpd.`full_name`,p.`product_name`,c.`category_name`,ch.`quantity`,ch.`rate`,ch.`discount`,ch.`total`, dpd.`province`, dpd.`district`, dpd.`municipality`, dpd.`tole`, dpd.`phone`, dpd.`cart_id`, dpd.`payment_mode`, dpd.`payment_status`, dpd.`delivery_status`, dpd.`deliverd_by`, dpd.`deliverd_on`, dpd.`reference_no` FROM `delivery_payment_details` dpd
    INNER JOIN checkouts ch on dpd.id=ch.dpd_id
    INNER JOIN productvariant pv on pv.id = ch.product_v_id
    INNER JOIN products p on p.id = pv.product_id
    INNER JOIN category c on c.category_id = p.category_id
    WHERE `reference_no`='$get_ref_id';";
    $conn = connectdb();
    $req = mysqli_query($conn, $CheckoutQry) or die(mysqli_error($conn));
    $req2 = mysqli_query($conn, $CheckoutQry) or die(mysqli_error($conn));
    $i = 1;
    $client_name = '';
    $phone = '';
    $address = '';
    $status = '';
    $gtotal = "";
    $Vat = "";
    $row = mysqli_num_rows($req);
    $row2 = mysqli_num_rows($req2);

    if ($row > 0) {
	    while ($data = mysqli_fetch_assoc($req)) {
		    $gtotal = $data['quantity'] * $data['rate'] - $data['discount'];
		    $Vat = (($gtotal / 100) * 13);
		    $client_name = $data['full_name'];
		    $phone = $data['phone'];
		    $address = $data['province'] . ", " . $data['district'] . ", " . $data['municipality'] . ", " . $data['tole'];
		    $status = trim($data['payment_status']);
	    }
	    
        $html .='<div style="font-size:1rem">';
        $html .='<div style="margin-top:5px;padding-top:5px;">Dear '.$client_name.',</div>';
        $html .='<div>Your order is confirmed. Thank you for purchasing products from our store. Your Purchase Details are as follows:</div>';
        $html .='';
        $payment_part='';
        $table_header_part='';
        $table_body_part='';
        $table_footer_part='';
        $coupon_part='';
        $vat_part='';
        $total_part='';
                                $payment_part .='<div><span class="me-1 fw-bold">Payment Status:</span><strong>';
								if($status=="PAID"){
                                $payment_part .='<span style="background:#71f171;padding: 2px;border-radius: 2px;">'.$status.'</span>';
								}else{
                                $payment_part .='<span style="background:#ffdf5a;padding: 2px;border-radius: 2px;">'.$status.'</span>';
								}
								$payment_part .='</strong></div>';
								$table_header_part.='<div>
							<table class="table" border="1" style="border-collapse: collapse;margin:20px 0px;font-size:.8rem;width:90%;">
								<thead>
									<tr>
										<th>S.N</th>
										<th>Category</th>
										<th>Name</th>
										<th>Quantity</th>
										<th>Rate</th>
										<th>Discount</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>';
		$j = 1;
	    $total = 0;
	    $discTotal = 0;
	    $vatAmt = 0;
        
	    while ($saman = mysqli_fetch_assoc($req2)) {
		    $productAmt = ($saman['quantity'] * $saman['rate']) - $saman['discount'];
		    $discTotal = $discTotal + $saman['discount'];
		    $total = $total + $productAmt;
		    // echo $total; 
		    $amt = $saman['quantity'] * $saman['rate'] - $saman['discount'];
		    $table_body_part.='<tr>';
			$table_body_part.='<td>'.$j.'</td>';
			$table_body_part.='<td>'.$saman['category_name'].'</td>';
			$table_body_part.='<td style="text-align: left;padding-left:5px;">'.$saman['product_name'].'</td>';
			$table_body_part.='<td style="text-align: center;">'.$saman['quantity'].'</td>';
			$table_body_part.='<td style="text-align: right;">'.$saman['rate'].'</td>';
			$table_body_part.='<td style="text-align: right;">'.$saman['discount'].'</td>';
			$table_body_part.='<td style="text-align: right;">'.$amt.'</td>';
			$table_body_part.='</tr>';
             $j++;
	    }
	    $has_coupon_code = get_coupon_code($get_ref_id); //echo "<br>Has Coupon Code :".$has_coupon_code;
	    $total_amt_after_discount=$total; //echo "<br> Coupon Discount applicable amount : ".$total_amt_after_discount;
        if($has_coupon_code){
        // echo "<br>Has Coupon Code :".$has_coupon_code;
        $coupon_value_type=coupon_value_type($has_coupon_code);
        // echo "<br>Coupon Value Type : ".$coupon_value_type."<br>";
        $coupon_value=coupon_value($has_coupon_code);
        $coupon_part.='<tr style="border: 0;"><td style="text-align:right;padding-right:15px;" colspan="6"> <strong> Coupon Discount ';
        $display='';
        if($coupon_value_type=='percentage'){
            $display=$coupon_value."%"; //echo $display;
            $coupon_value = calculate_percentage_discount($total_amt_after_discount,$coupon_value);
        }else{
            $display="Rs.".$coupon_value; //echo $display;
        }
            $coupon_part.= $display.'</strong></td><td style="text-align: right;"><strong>'.$coupon_value;
        $total = $total_amt_after_discount-$coupon_value; //echo "Total after Coupon Discount : ".$total;
        }
        $coupon_part.='</strong></td>	</tr>';
        $vat_part.='<tr style="border: 0;"><td style="text-align:right;padding-right:15px;" colspan="6"><strong>Vat(13%)</strong></td>';
        $vatAmt = $total * 0.13; $vatAmt=round($vatAmt);
        $vat_part.='<td style="text-align: right;"><strong>'.$vatAmt.'</strong></td></tr>';
        $total_part .= '<tr style="border: 0;"><td style="text-align:right;padding-right:15px;" colspan="6"><span><strong>Total: Rs.</strong></span></td>';
        $gTotal = $vatAmt + $total;
        $total_part .= '<td style="text-align: right;"><span><strong>'. $gTotal.'</strong></span></td></tr>';
	     } 
	$table_footer_part.='</tbody></table></div>';
	$html .=$payment_part;
	$address = ucwords($address);
	$html .='<div>Contact No. <strong>'.$phone.'</strong><br> Delivery address : '.$address.'</div>';
    $html .=$table_header_part;
    $html .=$table_body_part;
    $html .=$coupon_part;
    $html .=$vat_part;
    $html .=$total_part;
	$html .=$table_footer_part;
	$html .='<div><strong>Delinepal Pvt. Ltd</strong></div><div><small>Teku, Kathmandu</small></div>';
    $html .='<div><img src="https://kantipurfeed.com/logo.png" alt="logo" style="width:15%;border-bottom:2px solid black;padding-bottom:2px;"></div>';
     
	$html .='<br><div>Order Reference Code: <strong>'.$get_ref_id.'</strong></div> <div style="margin:10px 0px;">You can check your order here <a style="background: #0498be;padding: 8px;color: white;border-radius: 4px;" href="https://kantipurfeed.com/cartOut.php?refID='.$get_ref_id.'">Check</a></div>';
    $html .='</div>';
        //echo "<textarea>".$html."</textarea>"; 
       
	return $html;
	}

?>