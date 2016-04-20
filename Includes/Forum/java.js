
	function add_tags(teg1, teg2)
	{
		var el = document.getElementById("message");
		el.focus();
		if (el.selectionStart == null)
		{
			var rng = document.selection.createRange();
			rng.text = teg1+rng.text+teg2;
		}
		else
		{
			el.value = el.value.substring(0,el.selectionStart)+teg1+el.value.substring(el.selectionStart,el.selectionEnd)+teg2+el.value.substring(el.selectionEnd);
		}
	}
    
	function show_smiles()
	{
		if(document.getElementById('smiles').style.display == "none")
			document.getElementById('smiles').style.display = "";
		else document.getElementById('smiles').style.display = "none";
	}
    
	function add_smiles(smile)
	{
		var str = smile;
		var col = smile.length - 4;
		var el = document.getElementById("message");
		str = str.substring(0, col);
		el.value += ":" + str + ":";
	}
    
 
function check_pass(pass1,pass2)
{
	if(pass1 == pass2)
	{
		document.getElementById("check").innerHTML = "&nbsp;&nbsp;<font color=green>Пароли совпадают...</font>";
		pass = true;
	}
	else
	{
		document.getElementById("check").innerHTML = "<font color=red>Пароли не совпадают!</font>";
		pass = false;
	}
}

function mess_focus(mess)
{
    var mess = document.getElementById("message");
		mess.focus();
}

function write_mess_to(user)
{
   var el = document.getElementById("message");
		el.focus();
			el.value = "[b][span style='color:blue']"+user+"[/b][/span],";

}
function add_quote(user,sms)
{
    var el = document.getElementById("message");
		el.focus();
			el.value = "[quote user=" + user + "]" + sms + "[/quote]";
}

function add_answer(id)
{
    document.getElementById("add_answer_"+id).style.display = "block";
    
    var id_ = id - 1;
    document.getElementById(id_).style.display = "none";
}
function delete_answer(id)
{

    document.forms["add"].elements["answer"+id].value = "";
    document.getElementById("add_answer_"+id).style.display = "none";
     
    var id_ = id - 1;
    document.getElementById(id_).style.display = "block";
   
}