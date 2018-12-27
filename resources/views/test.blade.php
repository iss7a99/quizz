<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<script>
		document.addEventListener('DOMContentLoaded', function () {
		var data = ('{!! $quest !!}');

		var data = JSON.parse(data);
		//document.getElementById('getBtn').addEventListener('click', qSetter);
		qSetter();
		function qSetter() {
			var c1 = document.getElementById('choice-1'),
				c2 = document.getElementById('choice-2'),
				c3 = document.getElementById('choice-3'),
				c4 = document.getElementById('choice-4'),
				questTitle = document.getElementById('quest-title');

			questTitle.innerHTML = data.body;
			var output = '';
			for (var i = 0; i < data.choices.length; i++) {
				output += '<label for="choice-'+data.choices[i].id+'"><input '+ 
				'type="radio" name="choice"'+
				'id="'+ data.choices[i].id +'" class="radio-choice"'+
				 'onclick="setChoice(this)"/>'+ 
				'<span>' + data.choices[i].body + '</span>' +
				'</label>';
			}
			document.getElementById('choices').innerHTML = output;
		}
		});
	</script>
</head>
<body>
	<div class="container">
		<button id="getBtn">Get question</button>
		<h3 id="quest-title"></h3>
		<div id="choices"></div>
	</div>
</body>
</html>

{{-- 
					
	<label for="choice-{{ $choice->id }}" 
	class="label-choice rounded mb-2 bg-white  p-3 w-100">
	<input type="radio"  name="choice" 
	id="choice-{{ $choice->id }}" value="{{ $choice->id }}" 
	class="radio-choice" onclick="setChoice(this)"/>
	<span>{{ $choice->body }}</span>
	</label>
 --}}