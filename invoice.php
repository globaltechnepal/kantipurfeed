<?php
    if(isset($_GET["refID"])){
	$get_ref_id = $_GET["refID"];//  echo "This is ref code : ".$get_ref_id;
	printInvoice($get_ref_id);
    }else{
        echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4 row-cols-xxl-6 input-group  p-2 mb-3">
  <span class="input-group-text fw-bold col col-sm-1 col-md-5 ms-2" id="basic-addon1" style="background:wheat">Refrence Code : &nbsp;
  <input type="text" class="form-control w-100" style="background:white" id="refID_submit"></span>
  <button type="button" class="btn btn-danger col col-md-2 mt-2 ms-2" id="subBtn">Submit</button>
</div><div class="text-white">Please check your email for refrence code.</div>';
    }
    function printInvoice($get_ref_id){
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
		    $address = $data['province'] . "," . $data['district'] . ", <br>" . $data['municipality'] . "," . $data['tole'];
		    $status = trim($data['payment_status']);
	    } ?>
	<div id="content" class="text-center">
		<div class="m-3">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 body-main" style="width: 100%;">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-12 text-center">
								<h4><strong>DELI NEPAL Pvt. Ltd</strong></h4>
								<h5><small>Teku, Kathmandu</small></h5>
							</div>
						</div>
						<br />
						<div class="row">
							<div class="col-md-4 text-start">
								<span><strong><i class="bi bi-person-check-fill"></i>
										<?php echo $client_name; ?>
									</strong></span><br>
								<span><strong><i class="bi bi-geo-alt-fill"></i>
										<?php echo $address; ?>
									</strong></span><br>
								<span><strong><i class="bi bi-telephone-fill"></i>
										<?php echo $phone; ?>
									</strong></span><br>
							</div>
							<div class="col-md-4 text-center">
								<span class="h5 text-bold">INVOICE</span>
							</div>
							<div class="col-md-4 text-end">
								<span><span class="fw-bold">RefID:</span>
									<?php echo $get_ref_id; ?>
								</span><br>
								<span><span class="fw-bold">Creation Date: </span>
									<?php echo give_invoice_create_date($get_ref_id); ?>
								</span><br>
								<span><span class="me-1 fw-bold">Status:</span>
								<?php
								if($status=="PAID"){
								echo '<span class="badge bg-success text-black fw-bold">'.$status.' </span>';
								}else{
								echo '<span class="badge bg-warning text-black fw-bold">'.$status.' </span>';
								}
								?>
								</span><br>
							</div>
						</div>
						<br/>
						<div class="table-responsive">
							<table class="table" style-"font-size:1px">
								<thead>
									<tr>
										<th>
											<h6>S.N</h6>
										</th>
										<th>
											<h6>Category</h6>
										</th>
										<th>
											<h6>Name</h6>
										</th>
										<th>
											<h6>Quantity</h6>
										</th>
										<th>
											<h6>
												Rate
											</h6>
										</th>
										<th>
											<h6>
												Discount
											</h6>
										</th>
										<th>
											<h6>Amount</h6>
										</th>
									</tr>
								</thead>
								<tbody>
									<?php $j = 1;
	    $total = 0;
	    $discTotal = 0;
	    $vatAmt = 0;
        
	    while ($saman = mysqli_fetch_assoc($req2)) {
		    $productAmt = ($saman['quantity'] * $saman['rate']) - $saman['discount'];
		    $discTotal = $discTotal + $saman['discount'];
		    $total = $total + $productAmt;
		    // echo $total; 
                                    ?>
									<tr>
										<td>
											<strong>
												<?php echo $j; ?>
											</strong>
										</td>
										<td>
											<strong>
												<?php echo $saman['category_name']; ?>
											</strong>
										</td>
										<td class="text-start"><strong>
												<?php echo $saman['product_name']; ?>
											</strong>
										</td>
										<td><strong>
												<?php echo $saman['quantity']; ?>
											</strong>
										</td>
										<td><strong>
												<?php echo $saman['rate']; ?>
											</strong>
										</td>
										<td><strong>
												<?php echo $saman['discount']; ?>
											</strong>
										</td>
										<td><strong>
												<?php echo $saman['quantity'] * $saman['rate'] - $saman['discount']; ?>
											</strong></td>
									</tr>
									<?php $j++;
	    } ?> 
	    <?php
	    $has_coupon_code = get_coupon_code($get_ref_id); //echo "<br>Has Coupon Code :".$has_coupon_code;
	    $total_amt_after_discount=$total; //echo "<br> Coupon Discount applicable amount : ".$total_amt_after_discount;
        if($has_coupon_code){
        // echo "<br>Has Coupon Code :".$has_coupon_code;
        $coupon_value_type=coupon_value_type($has_coupon_code);
        // echo "<br>Coupon Value Type : ".$coupon_value_type."<br>";
        $coupon_value=coupon_value($has_coupon_code);
        echo '<tr><td class="text-end" colspan="6"> <strong> Coupon Discount ';
        if($coupon_value_type=='percentage'){
            // echo "<h1>".$coupon_value."</h1>";
            $display=$coupon_value."%"; echo $display;
            $coupon_value = calculate_percentage_discount($total_amt_after_discount,$coupon_value); 
            // echo "<br>coupon Value : ".$coupon_value;
        }else{
            $display="Rs.".$coupon_value; echo $display;
        }
            echo "</strong></td><td><strong>".$coupon_value;
        $total = $total_amt_after_discount-$coupon_value; //echo "Total after Coupon Discount : ".$total;
        }
	    ?>
							</strong></td>	</tr>	<tr>
										<td class="text-end" colspan="6"><strong>Vat(13%)</strong></td>
										<td><strong>
												<?php $vatAmt = $total * 0.13; $vatAmt=round($vatAmt);
	    echo $vatAmt; ?>
											</strong></td>
									</tr>
									<tr>
										<td class="text-end" colspan="6">
											<span><strong>Total: Rs.</strong></span>
										</td>
										<td class="text-left">
											<span><strong>
											    <!--<i class="fas fa-rupee-sign" area-hidden="true"></i>-->
													<?php $gTotal = $vatAmt + $total;
	    echo $gTotal; ?>
												</strong></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div>
							<div class="col-md-12">
								<p class="mt-2">
								    <strong>Signature</strong>
								<button type="button"class="ms-5 btn btn-primary" style="position:absolute;right:0;" id="disapper_it" target="_blank" onclick="window.open('https://delinepal.com/invoice_print.php?refID=<?php echo $get_ref_id;?>', '_blank')">Print</button>
								</p>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<?php } 
	?>
	
	<button type="button" id="print_btn" onclick="printPage()" class="ms-5 btn btn-primary" target="_blank">Print</button>
	<?php
	}
?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

	<script>
			$("#print_btn").css("display", "none");
		function printPage() {
			window.print();
		}
		
		
 $("#subBtn").click(function(){
     var refID_submit = $("#refID_submit").val();
     if(refID_submit==""){
         alert("Field is empty !!");
     }else{
     $.ajax({
          url: 'assets/library/library.php',
           type: 'POST',
           data: {check_cartOut:refID_submit},
           datatype: 'JSON',
           success: function (data) {
               console.log(data);
           var da = JSON.parse(data);
               console.log(da.status_code);
            if (da.status_code == 200) {
                var refCode=da.ref_code;
                console.log(refCode);
             window.location.href='https://kantipurfeed.com/cartOut.php?refID='+refCode;
            }else{
                alert('Reference Code Didnot Match.');
             window.location.href='https://kantipurfeed.com/cartOut.php';
            }
           }
     });
     }
 });
	</script>
