<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyPromptRequest;
use App\Http\Requests\StorePromptRequest;
use App\Http\Requests\UpdatePromptRequest;
use App\Models\Category;
use App\Models\ChatBot;
use App\Models\Prompt;
use App\Models\Question;
use App\Models\Engine;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


class PromptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.prompts.index');
    }


    public function list(Request $request)
    {
        $columns = array(
            0 => '',
            1 => 'id',
            2 => 'status',
            3 => 'type',
            4 => 'title',
            5 => 'max_tokens',
            6 => 'category_title',
            7 => 'questions',
            8 => 'options',
        );
        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $start = $request->input('start');
        $search = $request->input('search.value');

        $query = Prompt::select('prompts.*', 'categories.title as category_title')
            ->with(['category', 'questions'])
            ->join('categories', 'categories.id', '=', 'prompts.category_id')
            ->where('prompts.created_by', User::STATIC_ADMIN_DATABASE_ID);

        if ($order == 'category_title') {
            $order = "categories.title->en";
        }

        if ($order == 'title') {
            $order = "prompts.title->en";
        }

        $totalData = $query->count();
        $totalFiltered = $query->keywords($search)->count();
        $prompts = $query
            ->keywords($search)
            ->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)
            ->get();

        $data = array();
        if (!empty($prompts)) {
            foreach ($prompts as $prompt) {
                $questions = '';
                foreach ($prompt->questions as $item) {
                    $questions .= '    <span class="badge badge-info">' . $item->question . ' </span>';
                }
                $nestedData[''] = '';
                $nestedData['DT_RowId'] = $prompt->id;
                $nestedData['id'] = $prompt->id;
                $nestedData['title'] = $prompt->title ?? '';
                $nestedData['status'] = $prompt->status ?? '';
                $nestedData['type'] = Prompt::TYPE_SELECT[$prompt->type] ?? '';
                $nestedData['max_tokens'] = $prompt->max_tokens ?? '';
                $nestedData['category_title'] = $prompt->category->title ?? '';
                $nestedData['questions'] = $questions;
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
        $categories = Category::pluck('title', 'id')->prepend(trans('Please Select'), '');
        $engines = Engine::pluck('title', 'id')->prepend(trans('Please Select'), '');
        $chatBots = ChatBot::pluck('title', 'id')->prepend(trans('Please Select'), '');

        $questions = Question::pluck('question', 'id');
        return view('admin.prompts.create', compact('categories', 'questions', 'engines', 'chatBots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePromptRequest $request)
    {
        $prompt = Prompt::create($request->validated() + ['created_by' => auth()->user()->id]);

        $ids = json_decode($request->input('prompt_questions'), true);
        $prompt->questions()->sync($ids);
        foreach ($ids as $k => $id) {
            $prompt->questions()->updateExistingPivot($id, ['order' => $k]);
        };
        Session::flash('success', trans('translation.prompt_added_successfully'));
        return redirect(route('prompts.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Prompt $prompt)
    {
        $prompt->load('category', 'questions', 'promptContents', 'engine');
        return view('admin.prompts.show', compact('prompt'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prompt $prompt)
    {
        $categories = Category::pluck('title', 'id')->prepend(('Please Select'), '');
        $engines = Engine::pluck('title', 'id')->prepend(('Please Select'), '');
        $questions = Question::pluck('question', 'id');
        $chatBots = ChatBot::pluck('title', 'id')->prepend(('Please Select'), '');
        $prompt->load('category', 'questions', 'engine');

        return view('admin.prompts.edit', compact('categories', 'engines', 'prompt', 'questions', 'chatBots'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePromptRequest $request, Prompt $prompt)
    {
        $prompt->update($request->validated());
        $ids = json_decode($request->input('prompt_questions'), true);
        $prompt->questions()->sync($ids);
        foreach ($ids as $k => $id) {
            $prompt->questions()->updateExistingPivot($id, ['order' => $k]);
        };
        Session::flash('success', trans('translation.prompt_updated_successfully'));
        return redirect(route('prompts.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prompt $prompt)
    {
        $prompt->delete();
        Session::flash('success', trans('translation.prompt_deleted_successfully'));
        return back();
    }

    public function massDestroy(MassDestroyPromptRequest $request)
    {
        Prompt::whereIn('id', request('ids'))->each(function ($prompt) {
            $prompt->delete();
        });
        Session::flash('success', trans('translation.multiple_deletion_successful'));
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
