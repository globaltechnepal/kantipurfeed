<?php
include "header.php";
?>
<style>
  input[type=text] {
    border: none;
  } 
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.8/xlsx.full.min.js"></script>
<div class="m-3">
    <a  href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="btn btn-success"><i class="bi bi-arrow-bar-down"></i> Products</a>
</div>
<div class="container">
<div class="mb-3">
  <label for="formFile" class="form-label">Excel File</label>
  <input class="form-control" type="file" id="input_excel">
</div>

<div id="table-container" class="container"></div>

<button id="save-data" class="btn btn-primary">Save Data</button>

</div>

<script>
  $(document).ready(function() {
  $('#input_excel').change(function(e) {
    var file = e.target.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
      var data = e.target.result;
      var workbook = XLSX.read(data, { type: 'binary' });
      workbook.SheetNames.forEach(function(sheetName) {
        var sheet = workbook.Sheets[sheetName];
        var json = XLSX.utils.sheet_to_json(sheet, {header:["SN", "Category","PCode", "Products","Price","Quantity"]}); // add "pID" after "SN" in the header array
        var html = '<table  class="table"><thead><tr><th>S.N</th><th>Category</th><th>PCode</th><th>Products</th><th>Price</th><th>Quantity</th></tr></thead><tbody>';
        for (var i = 0; i < json.length; i++) {
        html += "<tr><td>" + json[i].SN +"</td>";
        html += "<td><input data-id='"+i+"' id='txtCat_"+i+"' type='text' class='category border_remove' value='" + json[i]["Category"] + "' disabled/></td>";
        html += "<td><input data-id='"+i+"' id='txtCode_"+i+"' type='text' class='pCode border_remove' value='" + json[i]["PCode"] + "' disabled/></td>";
        html += "<td><input data-id='"+i+"' id='txtProduct_"+i+"' type='text' class='products' value='" + json[i]["Products"] + "' disabled/></td>";
        html += "<td><input data-id='"+i+"' id='txtPrice_"+i+"' type='text' class='price' value='" + json[i]["Price"] + "' disabled/></td>";
        html += "<td><input data-id='"+i+"' id='txtQty_"+i+"' type='text' class='quantity' value='" + json[i]["Quantity"] + "' disabled/></td></tr>";
        }
        html += "</tbody></table>";
        $('#table-container').html(html);
      });
    };
    reader.readAsBinaryString(file);
  });
});

  
$("#save-data").click(function(){
    var vendor_email ="<?php echo $_SESSION["vendor_email"]; ?>";
    var discountPercent = "<?php echo $discountPercent; ?>";
    var excelcheckout=[];
    var excel_count =0;
    $(".category").each(function(){
        var dataid=$(this).attr("data-id");
        var category =  $("#txtCat_"+dataid).val();
        var pCode = $("#txtCode_"+dataid).val();
        var products =  $("#txtProduct_"+dataid).val(); 
        var price = $("#txtPrice_"+dataid).val();
        var quantity =  $("#txtQty_"+dataid).val()==""?"0":$("#txtQty_"+dataid).val(); 
        if(pCode==""||quantity==""){
            alert("No quantity");
        }
        else{
        var item = pCode+'#'+quantity+'#'+price;
        excelcheckout.push(item);
        excel_count++;
            
        }
    });
    
       if(excelcheckout==""){
           alert("Unable to get Product code or quantity data");
       }
       else{
          $.ajax({
          url: '../../assets/library/upload_from_excel.php',
          type: 'POST',
          data: {get_data_from_excel:excelcheckout,vendor_email:vendor_email,discountPercent:discountPercent},
          success: function(data) {
           console.log(data);
          var da =JSON.parse(data);
           if(da.status_code==200){
               alert("Order place success");
               location.reload();
           }
           else {
               alert("Unable to order the product");
           }
           
          },
          error: function(error) {
            alert("error");
          }
        });
       }
});

</script>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Products</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <table class="table table-hover" id="my-table-exl">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Category</th>
        <th>Product Code</th>
        <th>Product</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
            <?php
            $query = "SELECT products.`id`,`category_name`, `product_code`, `product_name`, `actual_Price`, `sell_Price` FROM `products`
            INNER JOIN category on category.category_id = products.category_id";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
              $i = 1;
              while ($data = mysqli_fetch_assoc($req)) { ?>
      <tr>
        <td><?php echo $data["id"]; ?></td>
        <td><?php echo $data["category_name"]; ?></td>
        <td><?php echo $data["product_code"]; ?></td>
        <td><?php echo $data["product_name"]; ?></td>
        <td><?php echo intval($data["sell_Price"]); ?></td>
      </tr>
            <?php
                $i++;
              }
            }
            ?>
    </tbody>
  </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="export-btn">Dounload</button>
      </div>
    </div>
  </div>
</div>

<script>
    $(document).ready(function(){
      $("#export-btn").click(function(){
        // Select the table element by ID
        var table = $("#my-table-exl")[0];
        
        // Convert table to workbook object
        var workbook = XLSX.utils.table_to_book(table, {sheet:"Sheet1"});
        
        // Convert workbook to binary XLSX file
        var binaryData = XLSX.write(workbook, {bookType:"xlsx", type:"binary"});
        
        // Create download link
        var downloadLink = document.createElement('a');
        downloadLink.href = URL.createObjectURL(new Blob([s2ab(binaryData)],{type:"application/octet-stream"}));
        downloadLink.download = "my-table-exl.xlsx";
        document.body.appendChild(downloadLink);
        downloadLink.click();
      });
      
      // Utility function to convert string to ArrayBuffer
      function s2ab(s) {
        var buf = new ArrayBuffer(s.length);
        var view = new Uint8Array(buf);
        for (var i=0; i<s.length; i++) view[i] = s.charCodeAt(i) & 0xFF;
        return buf;
      }
    });
  </script>
  
<?php
include "footer.php";
?>