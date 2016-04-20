$(function() {
	$( "#datepicker" ).datepicker( $.datepicker.regional[ "ru" ] );
	$( "#datepicker" ).datepicker({ dateFormat: "yy-mm-dd", });
  });

var i = 0;
var answer = 0;
$("#question_add_click").click(function() {
	i++;
	$("<center><h3>Вопрос № "+ i +"</h3><table id='myTable"+i+"' border='1' style='width:80%'><thead><tr><th colspan='2'>Вопрос</th></tr></thead><tbody>" +
	  		"<tr>" +
	  			"<td colspan='2' class='light bold'>" +
	  				"<textarea name='title_content[]' id='title_content"+i+"' cols='45' rows='5'></textarea>" +
	  			"</td>" +
			"</tr>" +
			"</tbody>" +
	  		"<thead><tr><th colspan='2'>Варианты ответов</th></tr></thead><tbody>" +
	  		"<tr>" +
	  			"<td>" + 
	  					"<input style='width:300px;' type='text' name='answer["+i+"][]'>" +
	  			"</td>" +
	  			"<td width='50px;' >" +

	  				"<input type='checkbox' style='height:20px;' name='correct_answer[]' value='1'>" +
	  			"</td>" +
	  		"</tr>" +
	  		"<tr>" +
  			"<td>" + 
  					"<input style='width:300px;' type='text' name='answer["+i+"][]'>" +
  			"</td>" +
  			"<td width='50px;' >" +
  				"<input type='checkbox' style='height:20px;' name='correct_answer[]' value='1'>" +
  			"</td>" +
  		"</tr>" +
  		
	  		"<tr>" +
			
	  		"<input type='hidden' name='question_number[]' value='"+i+"'>" +	

	  			"<td colspan='2'>" +
	  				"<a class='orange' onclick='addAnswer("+i+")' style='cursor:pointer'><span class=' icon-plus-sign'></span> Добавить вариант</a>" +
	  			"</td>" +
	  		"</tr>" +
	  		"</table></center><hr>").fadeIn('slow').appendTo('#question_add');
	
CKEDITOR.replace( 'title_content'+i, {
			toolbar :
	[
	{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
	{ name: 'insert', items : [ 'Image','Flash'] },
	{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
	{ name: 'tools', items : [ 'Maximize','-'] }],
					height: '100px',
					width: '100%'
				});
  
});

function addAnswer(i) {
	answer ++;
	$('#myTable' + i + ' tr:last').before("<tr><td>" + 
			"<input style='width:300px;' type='text' name='answer["+i+"][]'>" +
			"</td>" +
			"<td width='50px;' >" +

				"<input type='checkbox' style='height:20px;' name='correct_answer[]' value='1'>" +
			"</td>" +
		"</tr>");
}
$("#test_form").submit(function(){
    $("input[name='correct_answer[]']:not(:checked)").attr("checked","checked").val("off");  
  });
