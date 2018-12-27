<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
	* this model has many choices
    */
    public function choices()
    {
    	return $this->hasMany(Choice::class);
    }

    /**
    * isHas() function
	* this function checks if the question icluded this choice
	* @param $questId - id of the question 
	* @param $choicedId - the id of choice that selected from the user
	* @return boolean
    */

    public  function isHas($questId, $choicedId)
    {
    	// current question
    	$currentQuest = $this->with('choices')->find($questId);

    	// check if the quest has this choice
    	if ($currentQuest->choices->isEmpty()) {
    		return false;
    	}
    	// check if the choices table contains this choice
    	if (! $currentQuest->choices->contains($choicedId)) {
    		return false;
    	}

    	return true;
    }
}
