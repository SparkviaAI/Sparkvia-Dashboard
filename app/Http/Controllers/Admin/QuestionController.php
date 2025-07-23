<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;



class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.questions.index');
    }


    public function list(Request $request)
    {
        $columns = array(
            0 => '',
            1 => 'id',
            2 => 'question',
            3 => 'type',
            4 => 'is_required',
            5 => 'minimum_answer_length',
            6 => 'options',
        );


        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $start = $request->input('start');

        $totalData = Question::count();
        $totalFiltered = Question::keywords($search)->count();
        $questions = Question::keywords($search)
            ->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)
            ->get();

        $data = array();
        if (!empty($questions)) {
            foreach ($questions as $question) {
                $nestedData[''] = '';
                $nestedData['DT_RowId'] = $question->id;
                $nestedData['id'] = $question->id;
                $nestedData['question'] = $question->question ?? '';
                $nestedData['type'] = Question::TYPE_SELECT[$question->type] ?? '';
                $nestedData['is_required'] = Question::IS_REQUIRED_SELECT[$question->is_required] ?? '';
                $nestedData['minimum_answer_length'] = $question->minimum_answer_length ?? '';
                $nestedData['options'] = '';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        Question::create($request->validated() + ['created_by' => auth()->user()->id]);
        Session::flash('success', trans('translation.question_added_successfully'));
        return redirect(route('questions.index'));
    }

    public function newQuestion(StoreQuestionRequest $request)
    {
        $question = Question::create($request->validated() + ['created_by' => auth()->user()->id]);
        $questions = Question::pluck('question', 'id');
        // Session::flash('success', "New Question added successfully.");
        return response([
            'message' => __('global.new_question_success'),
            'question' => [$question->id, $question->question],
            'questions' => $questions
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        return view('admin.questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', compact('question'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update($request->all());
        Session::flash('success', trans('translation.question_updated_successfully'));
        return redirect(route('questions.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        Session::flash('success', trans('translation.question_deleted_successfully'));
        return back();
    }


    public function massDestroy(MassDestroyQuestionRequest $request)
    {
        Question::whereIn('id', request('ids'))->delete();
        Session::flash('success', trans('translation.multiple_deletion_successful'));
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
