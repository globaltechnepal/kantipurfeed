<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

hello <br>
<script>
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
     const products = JSON.parse(this.responseText);
     console.log(products);
     jQuery.each( products, function( i, val ){
        document.write(val.name);
        document.write("<br>");
     })
    //  document.getElementById("demo").innerHTML = myObj.name;
    }
    xmlhttp.open("GET", "library.php");
    xmlhttp.send();
</script>

<!-- bootstrap cdn -->
<!-- bootstrap cdn -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- bootstrap cdn -->
<!-- bootstrap cdn -->

</body>
</html>