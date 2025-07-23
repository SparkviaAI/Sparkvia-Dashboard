<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

use App\Http\Requests\MassDestroyCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Imports\PromptsImport;
use App\Jobs\CleanUnusedQuestions;
use App\Models\Prompt;
use App\Models\Question;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');
    }


    public function list(Request $request)
    {
        $columns = array(
            0 => '',
            1 => 'id',
            2 => 'status',
            3 => 'title',
            4 => 'options',
        );

        $limit = $request->input('length');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $start = $request->input('start');
        if ($order == 'title') {
            $order = "title->en";
        }
        $totalData = Category::count();
        $totalFiltered = Category::keywords($search)->count();
        $categories = Category::keywords($search)
            ->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)
            ->get();

        $data = array();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $nestedData[''] = '';
                $nestedData['DT_RowId'] = $category->id;
                $nestedData['id'] = $category->id;
                $nestedData['status'] = $category->status ?? '';
                $nestedData['title'] = $category->title ?? '';
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
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated() + ['created_by' => auth()->user()->id]);
        Session::flash('success', trans('translation.category_added_successfully'));
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        Session::flash('success', trans('translation.category_updated_successfully'));
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        Session::flash('success', trans('translation.category_deleted_successfully'));
        return back();
    }


    public function massDestroy(MassDestroyCategoryRequest $request)
    {
        Category::whereIn('id', request('ids'))->each(function ($category) {
            $category->delete();
        });
        Session::flash('success', trans('translation.multiple_deletion_successful'));
        return response(null, Response::HTTP_NO_CONTENT);
    }
    
}
