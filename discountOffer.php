<?php
//  include "header.php" 
 ?>
<div style="">
<button type="submit" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" style="
    position: absolute;
    transform: rotate(90deg);
    top: 60vh;
    left:-8vh;
    background:black; 
    color:white;
    boarder:none;
    z-index:2;
    ">Get your discount</button>
</div>

<!-- Modal -->
<div class="modal fade mt-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" >
  <button type="button" class="btn-close" aria-label="Close" style="top: 50px; position: absolute; right: -58px;"></button>
    <div class="modal-content" style="border-radius: 50%; background: red; width:550px;">
    <div class="mt-2 ms-2 mb-2 me-2" style="border-radius: 50%; background: black; height:70vh;">
    <div class="col-12 text-center mt-5">
    <img class="mt-3" src="assets/images/ultima-logo.png" width="180" height="80">
    </div>
    <div class="col-12 mt-3 text-center text-white">
      <h1>SPECIAL 10% OFF</h1>
      <h6>ONLY FOR YOU!</h6>
    </div>
    <div class="col-12 text-center text-white mt-5" >
    <button type="button" class="btn col-6" style="background:red; color:white">Offer expires:<p id="demo"></p></button>
    </div>
    <div class="col-12 text-center text-white mt-5" >
    <button type="submit" class="btn" style="background:white">Copy cupon code</button>
    </div>
    </div>
    </div>
  </div>
</div>
<script>
// Set the date we're counting down to
var countDownDate = new Date("Aug 5, 2022 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

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
//  include "footer.php"
  ?>