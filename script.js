$(document).ready(function() {
						   
  $("p").click(function() {
    $(this).css("background-color","red");
  });

$("p").mouseenter(function() {
$(this).css("background-color", "red");
$(this).css("font-size", "35");

});

$("p").mouseleave(function() {
$(this).css("background-color", "E4E4E4");
$(this).css("font-size", "20");

});

});