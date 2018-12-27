// get dom variables
var selected = null,
	// submitting question btn sub-quest
	subQuest = document.getElementById('sub-quest'),
	noData = false,
	// var to make sure whether it was  checked before
	wasChecked = null;
	// add EventListener to the button
	subQuest.addEventListener('click', sendRequest);
//var quest_label = document.querySelector('.radio-choice');

// add event on click label
//quest_label.addEventListener('click', setChoice);

/**
* create setChoice function
* change the specific label to selected
*/
function setChoice(x) {
	x.parentNode.classList.toggle('choiced-radio');

	// check if selected to unset the selected 
	if (wasCheckedFunc(x)) {
		return;
	}
	// get label choice class
	let allByClass = document.getElementsByClassName('label-choice');

	for (var i = 0; i < allByClass.length; i++) {

		// if its not the current label or input
		if (allByClass[i].firstElementChild.id !== x.id) {
			// if the label contains class choiced-radio
			if (allByClass[i].classList.contains('choiced-radio')) {
				// remove non-current classes
				allByClass[i].classList.remove('choiced-radio');
			}
		}
	}
	// set the value of the selected input
	selected = x.id;
	wasChecked = true;
}
/**
* define sendRequest() function 
*/

function sendRequest() {
	// check if the choice selected
	if (selected == null) {
		// set no data to true
		noData = true;
		// run checker function to alert user to select choice
		checker();

		return;
	}

	// Right now there in now error, run sendRequestNow function
	backToSend(selected);
}
/**
* define checker function
*/
function checker() {
	if (noData) {
		alert('Select choice');
	}
}

/**
* wasChecked function
*/

function wasCheckedFunc(x) {
	if (!wasChecked || x.id !== selected) {
		return false;
	}

	// uncheck the input
	x.checked = false;
	// set wasChecked variable to false
	wasChecked = false;
	// set selected to null
	selected = null;
	return true;
}

/**
* getByAttr function will return value of content attribute of such tag
* @param tage  - name of tag which we want to find its content attr's value
* @param attr  - the attribute we do check of its value
* @param value - the value we do check with
*/

function getByAttr(tag, cAttr, value) {
	var element = document.getElementsByTagName(tag);
	var result = null;
	for (var i = 0; i < element.length; i = i + 1) {
		if (element[i].getAttribute(cAttr) == value) {
			result = element[i].content;
			break;
		}
	}
	return result;
}

/**
* add footer-hider to to footer class function
*/

document.getElementById('hider-button').onclick =  function () {
	var footer = document.querySelector('.footer-container'),
		panelToggler = document.getElementById('panel-toggler');
	footer.classList.toggle('hider');
	panelToggler.classList.remove('hider');

};

document.getElementById('panel-toggler').onclick = function () {
	document.querySelector('.footer-container').classList.toggle('hider');
	this.classList.toggle('hider');
};