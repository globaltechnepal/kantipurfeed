<?php include 'header.php'; ?>
<button onclick="loadApi();">Call API</button>
<script>
    $(document).ready(function () {

    })
    function loadApi() {
        alert("ok clicked");
        $.ajax({
            url: "http://api.globaltech.com.np:802/api/MasterList/ProductList?DbName=ErpDEmo101",
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                if (status_code = 200) {
                    alert("success");
                    console.log(data);
                    var html = '';
                    html += '<table class="table w-100">';
                    html += '<thead><tr>';
                    html += '<th>sn</th><th>Group Name</th><th>P Code</th><th>P Short Name</th><th style="width:10%;">Buy Rate</th><th>Product Desc </th><th style="width:10%;">Sales Rate</th>';
                    html += '</tr></thead>';
                    html += '<tbody>';
                    //now lets print all the data from the source
                    var len = data.data.length;
                    for (var i = 1; i < len; i++) {
                        html += '<tr>';
                        html += '<td>' + i + '</td>';
                        html += '<td>' + data.data[i].GroupName + '</td>';
                        html += '<td>' + data.data[i].PCode + '</td>';
                        html += '<td>' + data.data[i].PShortName + '</td>';
                        html += '<td>' + data.data[i].BuyRate + '</td>';
                        html += '<td>' + data.data[i].PDesc + '</td>';
                        html += '<td>' + data.data[i].SalesRate + '</td>';
                        html += '</tr>';
                    }
                    html += '</tbody>';
                    html += '</table>';
                }
                $('#printHere').empty();
                $('#printHere').html(html);
                alert("Complete");
            }
        });
    }
</script>

<div class="container bg-white fs-normal" id="printHere">If you click an <strong>Call Api </strong>Button, Something
    will be printed here.</div>
<?php include 'footer.php'; ?>



<table>
    <tr></tr>
</table>