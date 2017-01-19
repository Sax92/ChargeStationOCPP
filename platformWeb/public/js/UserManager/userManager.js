$(document).ready(function(){
    //menu active
    $("#userManager").addClass("active");  
    
    //numero ricariche
    $.ajax({       
        url     : "getRechargeNumber",
        type    : "post",
        data    : {
        },
        success : function (data){
            $("#numberRecharge").text(data);
        },
        error : function (request, status, error) {
            alert("jQuery AJAX request error:".error);
        }
    });
    
    //ultime ricariche
    $.ajax({       
        url     : "getLastRecharge",
        type    : "post",
        data    : {
        },
        success : function (data){
            $("#lastRecharge tbody").html(data);
        },
        error : function (request, status, error) {
            alert("jQuery AJAX request error:".error);
        }
    });
    
    //stato coupon
    $.ajax({       
        url     : "getCouponState",
        type    : "post",
        data    : {
        },
        success : function (data){
            $("#coupon tbody").html(data);
        },
        error : function (request, status, error) {
            alert("jQuery AJAX request error:".error);
        }
    });
    
    //kw totali ricaricati
    $.ajax({       
        url     : "getTotKW",
        type    : "post",
        data    : {
        },
        success : function (data){
            $("#kwTot").text(data);
        },
        error : function (request, status, error) {
            alert("jQuery AJAX request error:".error);
        }
    });
    
    //tutte le ticariche
    $.ajax({       
        url     : "getAllRecharge",
        type    : "post",
        data    : {
        },
        success : function (data){
            $("#allRecharge tbody").html(data);
        },
        error : function (request, status, error) {
            alert("jQuery AJAX request error:".error);
        }
    });
    
});

//scorrimento a div quickinfo
$("#quickInfo a").click(function() {
    var a = $(this).attr("href");
    $('html, body').animate({
        scrollTop: $(a).offset().top
    }, 2000);
});
