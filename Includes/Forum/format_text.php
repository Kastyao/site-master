	<head>
<script language="javascript" src="java.js"></script>
</head>		<center>	<select onchange="add_tags('[font face=\''+this.value+'\']','[/font]')">
					<option selected style='font-family:arial'>шрифт:</option>
					<option style='font-family:Courier' value="Courier">Courier</option>
					<option style='font-family:Courier New' value="Courier New">Courier New</option>
					<option style='font-family:Monospace' value="Monospace">Monospace</option>
					<option style='font-family:Fixedsys' value="Fixedsys">Fixedsys</option>
					<option style='font-family:Comic Sans MS' value="Comic Sans MS">Comic Sans</option>
					<option style='font-family:Georgia' value="Georgia">Georgia</option>
					<option style='font-family:Tahoma' value="Tahoma">Tahoma</option>
					<option style='font-family:Times New Roman' value="Times New Roman">Times</option>
					<option style='font-family:Serif' value="Serif">Serif</option>
					<option style='font-family:Sans-Serif' value="Sans-Serif">Sans-Serif</option>
					<option style='font-family:Cursive' value="Cursive">Cursive</option>
					<option style='font-family:Fantasy' value="Fantasy">Fantasy</option>
				</select>
				<select onchange="add_tags('[font size='+this.value+']','[/size]')">
					<option selected style='font-family:arial'>размер:</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="14">14</option>
					<option value="16">16</option>
					<option value="20">20</option>
					<option value="22">22</option>
				</select>
				<select onchange="add_tags('[font color='+this.value+']','[/color]')">
					<option style="color: black" value="black" selected="selected">Цвет шрифта:</option>
					<option style="color: darkred; background-color: #ECECEC" value="darkred">&nbsp;Тёмно-красный</option>
					<option style="color: brown; background-color: #ECECEC" value="brown">&nbsp;Коричневый</option>
					<option style="color: #996600; background-color: #ECECEC" value="#996600">&nbsp;Оранжевый</option>
					<option style="color: red; background-color: #ECECEC" value="red">&nbsp;Красный</option>
					<option style="color: #993399; background-color: #ECECEC" value="#993399">&nbsp;Фиолетовый</option>
					<option style="color: green; background-color: #ECECEC" value="green">&nbsp;Зелёный</option>
					<option style="color: darkgreen; background-color: #ECECEC" value="darkgreen">&nbsp;Тёмно-Зелёный</option>

					<option style="color: gray; background-color: #ECECEC" value="gray">&nbsp;Серый</option>
					<option style="color: olive; background-color: #ECECEC" value="olive">&nbsp;Оливковый</option>
					<option style="color: blue; background-color: #ECECEC" value="blue">&nbsp;Синий</option>					
					<option style="color: darkblue; background-color: #ECECEC" value="darkblue">&nbsp;Тёмно-синий</option>
					<option style="color: indigo; background-color: #ECECEC" value="indigo">&nbsp;Индиго</option>
					<option style="color: #006699; background-color: #ECECEC" value="#006699">&nbsp;Тёмно-Голубой</option>					

					<option style="color: cadetblue; background-color: #ECECEC" value="cadetblue" class="genmed">Cadet Blue</option>
					<option style="color: coral; background-color: #ECECEC" value="coral" class="genmed">Coral</option>
					<option style="color: crimson; background-color: #ECECEC" value="crimson" class="genmed">Crimson</option>
					<option style="color: tomato; background-color: #ECECEC" value="tomato" class="genmed">Tomato</option>
					<option style="color: seagreen; background-color: #ECECEC" value="seagreen" class="genmed">Sea Green</option>
					<option style="color: darkorchid; background-color: #ECECEC" value="darkorchid" class="genmed">Dark Orchid</option>

					<option style="color: chocolate; background-color: #ECECEC" value="chocolate" class="genmed">Chocolate</option>
					<option style="color: deepskyblue; background-color: #ECECEC" value="deepskyblue" class="genmed">Deepskyblue</option>
					<option style="color: gold; background-color: #ECECEC" value="gold" class="genmed">Gold</option>
					<option style="color: midnightblue; background-color: #ECECEC" value="midnightblue" class="genmed">Midnightblue</option>
					<option style="color: darkgreen; background-color: #ECECEC" value="darkgreen" class="genmed">DarkGreen</option>															
				</select>
				<input type=button value='B' style='font-weight:bold; width:40' onClick="add_tags('[b]','[/b]')">
				<input type=button value='i' style='font-style:italic; width:40' onClick="add_tags('[i]','[/i]')">
				<input type=button value='u' style='text-decoration:underline; width:40' onClick="add_tags('[u]','[/u]')">
				<input type=button value='IMG' style='width:40' onClick="add_tags('[IMG]','[/IMG]')">
				<input type=button value='URL' style='text-decoration:underline; width:40' onClick="add_tags('[URL=&#34&#34]','[/URL]')">
				<input value='<?php echo($tbl[1]); ?>' style='display:none' name='tbl'>
				<input type=button value='Quote' onClick="add_tags('[quote]','[/quote]')">
				<input type=button value='Smiles' id='sm' onClick='show_smiles()'></center>