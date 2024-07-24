<?php  include "header.php" ?>
<div class="col-12">
  <div class="col-12 d-flex">
    <div class="col-6 bg-dark text-white text-center p-2 mb-3 text-uppercase">
      <?php
      $FAQaId = $_GET['id'];
      // popMsg($FAQaId);
      $myQuery = "SELECT `id`, `product_name` FROM `products` where id='$FAQaId'";
      $conn = dbConnecting();
      $req = mysqli_query($conn, $myQuery) or die(mysqli_error($conn));
      if(mysqli_num_rows($req)>0){
      $i=1;
      while($data = mysqli_fetch_assoc($req)){ ?>
      <span><?php echo $data['product_name']; ?></span>
    </div>
    <?php
    $i++;
    }
    }
  ?>
    <button type="button" class="btn btn-outline-secondary col-2 ms-3 mb-2" data-bs-target="#exampleModalToggle"
      href="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add</button>
  </div>
  <!-- datatable start -->
  <!-- datatable start -->
  <table id="table_id" class="display">
    <thead>
      <tr>
        <th>S.N.</th>
        <th>Question</th>
        <th>Answer</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      // $FAQaId = $_GET['id'];
      // popMsg($FAQaId);
      $myQuery = "SELECT `id`, `product_id`, `question`, `answer`, `modify_date`, `remarks` FROM `faqs` WHERE product_id=$FAQaId";
      $conn = dbConnecting();
      $req = mysqli_query($conn, $myQuery) or die(mysqli_error($conn));
      if(mysqli_num_rows($req)>0){
      $i=1;
      while($data = mysqli_fetch_assoc($req)){ ?>
      <tr>
        <td>
          <?php echo $i ?>
        </td>
        <td>
          <?php echo $data['question']; ?>
        </td>
        <td>
          <?php echo $data['answer']; ?>
        </td>
        <td><a class="btn btn-primary update_faq" data-bs-target="#exampleModalToggle1" href="#exampleModalToggle1"
            data-bs-toggle="modal" data-faq_question="<?php echo $data['question']; ?>" data-faq_answer="
            <?php echo $data['answer']; ?>" data-faq_id="
            <?php echo $data['id']; ?>"><i class="bi bi-check2-circle"></i></a></td>
        <td>
          <button type="submit" name="deleteFAQs" class="btn btn-danger text-center delete_item" data-del_item_id="<?php echo $data['id']; ?>" data-del_item_name="faq"><i class="bi bi-trash-fill"></i></button></form>
        </td>
      </tr>
      <?php
        $i++;
        }
        }
        ?>
    </tbody>
  </table>
  <!-- datatable end -->
  <!-- datatable end -->
</div>
</div>

<!-- add new FAQS -->
<!-- add new FAQS  -->
<div class="modal ms-5 ps-5" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggle"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Add FAQs</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="m-3 p-3" style="border:1px solid">
          <div class="mb-3">
            <label class="form-label">Question</label>
            <input type="text" class="form-control" id="question" name="question">
          </div>
          <div class="mb-3">
            <label class="form-label">Answer</label>
            <textarea class="form-control" rows="3" name="answer" id="answer"></textarea>
          </div>
          <div class="text-center">
            <button type="button" class="btn btn-danger" name="submitFAQs" id="submitFAQs" data-product_id=<?php echo
              $_GET['id']; ?>>Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $('#submitFAQs').click(function () {
    var product_id = $(this).attr("data-product_id");
    var question = $('#question').val();
    var answer = $('#answer').val();
    if (product_id == "" || question == "" || answer == "") {
      alert("Please Fill The Field");
      return false;
    }
    else {
      // alert("entering ajex");
      $.ajax({
        url: "library/database.php",
        method: "POST",
        data: { faq_product_id: product_id, question: question, answer: answer },
        success: function (data) {
          console.log(data);
        //   reload_page();
          var da = JSON.parse(data);
                    if(da.status_code==200){
          alert("FAQ Added successfully");
                    location.reload();
                    }else{
                        alert("Error");
                    }
        }
      });
    }
  });

  function reload_page() {
    location.reload();
  }
</script>
<!-- add new FAQS -->
<!-- add new FAQS  -->


<!-- Update FAQS -->
<!-- Update FAQS -->
<div class="modal ms-5 ps-5" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggle1"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Update FAQS</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="m-3 p-3" style="border:1px solid">
          <div class="mb-3">
            <label class="form-label">Question</label>
            <input type="text" class="form-control" id="questionUpdate" name="questionUpdate">
          </div>
          <div class="mb-3">
            <label class="form-label">Answer</label>
            <textarea class="form-control" rows="3" name="answerUpdate" id="answerUpdate"></textarea>
          </div>
          <div class="text-center">
            <button type="button" class="btn btn-danger" name="submitUpdateFAQs" id="submitUpdateFAQs">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  $(".update_faq").click(function () {
    var update_faq_id = $(this).attr("data-faq_id").trim();
    $("#submitUpdateFAQs").attr("data-faq_id", update_faq_id);
    var questionUpdate = $(this).attr("data-faq_question").trim();
    $("#questionUpdate").val(questionUpdate);
    var answerUpdate = $(this).attr("data-faq_answer").trim();
    $("#answerUpdate").text(answerUpdate);
    // alert(questionUpdate);
  });
  $('#submitUpdateFAQs').click(function () {
    var update_faq_id = $(this).attr("data-faq_id");
    var questionUpdate = $("#questionUpdate").val();
    var answerUpdate = $("#answerUpdate").val();
    if (update_faq_id == "" || questionUpdate == "" || answerUpdate == "") {
      alert("Please Fill The Field");
      return false;
    }
    else {
      $.ajax({
        url: "library/database.php",
        method: "POST",
        data: { questionUpdate: questionUpdate, answerUpdate: answerUpdate, update_faq_id: update_faq_id },
        success: function (data) {
          console.log(data);
          var da = JSON.parse(data);
                    if(da.status_code==200){
          alert("FAQ Update successfully");
                    location.reload();
                    }else{
                        alert("Error");
                    }
        }
      });
    }
  });

  function reload_page() {
    location.reload();
  }
</script>
<!-- Update FAQS -->
<!-- Update FAQS -->
<?php include "footer.php"; ?>