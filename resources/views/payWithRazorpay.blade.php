<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>laravel 6 Razorpay Payment Gateway - Tutsmake.com</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
</head>
<body>
<h2>{{$oid}}</h2>
   <h1 class="text-center"><a href="javascript:void(0)" class="btn btn-sm btn-primary buy_now" data-amount="1000" data-id="1">Order Now</a> </h1> 


    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var SITEURL = '{{URL::to('')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 
        $('body').on('click', '.buy_now', function(e){
            var totalAmount = $(this).attr("data-amount");
            var product_id =  $(this).attr("data-id");
            var options = {
                "key": "rzp_test_b9bbROv33Dc5tc",
                "amount": (totalAmount*100), // 2000 paise = INR 20
                "name": "Ankur",
                "description": "Test Payment",
                "image": "{{URL('/')}}/photo/emblem.png",
                "order_id": "{{$oid}}",
                "handler": function (response){
                    $.ajax({
                        url: SITEURL + '/paysuccess',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            razorpay_payment_id: response.razorpay_payment_id , 
                            total_amount : totalAmount ,
                            product_id : product_id,
                            res : response,
                        }, 
                        success: function (msg) {
                            window.location.href = SITEURL + '/razor-thank-you';
                        }
                    });
                },
                "prefill": {
                    "contact": '7987747042',
                    "email":   'ss@ss.com',
                },
                "theme": {
                    "color": "#415B34"
                }
            };
        var rzp1 = new Razorpay(options);
        rzp1.open();
        e.preventDefault();
        });
    </script>
</body>
</html>