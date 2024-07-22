<?php
include '../../assets/library/library.php';
    $vendor_company_name="";
    $vendor_contact="";
    $vendor_address="";
    $order_place_date="";
    $discountPercent ="";
    $v_email = $_GET['ref'];
    $v_id = $_GET['id'];
    $get_invoice_data = "SELECT `user_type`, `vendor_company_name`, vs.`vendor_email`, `vendor_contact`,`discountPercent`, `vendor_address`,`order_place_date` FROM `vendor_users` vs
                        LEFT JOIN `vendor_checkout` vc ON vc.vendor_email = vs.vendor_email
                        WHERE vc.`vendor_email`='$v_email';";
    $datas = get_Table_Data($get_invoice_data);
    foreach($datas as $data){
     $vendor_company_name =$data['vendor_company_name']; 
     $vendor_contact =$data['vendor_contact']; 
     $vendor_address =$data['vendor_address']; 
     $order_place_date =$data['order_place_date']; 
     $discountPercent =$data['discountPercent'];  
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Invoice</title>
</head>
<style>
    .invoiceDecoration{
        border:1px solid black;
    }
</style>
<body>
	<div id="content" class="text-center">
		<div class="m-3">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 body-main invoiceDecoration" style="width: 100%;">
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
									<?php echo $vendor_company_name ?>
									</strong></span><br>
								<span><strong><i class="bi bi-geo-alt-fill"></i>
								<?php echo $vendor_address ?>
									</strong></span><br>
								<span><strong><i class="bi bi-telephone-fill"></i>
								<?php echo $vendor_contact ?>
									</strong></span><br>
							</div>
							<div class="col-md-4 text-center">
								<span class="h5 text-bold">INVOICE</span>
							</div>
							<div class="col-md-4 text-end">
								<!--<span><span class="fw-bold">RefID:</span>-->
								<!--	abc-->
								<!--</span><br>-->
								<span><span class="fw-bold">Creation Date: </span>
								<?php echo $order_place_date ?>
								</span><br>
								<!--<span><span class="me-1 fw-bold">Status:</span>-->
								<!--Paid-->
								<!--</span><br>-->
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
										<!--<th>-->
										<!--	<h6>Category</h6>-->
										<!--</th>-->
										<th>
											<h6>Product Code</h6>
										</th>
										<th>
											<h6>Name</h6>
										</th>
										<th>
											<h6>Price</h6>
										</th>
										<th>
											<h6>Quantity</h6>
										</th>
										<th>
											<h6>
												Total
											</h6>
										</th>
										<th>
											<h6>
												Discount(<?php echo $discountPercent; ?>%)
											</h6>
										</th>
										<th>
											<h6>Net Total</h6>
										</th>
									</tr>
								</thead>
								<tbody>
								    <?php 
								    $select_item = "SELECT  `category_name`,`product_code`, `product_name`,`vendor_checkout_id`, `product_id`, `order_quantity`, `discountPercent`, `sales_rate`, `total_amt`, `discountAmount`, `total_after_discount` FROM `vendor_checkout_items` vci
                                        INNER JOIN vendor_checkout vc ON vc.id = vci.vendor_checkout_id
                                        INNER JOIN products p ON p.id = vci.product_id
                                        INNER JOIN category c on c.category_id = p.category_id
                                        WHERE `vendor_checkout_id`='$v_id' AND `vendor_email` ='$v_email';";
                                        $conn = connectdb();
                                        $req_data = mysqli_query($conn,$select_item)or die(mysqli_error($conn));
                                        $totalSum=0.0;
                                        if (mysqli_num_rows($req_data) > 0) {
                                            $i=1;
                                            while ($data = mysqli_fetch_assoc($req_data)) { 
								    ?>
									<tr>
										<td>
											
											<?php echo $i; ?>
											
										</td>
										<!--<td>-->
											
										<!--   	<?php echo $data['category_name']; ?>-->
											
										<!--</td>-->
										<td>
											
										   	<?php echo $data['product_code']; ?>
											
										</td>
										<td class="text-start">
										<?php echo $data['product_name']; ?>
											
										</td>
										<td>
											<?php echo intval($data['sales_rate']); ?>
											
										</td>
										<td>
											<?php echo $data['order_quantity']; ?>
											
										</td>
										<td>
										   	<?php echo  intval($data['total_amt']); ?>
											
										</td>
										<td>
											<?php echo intval($data['discountAmount']); ?>
											
										</td>
										<td>
											<?php echo intval($data['total_after_discount']); ?>
											</td>
									</tr>
									<?php
									$totalSum=$totalSum +intval($data['total_after_discount']);
									$i++;
                                     }
									}
									?>
							</strong>
							</td>
							</tr>
							<!--<tr>-->
										<!--<td class="text-end" colspan="7"><strong>Vat(13%)</strong></td>-->
										<!--<td><strong>-->
										<!--		Not Included-->
										<!--	</strong></td>-->
							<!--		</tr>-->
									<tr>
										<td class="text-end" colspan="7">
											<span><strong>Total: Rs.</strong></span>
										</td>
										<td class="text-left">
											<span><strong>
											  <?php echo $totalSum; ?>
												</strong></span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div>
							<div class="col-md-12 text-end">
							    
								<p class="mt-2">--------------<br>
								    <span class="me-2">Signature</span>
								</p>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

	<script>
	    window.onload = function() {
       window.print();
    }
	</script>

</body>
</html>