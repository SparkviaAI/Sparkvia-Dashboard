@extends('layouts.admin.app')
@section('content')
    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">Theme List</h1>
                        <!-- NEW TABLE STARTS -->
                        <div class="card-body" id="theme-row">
                            <div class="table-responsive">
                                <table class=" table table-bordered table-striped table-hover datatable datatable-theme">
                                    <thead>
                                    <tr>
                                        <th style="width:35%">
                                            Title
                                        </th>
                                        <th style="width:30%">Mode</th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($themes as $key => $theme)
                                        <tr data-entry-id="{{ $theme->id }}">
                                            <td>
                                                {{ $theme->panel ?? '' }}
                                            </td>
                                            <td>
                                                        <div class="form-group">
                                                            <select class="form-control select2" name="setting[theme_mode]" id="setting_theme_mode_{{$theme->id}}">
                                                                <option disabled>
                                                                    Select Theme
                                                                </option>
                                                                <option
                                                                    value="light" {{ ($theme->theme) == 'light' ? 'selected' : '' }}>
                                                                        light
                                                                </option>
                                                                <option
                                                                    value="dark" {{ ($theme->theme) == 'dark' ? 'selected' : '' }}> 
                                                                        dark
                                                                </option>
                                                            </select>
                                                        </div>
                                            </td>
                                            <td>
                                                <a class="btn btn-xs btn-success" onclick="activateTheme({{$theme->id}})">
                                                    Activate
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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

    <!-- @include('admin.settings.cards.default-colors') -->

    <script src="{{ asset('admin-js/loadingoverlay/loadingoverlay.min.js') }}"></script>
    
    <script src="{{ asset('new-js/js/themes.js') }}"></script>

    <script>
        function activateTheme(id){
            var themeId = id;
            var selectedTheme = document.getElementById('setting_theme_mode_'+id).value;
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
            });
            $.ajax({
                url: "{{ route('themes.activate.new') }}",
                datatype: 'json',
                method: 'post',
                data: {
                    themeId: themeId,
                    selectedTheme: selectedTheme,
                },
                success: function(data) {
                    // console.log(data);
                    if ((data.status) == 'success') {
                        toastr.success(data.message);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {}
            });
        }
    </script>

@endsection('content')
