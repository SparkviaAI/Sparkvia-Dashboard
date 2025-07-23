@extends('layouts.admin.app')
@section('content')
    <section class="dasboard-all pages height100vh pt-4 pb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="content-dasboard">
                        <p class="dash-heading">{{ trans('translation.dashboard') }}</p>
                        <p class="dash-date">{{ $dateRange  }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="content">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="small-box">
                                    <div class="inner">
                                        <h3>{{ $monthlyCustomersCount }}</h3>
                                        <p>{{ trans('translation.new_customers') }}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                    <a href="{{ route('users.index') }}" class="small-box-footer">{{ trans('translation.more_info') }} <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card shadow-sm custom-card-das">
                                    <div class="card-header no-border">
                                        <h3 class="card-title">{{ trans('translation.customers') }}</h3>
                                        <div class="card-tools">
                                            <a href="{{ route('users.index') }}" class="btn btn-tool btn-sm"><i class="fas fa-bars"></i> </a>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped table-valign-middle all-table">
                                            <thead>
                                            <tr>
                                                <th>{{ trans('translation.name') }}</th>
                                                <th>{{ trans('translation.email') }}</th>
                                                <th>{{ trans('translation.created_at') }}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->created_at->format('d F - h:i A') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection('content')