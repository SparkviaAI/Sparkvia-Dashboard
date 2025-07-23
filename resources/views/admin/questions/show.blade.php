@extends('layouts.admin.app')
@section('content')

    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="category-top">
                        <a class="btn btn-default Add-Category" style="background-color: #a05aff !important;" href="{{ route('questions.index') }}">
                        {{ trans('translation.back_to_list') }}
                    </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.show_question') }}</h1>
                        <!-- NEW TABLE STARTS -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>
                                            {{ trans('translation.ID') }}
                                            </th>
                                            <td>
                                                {{ $question->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('translation.question') }}
                                            </th>
                                            <td>
                                                {{ $question->question }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('translation.type') }}
                                            </th>
                                            <td>
                                                {{ App\Models\Question::TYPE_SELECT[$question->type] ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('translation.is_required') }}
                                            </th>
                                            <td>
                                                {{ App\Models\Question::IS_REQUIRED_SELECT[$question->is_required] ?? '' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ trans('translation.minimum_answer_length') }}
                                            </th>
                                            <td>
                                                {{ $question->minimum_answer_length }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- NEW TABLE ENDS -->
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- <div class="card">
        <div class="card-header">
            Show Question
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('questions.index') }}">
                        Back to List
                    </a>
                </div>
                
            </div>
        </div>
    </div> -->
@endsection('content')