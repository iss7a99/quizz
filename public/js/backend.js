/**
* this is the file will interact with ajax request
*/
/*
* this function will prepare the values to the backSend function
* @param selected is the selected id from the user
* split the id to get the real id
* question id
*/
var currentQuestion = '';
function backToSend(selected) {
	// get the real id of the choice
	var choicedId = selected.split('-')[1];
	
	// Get id of the current question
	var questId = document.getElementById('quest-id').value;

	// run the backSend function to do ajax request to the controller
	backSend(questId, choicedId);
}

/**
* backSend function 
* @param questionid 
* @param choiced id
* this function sends request to the controller
*/

function backSend(questId, choicedId) {
	// declare xr var to restore the XMLHttpRequest() object
	var xr = new XMLHttpRequest();
	// get token value from meta tag
	var token = getByAttr('meta', 'name', '_token');
	// tide the url :)
	urlToSend = urlRouter + '/' + questId + '/' + choicedId;
	/**
	* set parameter for post...
	*/
	var param = {
		questId: questId,
		choicedId: choicedId
	};
	// open the file or do the request
	xr.open('POST', urlToSend, true);
	/**
	* set headers
	*/
	// set content type
	//xr.setRequestHeader('Content-type', 'application/json');
	// set the value of csrf token
	xr.setRequestHeader('X-CSRF-TOKEN', token);
	// onready state change meaning....
	xr.onreadystatechange = function () {
		//console.log(xr);
		if (this.readyState == 4 && this.status == 200) {
			var res = JSON.parse(this.responseText);

			if (res.erorr) {
				return responseChoice(null);
			}

			if (! res.error && !res.choicedId) {
				return responseChoice(false);
			}

			return responseChoice(true);
		}
	};

	// send the request at the end
	xr.send();

	currentQuestion = questId;
	
}

/**
* responseChoice function will check the result and output it
*/
function responseChoice(status) {
	var ResultAlert = document.getElementById('result-alert'),
		refresh = document.getElementById('refresh');
	if (status == null) {
		ResultAlert.innerHTML = 'Error happened';
		ResultAlert.classList.add('alert-danger');
	}

	if (! status) {
		ResultAlert.innerHTML = 'the answer is incorrect! choose another one';
		ResultAlert.classList.add('alert', 'alert-danger');
	}
	if (status == true) {
		ResultAlert.innerHTML = 'Congratulation! your answer is correct';
		ResultAlert.classList.add('alert','alert-success');
		ResultAlert.classList.remove('alert-danger');
		refresh.classList.add('alert', 'alert-primary');
		refresh.innerHTML = '<a href="' + urlRouter + '">'+ 
		'Click to get the next question <i class="fas fa-sync-alt text-primary"></i></a>';
	}

	setTimeout(function () {
		ResultAlert.innerHTML = '';
		ResultAlert.classList.remove('alert', 'alert-success', 'alert-danger');
		refresh.classList.remove('alert', 'alert-primary');
		refresh.innerHTML = '';
		if (! status || status) {
			// run change question function
			//changeQuestion(status);
		}
		if (status == true) {
			window.location.reload();
		}
	}, 5000);
}


/**
* change question function
*/

function changeQuestion(status)
{
	// check if the answer is incorrect or there is an error
	if (status == null || ! status) {
		return;
	}
	var url = urlChanger;
	console.log('this function ran' + urlChanger);
	// request ajax with jquery

	xhr = new XMLHttpRequest();
	
	xhr.open('POST', url, true);
	xhr.setRequestHeader('X-CSRF-TOKEN', changerToken);
	xhr.onreadystatechange = function () {
		if (this.readyState == 4 && this.status == 200) {
			var newQuest = JSON.parse(this.responseText);
			console.log(newQuest);
		}
	};

	xhr.onerror = function () {
		console.log('Error');
	};

	// send
	xhr.send();
}