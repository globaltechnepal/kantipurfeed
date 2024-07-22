<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.debug.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

	<title>Invoice</title>
	<link rel="icon" href="img\logo\faviconblack.png">
	<style>
		.body-main {
			background: #ffffff;
			border: 1px solid;
			/* border-bottom: 5px solid #1E1F23;
			border-top: 5px solid #1E1F23; */
			/* margin-left: 100px;
			margin-top: 30px;
			margin-bottom: 30px; */
			padding: 40px 30px !important;
			position: relative;
			/* box-shadow: 0 1px 21px #808080; */
			font-size: 10px;
		}
	</style>
</head>

<body class="text-center">
<?php
include 'assets/library/library.php';
include 'invoice.php';
?>
</body>
<script>
    window.onload = function() {
        $("#disapper_it").remove();
        $("#print_btn").click();
    }
</script>
</html>