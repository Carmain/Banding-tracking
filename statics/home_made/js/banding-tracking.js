// ---------------- DATE PICKER & DATE FORMAT ---------------- 

function addZeroDate(value) {
    if(value < 10) {
        value = '0' + value;
    }
    return value;
}

function inverseFormat(date) { // to YYYY-mm-dd
    var day = date.substring(0,2);
    var month = date.substring(3,5);
    var year = date.substring(6,10);

    return year + "-" + month + "-" + day;
}

function isDate(date) {
    var regex = /([0-2]\d|3[0-1])-(0\d|1[0-2])-\d{4}/
    return regex.test(date);
}

$(".datepicker").datepicker({
    format:  "dd-mm-yyyy"
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
   var missingRequire = false;
   var formDate = new Date(inverseFormat(input[2].value));

   if (!isDate(input[2].value) || formDate > new Date()) {
        swal("Erreur dans le formulaire",
             "La date saisie n'est pas conforme ou dépasse celle d'ajourd'hui", 
             "warning");
   }
   else {
        for (var i = 0; i < input.length; i++) {
            if ($(input[i]).val().length <= 0) {
                $(input[i]).css("background", "#FFCCCC");
                missingRequire = true;
            } 
            else {
                $(this).css("background", "");
            }
        }
       
        if (!missingRequire) {
            this.submit();
        }
        else {
            swal("Erreur dans le formulaire",
                 "Un ou plusieurs champs n'ont pas été remplis correctement", "warning");
        }
   }
});