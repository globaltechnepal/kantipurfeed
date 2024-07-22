git<?php
include 'header.php'
  ?>
<div class="container d-flex flex-wrap">
  <div class="row">
    <div class="col">
      <div class="card ms-3 mb-2" style="width: 20rem;">
        <div class="text-center">
          <img src="assets/images/products/airdopesblack.png" class="card-img-top w-75">
        </div>
        <div class="card-body">
          <span style="background:red; color:white" class="p-1 ">Earbuds</span>
          <h5 class="card-title fw-bold mt-2">What's new on Werless Earbuds ?</h5>
          <p class="card-text long_paragraph">It’s hard to buy a bad pair of wireless earbuds these days. The market has
            come a long
            way
            since the early era of true wireless earbuds when we had to deal with mediocre sound quality and unreliable
            performance, all for the sake of ditching wires. </p>
          <div class=" text-center">
            <a href="atom192.php" class="btn btn-primary">Read Me</a>
          </div>
        </div>
      </div>
    </div>

    <!--<div class="col">-->
    <!--  <div class="card ms-3 mb-2 " style="width: 20rem;">-->
    <!--    <div class="text-center">-->
    <!--      <img src="assets/images/products/beatz355black.png" class="card-img-top w-75" alt="...">-->
    <!--    </div>-->
    <!--    <div class="card-body">-->
    <!--      <span style="background:#025802; color:white" class="p-1 ">Nackband</span>-->
    <!--      <h5 class="card-title fw-bold mt-2">What's new on Werless Nackband ?</h5>-->
    <!--      <p class="card-text long_paragraph">It’s hard to buy a bad pair of wireless Nackband these days. The market-->
    <!--        has come a long-->
    <!--        way-->
    <!--        since the early era of true wireless Nackband when we had to deal with mediocre sound quality and unreliable-->
    <!--        performance, all for the sake of ditching wires. </p>-->
    <!--      <div class=" text-center">-->
    <!--        <a href="beatzNeckband.php" class="btn btn-primary">Read Me</a>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->

    <!--<div class="col">-->
    <!--  <div class="card ms-3 mb-2" style="width: 20rem;">-->
    <!--    <div class="text-center">-->
    <!--      <img src="assets/images/products/charger.png" class="card-img-top w-75">-->
    <!--    </div>-->
    <!--    <div class="card-body">-->
    <!--      <span style="background:#026790; color:white" class="p-1 ">20w Fast Charger</span>-->
    <!--      <h5 class="card-title fw-bold mt-2">What's new on 20w Fast Charger ?</h5>-->
    <!--      <p class="card-text long_paragraph" id="result">A charger is the accessory you plug into your phone or laptop-->
    <!--        when the-->
    <!--        battery power is-->
    <!--        low.-->
    <!--      </p>-->
    <!--      <div class=" text-center">-->
    <!--        <a href="20Wcharger.php" class="btn btn-primary">Read Me</a>-->
    <!--      </div>-->
    <!--    </div>-->
    <!--  </div>-->
    <!--</div>-->
  </div>
</div>

<script>
  $(".long_paragraph").each(function () {
    var long_text = $(this).text();
    if (long_text.length > 80) {
      $(this).text(long_text.substring(0, 80) + '.....');
    }
  })

</script>
<?php
include 'footer.php'
  ?>