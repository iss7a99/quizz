<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = [
        'body',
        'isCorrect',
        'question_id'
    ];
    /**
	* these choices belongs to question
    */
    public function question()
    {
    	return $this->belongsTo(Question::class);
    }

    /**
	* isCorrect function to check if the choice is correct
	* @param $choicedId - the choice was selected by the user
	* @return boolean
    */
    public function isCorrect($choicedId) {
    	
    	// checking if the answer is correct
    	if (! $this->find($choicedId)->isCorrect) {
    		return false;
    	}

    	return true;
    }
}
