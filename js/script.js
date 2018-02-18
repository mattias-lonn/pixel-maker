let height, width, bgcolor;
	 

$("#makeGrid").on("click", function(){
let cells,link, linka;
	height = $( "#inputHeight" ).val();
	width = $( "#inputWeight" ).val();

	
	$("#pixelCanvas").html("");

      for(let i = 0 ; i < width; i++){
      cells = cells + "\n	<td id=\"t" + i + "\"></td>";
      }
      for(let x = 0 ; x < height ; x++){
        $("#pixelCanvas").append("\n<tr id=\"r" + x + "\" class=\"row\">\n\n</tr>");
        $(".row").html(cells);
      }
	console.log(link);
});


$("table").on("click", "td", function() {
  bgcolor = $("#colorPicker").val();
   $(this).css("background-color", bgcolor);
 });

// $( "#pixelCanvas" ).html( data );


$("#export").click(function(){
    var toPost = $("#pixelCanvas").html();
	$.post("pixellab.php",
    {
        html: toPost
    },
    function(data, status){
       $("#imagefile").html(data);
    });
}); 

