<?php include "header.php" ?>

<div class="topbar text-center pt-3" style="background: red;"><span class="text-white fw-bold mt-3">Order
        History</span>
</div>
<div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Order Date</th>
                <th scope="col">Product</th>
                <th scope="col">Color</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            <input type="hidden" id="userEmail" value="<?php echo $_SESSION['email']; ?>">
            <?php
            $userEmail = $_SESSION['email'];
            ?>
            <?php
            $orderHistry = "SELECT o.`id`, o.`quantity`,p.`product_name`,clr.`color_name`,p.`sell_Price`, o.`product_variant_id`, o.`cart_id`, o.`remarks` FROM `orders` O
INNER JOIN productvariant pv on pv.id = o.product_variant_id
INNER JOIN products p ON p.id = pv.product_id
INNER JOIN cart c on c.id = o.cart_id
INNER JOIN colors clr ON clr.id = pv.color_id
INNER JOIN users u ON u.id = c.user_id WHERE email ='$userEmail '";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $orderHistry) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
                $i = 1;
                while ($data = mysqli_fetch_assoc($req)) {
            ?>
            <tr>
                <td>
                    <?php echo $i; ?>
                </td>
                <td>
                    <?php echo $data['remarks']; ?>
                </td>
                <td>
                    <?php echo $data['product_name']; ?>
                </td>
                <td>
                    <?php echo $data['color_name']; ?>
                </td>
                <td>
                    <?php echo $data['quantity']; ?>
                </td>
                <td>
                    <?php echo $data['sell_Price']; ?>
                </td>
            </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php include "footer.php" ?>