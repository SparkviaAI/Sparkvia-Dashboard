@extends('layouts.admin.app')
@section('content')


<section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="category-top">
                        <a class="btn btn-default Add-Category"  href="{{ route('users.index') }}">
                        {{ trans('translation.back_to_list') }}
                    </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">{{ trans('translation.show_user') }}</h1>
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
                                                {{ $user->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                            {{ trans('translation.name') }}
                                            </th>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                            {{ trans('translation.user_name') }}
                                            </th>
                                            <td>
                                                {{ $user->username }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                            {{ trans('translation.discord_id') }}
                                            </th>
                                            <td>
                                                {{ $user->discord_id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                            {{ trans('translation.email') }}
                                            </th>
                                            <td>
                                                {{ $user->email }}
                                            </td>
                                        </tr>
                                        <!-- <tr>
                                            <th>
                                                {{ trans('cruds.user.fields.email_verified_at') }}
                                            </th>
                                            <td>
                                                {{ $user->email_verified_at }}
                                            </td>
                                        </tr> -->
                                        <tr>
                                            <th>
                                            {{ trans('translation.roles') }}
                                            </th>
                                            <td>
                                                <span class="badge badge-info">{{ $user->roles[0]['name'] }}</span>
                                                <!-- @foreach($user->roles as $key => $roles)
                                                    <span class="label label-info">{{ $roles->title }}</span>
                                                @endforeach -->
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

@endsection('content')

