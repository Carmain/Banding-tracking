// ---------------- DATE PICKER & DATE FORMAT ---------------- 

function addZeroDate(value) {
    if(value < 10) {
        value = '0' + value;
    }
    return value;
}

$(".datepicker").datepicker({
    format:  "dd-mm-yyyy",
});

var now = new Date();
var day = addZeroDate(now.getDate());
var month = addZeroDate(now.getMonth() + 1);
var year = now.getFullYear();
var today =  day + '-' + month + '-' + year;
$(".datepicker").val(today);

// -----------------------------------------------------------
// -----------------------------------------------------------


// ---------------------- CHECK INPUTS  ----------------------

var input = $(".mandatory");

/**
 * When the user leave an input, we color it if it's empty
 * @param  {events}  One or more space-separated event types and optional namespaces
 * @param  {handler} A function to execute when the event is triggered.
 */
input.on("blur", function () {
     if ($(this).val().length <= 0) {
         $(this).css("background", "#FFCCCC");
     } 
     else {
         $(this).css("background", "");
     }
});

/**
 * Check if any require field is empty when we submit the form
 * @param  {events}  One or more space-separated event types and optional namespaces
 * @param  {handler} A function to execute when the event is triggered.
 */
$("form").on("submit", function (event) {
   event.preventDefault();
   var missing_require = false;
   
   for (var i = 0; i < input.length; i++) {
        if ($(input[i]).val().length <= 0) {
            $(input[i]).css("background", "#FFCCCC");
            missing_require = true;
        } 
        else {
            $(this).css("background", "");
        }
    }
   
    if (!missing_require) {
        this.submit();
    }
    else {
        swal("Erreur dans le formulaire",
             "Un ou plusieurs champs n'ont pas été remplis correctement", "warning");
    }
});