@extends ('templates.layout')
@section ('scripts')
	var urlRouter  = "{{ route('quizz') }}",
		urlChanger = "{{ route('quizz.change', ['questId' => $quest->id]) }}",
		changerToken = '{{ Session::token() }}';
		
@endsection
@section('content')
<div class="quest mx-auto" style="width: calc(100%)">
	<div class="the-quest bg-white rounded p-3 mb-3 shadow-lg">
		<h4 class="quest-title">{{ $quest->body }}</h4>
		<!-- set question id to hidden input -->
		<input type="hidden" id="quest-id" value="{{ $quest->id }}">

	</div>
	<div id="result-alert" class=""></div>
		<div id="refresh"></div>
	<div class="row">
		<!-- Start choice row -->
			<div class="col-12" id="choices">
				@foreach ($quest->choices as $choice)
					<div class="choice">
						<label for="choice-{{ $choice->id }}" 
							class="label-choice rounded mb-2 bg-white  p-3 w-100">
							<input type="radio"  name="choice" 
							id="choice-{{ $choice->id }}" value="{{ $choice->id }}" 
							class="radio-choice" onclick="setChoice(this)"/>
							<span>{{ $choice->body }}</span>
						</label>
					</div>	
				@endforeach
			</div><!-- End col -->
			<div class="w-100"></div>
		<div class="col-12">
			<input type="submit" value="Submit" class="sub-quest btn btn-block btn-outline-warning text-white mb-5" id="sub-quest">
		</div>
		<!--End choice row -->
	</div><!-- End row -->
</div> <!-- End quest -->
@endsection()
	