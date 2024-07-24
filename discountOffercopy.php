<?php
//  include "header.php"; 
?>
<div style="">
  <button type="submit" id="mybutton" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"
    style="
    position: absolute;
    transform: rotate(90deg);
    background:black; 
    top:70vh;
    left:-60px;
    color:white;
    boarder:none;
    z-index:2;
    ">Get your discount</button>

  <script>
    $(document).ready(function () {
      $('#mybutton').hide().delay(5000).fadeIn(2200);
    });
  </script>
</div>

<!-- Modal -->
<div class="modal fade w-100" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <button type="button" class="btn-close bg-white" aria-label="Close"
      style="top: 50px; position: absolute; right:100px;"></button>
    <div class="modal-content rounded-circle border border-4 border-danger discount-banner" style="background: black;">
      <div class="col-12 text-center pt-4">
        <img class="rounded-4 py-2 w-50" src="assets/images/LOGO/logo.png">
      </div>
      <div class="col-12 py-2 text-center text-white">
        <div class="h4">SPECIAL "BIG"</div>
        <div class="h1"> 10% OFF</div>
        <div class="h4">ONLY FOR YOU!</div>
      </div>
      <div class="col-12 text-center text-white py-2">
        <button type="button" class="btn col-auto" style="background:red; color:white">Offer expires: <strong
            id="demo"></strong></button>
      </div>
      <div class="col-12 text-center text-white py-3">
        <input type="text" value="ULT-1-2" id="myInput" style="display:none;">
        <button class="btn fs-5" onclick="myFunction()" style="background:white">Copy code</button>
      </div>
    </div>
  </div>
</div>

<script>
  function myFunction() {
    // Get the text field
    var copyText = document.getElementById("myInput");

    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);

    // Alert the copied text
    // alert("Copied the text: " + copyText.value);
    alert("Feature Available Soon!!");
  }
</script>

<script>
  // Set the date we're counting down to
  var countDownDate = new Date("oct 30, 2022 15:37:25").getTime();

  // Update the count down every 1 second
  var x = setInterval(function () {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "EXPIRED";
    }
  }, 1000);
</script>
<?php
//  include "footer.php";
?>