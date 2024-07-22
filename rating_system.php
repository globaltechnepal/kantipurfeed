<?php

// include 'header.php';
?>
<style>
    .progress-label-left {
        float: left;
        margin-right: 0.5em;
        line-height: 1em;
    }

    .progress-label-right {
        float: right;
        margin-left: 0.3em;
        line-height: 1em;
    }

    .star-light {
        color: #e9ecef;
    }
</style>
<?php
$i = 1;
while ($i < 8) 
{
?>
<!-- testing aos  -->
<!-- testing aos  -->

<!-- <div class="col-12 d-inline-flex">
    <div class="col-6 text-white">
        <p>This is paragraph Lorem, ipsum dolor sit amet consectetur adipisicing elit. 
            Explicabo veniam fugiat molestiae molestias sed, quasi, laboriosam sunt ea 
            praesentium nobis beatae architecto id officia eum ipsa voluptatibus delectus nihil unde!</p>
    </div>
    <div class="col-6" data-aos="fade-down" data-aos-duration="1500">
        <img src="assets\images\products\eardopesblue.png" alt="kehi ta hola..">
    </div>
</div> -->
<!-- testing aos  -->
<!-- testing aos  -->
<?php

    $i++;
}
?>





<!-- main container -->
<div class="col-12 p-5" style="background:white">
    <div class="text-center">
        <h1 class="mb-5 fw-bold">Review</h1>
    </div>
    <div class="card">
        <!-- <div class="card-header">Sample Product</div> -->
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <h1 class="text-warning mt-4 mb-4">
                        <b><span id="average_rating">0.0</span> / 5</b>
                    </h1>
                    <div class="mb-3">
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                        <i class="fas fa-star star-light mr-1 main_star"></i>
                    </div>
                    <h3><span id="total_review">0</span> Review</h3>
                </div>
                <div class="col-sm-4">
                    <p>
                    <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                    <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100" id="five_star_progress"></div>
                    </div>
                    </p>
                    <p>
                    <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                    <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100" id="four_star_progress"></div>
                    </div>
                    </p>
                    <p>
                    <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                    <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100" id="three_star_progress"></div>
                    </div>
                    </p>
                    <p>
                    <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                    <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100" id="two_star_progress"></div>
                    </div>
                    </p>
                    <p>
                    <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                    <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                            aria-valuemax="100" id="one_star_progress"></div>
                    </div>
                    </p>
                </div>
                <div class="col-sm-4 text-center">
                    <h3 class="mt-4 mb-3">Write Review Here</h3>
                    <button type="button" name="add_review" id="add_review" class="btn btn-primary">Review</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5" id="review_content"></div>
</div>
<!-- main container -->
<!-- main container -->
<script>
    $(document).ready(function(){
       $("#add_review").click(function(){
           var loginStatus=$("#loginStatus").attr("data-login_status");
        //   alert('clicked'+loginStatus);
           if(loginStatus == 0){
               alert ("Please login to Give Review.")
           }else{
               $("#exampleModalReview").modal('show');
           }
       }); 
    });
</script>
<!-- dialog popup -->
<!-- dialog popup -->
<div class="modal fade" id="exampleModalReview" tabindex="-1" aria-labelledby="exampleModalReview" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <h4 class="text-center mt-2 mb-4 fs-3">
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                        <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                    </h4>

                    <input type="hidden" id="user_id" name="user_id" value="1">

                    <div class="mb-3">
                        <input name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                    </div>

                    <!-- <input type="hidden" id="product_id" name="product_id" value="1"> -->

                    <div class="form-group">
                        <textarea name="review_message" id="review_message" class="form-control"
                            placeholder="Type Review Here"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image(optional)</label>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <input class="form-control" id="fileupload" type="file" name="fileupload"
                                onchange="uploadFile()" />
                        </form>
                    </div>
                    <div class="form-group text-center mt-4">
                        <button type="button" class="btn btn-primary" id="save_review">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- dialog popup -->
<!-- dialog popup -->

<!-- script here -->
<!-- script here -->
<script>
    //file upload function
    //file upload function
    //file upload function
    //file upload function
    async function uploadFile() {
        // alert('i am called');
        let formData = new FormData();
        formData.append("file", fileupload.files[0]);
        await fetch('assets/library/image_uploader.php', {
            method: "POST",
            body: formData
        });
        // alert('The file has been uploaded successfully.');
        // var name = $('#fileupload').val().replace(/C:\\fakepath\\/i, 'assets/images/reviews/uploads/');
        // alert(name);
    }
    //file upload function
    //file upload function
    //file upload function
    //file upload function
    $(document).ready(function () {
        var rating_data = 0;

        $('#add_review').click(function () {

            $('#review_modal').modal('show');

        });


        $(document).on('mouseenter', '.submit_star', function () {

            var rating = $(this).data('rating');

            reset_background();

            for (var count = 1; count <= rating; count++) {

                $('#submit_star_' + count).addClass('text-warning');

            }

        });

        function reset_background() {
            for (var count = 1; count <= 5; count++) {

                $('#submit_star_' + count).addClass('star-light');

                $('#submit_star_' + count).removeClass('text-warning');

            }
        }

        $(document).on('mouseleave', '.submit_star', function () {

            reset_background();

            for (var count = 1; count <= rating_data; count++) {

                $('#submit_star_' + count).removeClass('star-light');

                $('#submit_star_' + count).addClass('text-warning');
            }

        });

        $(document).on('click', '.submit_star', function () {

            rating_data = $(this).data('rating');

        });

        $('#save_review').click(function () {

            var user_id = $('#user_id').val();
            var user_name = $('#user_name').val();
            var product_id = $("#displaying_product_id").attr("data-displaying_product_id");
            var attachment = $('#fileupload').val().replace(/C:\\fakepath\\/i, 'assets/images/reviews/uploads/');
            // alert ("attachment name: "+attachment);
            var review_message = $('#review_message').val();

            if (user_name == '' || review_message == '' || rating_data == '') {
                alert("Please Fill all Field");
                return false;
            }
            else {
                $.ajax({
                    url: "rating_system_submit.php",
                    method: "POST",
                    data: { rating_data: rating_data, product_id: product_id, user_id: user_id, user_name: user_name, review_message: review_message, attachment: attachment },
                    success: function (data) {
                        $('#exampleModalReview').modal('hide');
                        // location.reload();

                        load_rating_data();

                        alert(data);
                    }
                })
            }

        });

        load_rating_data();

        function load_rating_data() {
            var product_id = $("#displaying_product_id").attr("data-displaying_product_id");
            // alert(product_id);
            $.ajax({
                url: "rating_system_submit.php",
                method: "POST",
                data: { action: product_id },
                dataType: "JSON",
                success: function (data) {
                    // console.log(data);                    if(average_rating==null||average_rating==''||average_rating=='nan'){average_rating=0;}
                    $('#average_rating_top').text(data.average_rating);
                    $('#average_rating').text(data.average_rating);
                    $('#total_review_top').text(data.total_review);
                    $('#total_review').text(data.total_review);
                    // var star_value = data.average_rating;
                    // console.log("average_11");
                    // console.log(data.average_rating);
                    var star_value = isNaN(data.average_rating)?"0.00":data.average_rating;
                    var star = parseInt(star_value);
                    // alert(star);

                    var decimals = star_value - Math.floor(star_value);

                    var decimalPlaces = star_value.toString().split('.')[1].length;
                    decimals = decimals.toFixed(decimalPlaces);
                    // alert(decimals);


                    $('#review_stars').empty();
                    var display_star = 5 - star;
                    // alert("display star : "+display_star);
                    for (var i = 1; i <= star; i++) {
                        $('#review_stars').append('<i class="bi bi-star-fill"></i>');
                    }
                    var j = 1;
                    while (j <= display_star) {
                        if (decimals > 0.0 && decimals <= 0.5) {
                            $('#review_stars').append('<i class="bi bi-star-half"></i>');
                            decimals = 0;
                        }
                        else if (decimals > 0.5 && decimals <= 1) {
                            $('#review_stars').append('<i class="bi bi-star-fill"></i>');
                            decimals = 0;
                        }
                        else {
                            $('#review_stars').append('<i class="bi bi-star"></i>');
                        }
                        // alert("VALUE OF J :"+j);
                        j++;
                    }


                    var count_star = 0;

                    $('.main_star').each(function () {
                        count_star++;
                        if (Math.ceil(data.average_rating) >= count_star) {
                            $(this).addClass('text-warning');
                            $(this).addClass('star-light');
                        }
                    });

                    $('#total_five_star_review').text(data.five_star_review);

                    $('#total_four_star_review').text(data.four_star_review);

                    $('#total_three_star_review').text(data.three_star_review);

                    $('#total_two_star_review').text(data.two_star_review);

                    $('#total_one_star_review').text(data.one_star_review);

                    $('#five_star_progress').css('width', (data.five_star_review / data.total_review) * 100 + '%');

                    $('#four_star_progress').css('width', (data.four_star_review / data.total_review) * 100 + '%');

                    $('#three_star_progress').css('width', (data.three_star_review / data.total_review) * 100 + '%');

                    $('#two_star_progress').css('width', (data.two_star_review / data.total_review) * 100 + '%');

                    $('#one_star_progress').css('width', (data.one_star_review / data.total_review) * 100 + '%');

                    if (data.review_point.length > 0) {
                        var html = '';
                        var total = data.review_point.length;
                        if (total >= 5) {
                            total = 4;
                        }

                        for (var count = 0; count < total; count++) {
                            html += '<div class="row mb-3">';

                            html += '<div class="col-sm-1"><div class="rounded-pill bg-danger text-white p-2"><h3 class="text-center">' + data.review_point[count].user_name.charAt(0) + '</h3></div></div>';

                            html += '<div class="col-sm-11">';

                            html += '<div class="card" style="height:250px;">';

                            html += '<div class="card-header"><b>' + data.review_point[count].user_name + '</b></div>';

                            html += '<div class="card-body d-inline-flex">';

                            html += '<div class="col-6">';
                            html += '<div class="col-12 fs-5">'; //font size mila hai

                            for (var star = 1; star <= 5; star++) {
                                var class_name = '';

                                if (data.review_point[count].rating >= star) {
                                    class_name = 'text-warning';
                                }
                                else {
                                    class_name = 'star-light';
                                }

                                html += '<i class="fas fa-star ' + class_name + ' mr-1"></i>';
                            }

                            html += '</div>';
                            html += '<div class="col-12 fs-5 mt-2" style="overflow-y:auto;height:80%;">';

                            html += data.review_point[count].review_message;

                            html += '</div>';

                            html += '</div>';

                            html += '<div class="col-6 text-center w-100">';
                            var img_full_name = data.review_point[count].attachment;
                            // alert(img_full_name);
                            if (img_full_name == '' || img_full_name == null) {
                                html += '<div class="h4">No image</div>';
                            }
                            else {
                                html += '<div class="aosadder"> <img style="height:100%;" src="' + img_full_name + '"></div>';
                            }
                            html += '</div></div>';

                            html += '<div class="card-footer text-right pt-2">On ' + data.review_point[count].datetime + '</div>';

                            html += '</div>';

                            html += '</div>';

                            html += '</div>';
                        }

                        $('#review_content').html(html);
                    }
                }
            })
        }

    });
</script>

<script>
    $(document).ready(function () {
        $(".aosadder").each(function () {
            $(this).attr("data-aos", "fade-right");
        });
    });
</script>
<!-- script here -->
<!-- script here -->

<?php
// include 'footer.php'; 
?>