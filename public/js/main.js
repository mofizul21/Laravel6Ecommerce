//Checkout form
$("#payments").change(function() {
    $payment_method = $("#payments").val();
    if ($payment_method == "cash_in") {
        $("#payment_cash_in").removeClass("hidden");
        $("#payment_bkash").addClass("hidden");
        $("#payment_rocket").addClass("hidden");
        $("#transaction_id").addClass("hidden");
    } else if ($payment_method == "bkash") {
        $("#payment_bkash").removeClass("hidden");
        $("#transaction_id").removeClass("hidden");
        $("#payment_cash_in").addClass("hidden");
        $("#payment_rocket").addClass("hidden");
    } else if ($payment_method == "rocket") {
        $("#payment_rocket").removeClass("hidden");
        $("#transaction_id").removeClass("hidden");
        $("#payment_bkash").addClass("hidden");
        $("#payment_cash_in").addClass("hidden");
    }
});

// Display districts after selecting division, registratin form
$("#division_id").change(function() {
    var division = $("#division_id").val();
    
    $("#district_area").html("");
    var option = "";
    
    $.get(url + "/get-districts/" + division, function(data) { // var url defined in /layouts/master.blade.php
        data = JSON.parse(data);
        data.forEach(function(element) {
            option +=
                "<option value='" +
                element.id +
                "'>" +
                element.name +
                "</option>";
        });
        $("#district_area").html(option);
    });
});

// Click to add to cart
// also added a line in /layouts/master.blade.php
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
});

function addToCart(product_id){
    $.post(url + "/carts/store", {
        // var url defined in /layouts/master.blade.php
        product_id: product_id // product_id came from CartsController.php → store()
    }).done(function(data) {
        data = JSON.parse(data);
        if (data.status == "success") {
            alertify.set("notifier", "position", "top-center"); // top-left, bottom-right
            alertify.success(
                "Item added to cart successfully! Total items: " +
                    data.totalItems +
                    " To checkout <br> <a href='./carts'>Go to Carts</a>"
            );
            $("#totalItems").html(data.totalItems); // #totalItems came from nav.blade.php and data.totalItems came from CartsController.php
        }
    });

}