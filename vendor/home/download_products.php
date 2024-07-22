
<?php 
include "header.php";
?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.6/xlsx.full.min.js"></script>
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

  <table id="my-table-exl">
    <thead>
      <tr>
        <th>Column 1</th>
        <th>Column 2</th>
        <th>Column 3</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Data 1.1</td>
        <td>Data 1.2</td>
        <td>Data 1.3</td>
      </tr>
      <tr>
        <td>Data 2.1</td>
        <td>Data 2.2</td>
        <td>Data 2.3</td>
      </tr>
      <tr>
        <td>Data 3.1</td>
        <td>Data 3.2</td>
        <td>Data 3.3</td>
      </tr>
    </tbody>
  </table>
  <button id="export-btn">Export to Excel</button>
  
<?php 
include "footer.php";
?>
