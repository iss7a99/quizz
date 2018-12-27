<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Choice;
class QuizzController extends Controller
{
    public function index()
    {
    	$question = Question::with('choices')->inRandomOrder()->first();
    	return view('quizz.index')->with('quest', $question)->with('notPartial', false);
    }

    /**
    * create new question 
    * @return response view
    */
    public function create()
    {
    	return view('quizz.create')->with('notPartial', true)->with('id', 1);
    }

    /**
	* define choice checker function
    */
    public function choiceChecker($questId, $choicedId, Request $request)
    {
    	// define objects
    	$choice = new Choice;
    	$question = new Question;
    	// define the value to be returned (responses)
    	// if the is Error
    	$error = collect(['error' => true])->toJson();
    	// is the answer is not correct
    	$isNot = collect(['error' => false,'choicedId' => false])->toJson();

    	// if every thing is good
    	$success = collect(['error' => false, 'choicedId' => true])->toJson();
    	if (Question::find($questId) == null || Choice::find($choicedId) == null) {
    		return $error;
    	}

    	if (! $question->isHas($questId, $choicedId)) {
    		return $error;
    	}

    	if (! $choice->isCorrect($choicedId)) {
    		return $isNot;
    	}

    	return $success;
    }


    /**
    * store function 
    */

    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|min:3',
            'first-choice' => 'required',
            'second-choice' => 'required',
            'choices' => 'required'
        ]);

        if ($request->input('third-choice') != '' && 
            $request->input('fourth-choice') != '') {
            $length = 4;
        } else if ($request->input('third-choice') != ''
         || $request->input('fourth-choice') != '') {
            $length = 3;
        } else {
            $length = 2;
        }
        //dd($length);
        // create question
        $question = new Question;
        $question->body = $request->input('question');
        $question->save();
        $questionId = $question->id;

        for ($i = 0; $i < $length; $i++) {
            switch ($i) {
                case 0;
                $inputName = 'first-choice';
                $isCorrect = $request->input('choices') == $i + 1 ? true : false;
                $data = ['choice' => $inputName, 'isCorrect' => $isCorrect];
                break;
                case 1;
                $inputName = 'second-choice';
                $isCorrect = $request->input('choices') == $i + 1 ? true : false;
                $data = ['choice' => $inputName, 'isCorrect' => $isCorrect];
                break;
                case 2;
                $inputName = 'third-choice';
                $isCorrect = $request->input('choices') == $i + 1 ? true : false;
                $data = ['choice' => $inputName, 'isCorrect' => $isCorrect];
                break;
                case 3;
                $inputName = 'fourth-choice';
                $isCorrect = $request->input('choices') == $i + 1 ? true : false;
                $data = ['choice' => $inputName, 'isCorrect' => $isCorrect];
                break;
            }

            Choice::create([
                'body' => $request->input($data['choice']),
                'isCorrect' => $data['isCorrect'],
                'question_id' => $questionId
            ]);
        }

        
        return redirect()->back()->with('info', 'your question has been added.');

    }

    /**
    * change function will change the question
    */

    public function change($questId) 
    {
        $newQuest = Question::with('choices')->inRandomOrder()->except(['id' => $questId])->first();

        return response()->json(['en' => 'me']);
    }
}
