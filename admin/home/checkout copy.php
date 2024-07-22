<?php include "header.php" ?>
<div class="col-6 d-flex">
  <div class="p-3 mb-2 col-9 bg-dark text-white text-center">Checkout List</div>
</div>
<!-- datatable start -->
<!-- datatable start -->
<div class="col-12">
  <table id="table_id" class="display">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Checkout Date</th>
        <th>Contact</th>
        <th>Refrence No.</th>
        <th>Payment Status</th>
        <th>Delevary Status</th>
        <th>Details</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>12 days</td>
        <td>9812121212</td>
        <td>Ultima Earbuds Atom 192</td>
        <td>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
            <label class="form-check-label" for="flexSwitchCheckChecked">Pending</label>
          </div>
        </td>
        <td>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
            <label class="form-check-label" for="flexSwitchCheckChecked">Pending</label>
          </div>
        </td>
        <td>
          <a class="btn" data-bs-target="#contactDisplay" href="#contactDisplay" data-bs-toggle="modal">
            <i class="bi bi-eye-fill" style="color:green" title="View Details"></i></a>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<!-- datatable end -->
<!-- datatable end -->

<!-- contact form -->
<!-- contact form -->
<div class="modal fade ms-5 ps-5 abcclass" id="contactDisplay" aria-hidden="true" aria-labelledby="exampleModalToggle2"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:90px;">
    <div class="modal-content p-3">
      <div class="p-3 mb-2 bg-dark text-white text-center">Client Details</div>

      <div class="text-center fw-bold mt-3"><span>Phone/Email</span></div>
      <hr>
      <div class="row">
        <div class="col">
          <span class="input-group-text" id="basic-addon1"> Phone Number : &nbsp; 9832323232</span>
        </div>
        <div class="col">
          <span class="input-group-text" id="basic-addon1">Email : &nbsp; abc@gmail.com</span>
        </div>
      </div>
      <hr>
      <div class="text-center fw-bold mt-2"><span>Address</span></div>
      <hr>
      <div class="row">
        <div class="col">
          <span class="input-group-text" id="basic-addon1">Province : &nbsp; Gandaki</span>
        </div>
        <div class="col">
          <span class="input-group-text" id="basic-addon1">District : &nbsp; Kavrapalanchowk</span>
        </div>
        <div class="col">
          <span class="input-group-text" id="basic-addon1">City : &nbsp; RamPur Dhamaaa</span>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
          <span class="input-group-text" id="basic-addon1">Municipality : &nbsp; Nagarjun Nagarpalika</span>
        </div>
        <div class="col">
          <span class="input-group-text" id="basic-addon1">Chowk/Tole : &nbsp; GLsaikundha CHowk</span>
        </div>
      </div>
      <hr>
      <div class="text-center fw-bold mt-2"><span>Products</span></div>
      <hr>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">S.N.</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>Larry the Bird</td>
            <td>@twitter</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- contact form -->
<!-- contact form -->

<!-- courier form -->
<!-- courier form -->
<div class="modal fade ms-5 ps-5 abcclass" id="courierDisplay" aria-hidden="true" aria-labelledby="exampleModalToggle2"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:90px;">
    <div class="modal-content p-3">
      <div class="p-3 mb-2 bg-dark text-white text-center">Courier</div>
      <div class="row mt-2">
        <div class="col">
          <span class="input-group-text" id="basic-addon1">Courier Date : &nbsp; 20/13/2022 </span>
        </div>
        <div class="col">
          <span class="input-group-text" id="basic-addon1">CN No : &nbsp; ULT32 </span>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col">
          <span class="input-group-text" id="basic-addon1">Phone Number : &nbsp; 985665665 </span>
        </div>
        <div class="col">
          <span class="input-group-text" id="basic-addon1">Company : &nbsp; abc courier company pvt.ltd </span>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- courier form -->
<!-- courier form -->

<?php
include 'footer.php';
?>