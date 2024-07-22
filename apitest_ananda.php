<?php include "header.php"; ?>
<button onclick="loadAPIS();">Click me</button>

<script>
    $(document).ready(function () {
    });
    function loadAPIS() {
        alert("I am clicked");
        $.ajax({
            url: "http://api.globaltech.com.np:802/api/MasterList/ProductList?DbName=ErpDEmo101",
            method: "GET",
            dataType: "JSON",
            success: function (data) {
                if (STATUS_CODE = 200) {
                    alert("ok");
                    console.log(data);
                    var html = '';
                    html += '<table  style="color:white;" class="table">';
                    html += '<thead>';
                    html += '<tr>';
                    html += '<th>S.N</th>';
                    html += '<th>GroupName</th>';
                    html += '<th>PCode</th>';
                    html += '<th>PDesc</th>';
                    html += '<th>PShortName</th>';
                    html += '<th>BuyRate</th>';
                    html += '<th>SalesRate</th>';
                    html += '</tr>';
                    html += '</thead>';
                    var len = data.data.length;
                    for (i = 0; i < len; i++) {
                        html += '<tbody>';
                        html += '<tr>';
                        html += '<td>' + (i + 1) + '</td>';
                        html += '<td>' + data.data[i].GroupName + '</td>';
                        html += '<td>' + data.data[i].PCode + '</td>';
                        html += '<td>' + data.data[i].PDesc + '</td>';
                        html += '<td>' + data.data[i].PShortName + '</td>';
                        html += '<td>' + data.data[i].BuyRate + '</td>';
                        html += '<td>' + data.data[i].SalesRate + '</td>';
                        html += '</tr>';
                        html += '</tbody>';
                    }
                    html += '</table>';
                    $("#displayPannel").html(html);
                }
            }
        });
    }

</script>

<div id="displayPannel"></div>
<?php include "footer.php"; ?>