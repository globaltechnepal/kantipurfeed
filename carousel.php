<?php
// include 'header.php';
$sql = "SELECT * FROM carousel";
$conn = connectDB();
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
?>
<div id="carouselItemCaptions" class="carousel slide carouselSize" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <?php for ($i = 0; $i < 8; $i++) {
  if ($i == 0) {
?>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
      aria-current="true" aria-label="Slide 1"></button>
    <?php
  }
  else {
?>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i; ?>"
      aria-label="Slide <?php echo $i + 1; ?>"></button>
    <?php
  }
}?>
  </div>
  <div class="carousel-inner">
    <?php
$i = 0;
while ($data = mysqli_fetch_assoc($res)) {
  if ($i == 0) {
?>
    <div class="carousel-item active">
      <img src="<?php echo $data['img_path'] . $data['img']; ?>" class="d-block w-100 carouselIMG">
      <div class="carousel-caption d-none d-md-block text-dark">
      </div>
    </div>
    <?php
  }
  else {
?>
    <div class="carousel-item">
      <img src="<?php echo $data['img_path'] . $data['img']; ?>" class="d-block w-100 carouselIMG">
      <div class="carousel-caption d-none d-md-block text-dark">
        <h5>
          <?php //echo $i; ?>
        </h5>

      </div>
    </div>
    <?php
  }
  $i++;
}?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselItemCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselItemCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- break   -->
<!-- break   -->
<!-- break   -->
<!-- break   -->

<?php
// include 'footer.php';
?>