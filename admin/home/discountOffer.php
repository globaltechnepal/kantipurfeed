<?php include "header.php"; ?>
<div class="col-12">
    <!-- heading start -->
    <!-- heading start -->
    <div class="col-12">
        <div class="p-3 mb-2 col-6 me-3 bg-dark text-white text-center">Discount Offer</div>
    </div>
    <!-- heading end -->
    <!-- heading end -->
    <div class="form-check form-switch fw-bold">
        <span class="fw-bold">Enable/disable discount Option</span>
        ON &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox"
            id="flexSwitchCheckDefault">OFF

    </div>
    <form action="" method="post">
        <div class="p-3" style="border:1px solid">

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Actual Price</span>
                <input type="text" class="form-control me-2">
                <span class="input-group-text" id="basic-addon1">Selling Price</span>
                <input type="text" class="form-control me-2">
                <span class="input-group-text" id="basic-addon1">Rate</span>
                <input type="text" class="form-control">
            </div>
            <div class="input-group">
                <span class="input-group-text">Date</span>
                <input type="Date" class="form-control me-2">
                <span class="input-group-text">Time</span>
                <input type="time" class="form-control">
            </div>
            <div class="col-12 mt-3 text-canter">
                <button type="submit" class="btn btn-danger">Submit</button>
            </div>
        </div>
    </form>
</div>
<?php include "footer.php"; ?>