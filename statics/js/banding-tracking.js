/*input.on("blur keyup", function () {
     if ($(this).val().length <= 0) {
         $(this).css("background", "#FFCCCC");
         console.log(this);
         missing_require = true;
     } else {
         $(this).css("background", "");
     }
});*/

// Check if any require field is empty
$("form").on("submit", function (event) {
   event.preventDefault();
   var missing_require = false;
   var input = $(".mandatory");
   console.log(input);
   
   for (var i = 0; i < input.length; i++) {
        if ($(input[i]).val().length <= 0) {
            $(input[i]).css("background", "#FFCCCC");
            missing_require = true;
        } else {
            $(this).css("background", "");
        }
    }
   
    if (!missing_require) {
        this.submit();
        console.log("Yes papa!");
    }
    else {
        console.log("Damned !")
    }
});