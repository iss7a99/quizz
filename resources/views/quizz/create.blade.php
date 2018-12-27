@extends ('templates.layout')
@section ('content')
	<div class="add-quest p-3 text-white" style="font-weight: 900">
		<h1 class="display-4 text-center">Create new quiz</h1>
		@if ($errors->count() > 0)
			<div class="alert alert-danger">
				<ul class="list-group">
					@foreach ($errors->all() as $error)
						<li class="list-group-item">{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<div id="alert-area"></div>
		@if (Session('info'))
			<div class="alert alert-info">{{ Session('info') }}</div>
		@endif
		<form action="{{ route('quizz.store') }}" method="POST">
			@csrf
			<div class="row">
				<div class="col-12">
					<label for="question">Put the question</label>
					<input type="text" name="question" id="question" class="form-control" required>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="first-choice">first choice *</label>
						<input type="text" name="first-choice" id="first-choice" class="form-control" required>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="second-choice">Second choice *</label>
						<input type="text" name="second-choice" id="second-choice" class="form-control" required>
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="third-choice">Third choice</label>
						<input type="text" name="third-choice" id="third-choice" class="form-control">
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="fourth-choice">Fourth choice</label>
						<input type="text" name="fourth-choice" id="fourth-choice" class="form-control">
					</div>
				</div>
				<div class="col-12">
					<div class="form-group" id="choices-container" style="display: none">
						<label for="select-correct">Select the correct answer</label>
						<select class="custom-control custom-select" name="choices">
							<option id="choice-0">
								-- Please choose the correct answer--
							</option>
							<option value="1" id="choice-1">First</option>
							<option value="2" id="choice-2">Second</option>
							<option value="3" id="choice-3">Third</option>
							<option value="4" id="choice-4">Fourth</option>
						</select>
				</div>
				</div>
			</div><!-- End Row -->
			<div class="form-group">
				<input type="submit" value="Click to create question"  class="btn btn-light"/>
			</div>
		</form>
	</div>
	<script>
		var firstChoice = document.getElementById('first-choice'),
			secondChoice = document.getElementById('second-choice'),
			thirdChoice = document.getElementById('third-choice'),
			fourthChoice = document.getElementById('fourth-choice'),
			third = false,
			fourth = false;

		secondChoice.addEventListener('blur', giveChoice);
		thirdChoice.addEventListener('blur', giveChoice);
		fourthChoice.addEventListener('blur', giveChoice);
		// on second choice written we have to give the user choices
		function giveChoice(e) {
			var alertArea = document.getElementById('alert-area');	
			if (e.target.value == '' || firstChoice.value == '') {
				alertArea.innerHTML = 'Enter two choices at least!';
				alertArea.classList.add('alert', 'alert-danger');

				return;
			}

			

			var choicesContainer = document.getElementById('choices-container'),
				choice1 = document.getElementById('choice-1'),
				choice2 = document.getElementById('choice-2'),
				choice3 = document.getElementById('choice-3'),
				choice4 = document.getElementById('choice-4');

			choice1.textContent = firstChoice.value;
			choice2.textContent = secondChoice.value;

			if (thirdChoice.value != '') {
				choice3.textContent = thirdChoice.value;
			}
			if (fourthChoice.value != '') {
				choice4.textContent = fourthChoice.value;
			}
			choicesContainer.style.display = 'block';

		}
	</script>
@endsection