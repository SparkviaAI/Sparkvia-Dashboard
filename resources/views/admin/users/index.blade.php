@extends('layouts.admin.app')
@section('content')

<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="category-top">
                    <!-- Optional: Add User Button -->
                    <!-- <a href="{{ route('users.create') }}" class="btn btn-primary Add-Category" style="background-color: #a05aff !important;">Add User</a> -->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-scroll">
                    <h1 class="Category_List">{{ trans('translation.users_list') }}</h1>
                    <!-- DataTable -->
                    <div class="card-body specialUserCls">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-User">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th>{{ trans('translation.ID') }}</th>
                                        <th>{{ trans('translation.name') }}</th>
                                        <th>{{ trans('translation.username') }}</th>
                                        <th>{{ trans('translation.discord_id') }}</th>
                                        <th>{{ trans('translation.email') }}</th>
                                        <th>{{ trans('translation.role') }}</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <!-- End DataTable -->
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="addRandomCoins">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('translation.user_coins') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="userId" id="userId">
                    <div class="form-group">
                        <label for="username" class="col-form-label">{{ trans('translation.name') }}:</label>
                        <input type="text" class="form-control" id="username" readonly>
                    </div>
                    <div class="form-group">
                        <label for="current_tokens" class="col-form-label">{{ trans('translation.current_tokens') }}:</label>
                        <input type="text" class="form-control" id="current_tokens" readonly>
                    </div>
                    <div class="form-group">
                        <label for="add_tokens" class="col-form-label">{{ trans('translation.update_tokens') }}:</label>
                        <input type="text" name="add_tokens" class="form-control" id="add_tokens">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ trans('translation.update_coins') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);


        $(document).on('click', '.btn-success', function () {
            var userId = $(this).data('id');
            var token = $(this).data('token');
            var name = $(this).data('name');
            if(token == 0){
                var mainToken = 0;    
            }else{
                var mainToken = token.split(".")[0];
            }
            $("#userId").val(userId);
            $("#current_tokens").val(mainToken);
            $("#username").val(name);
            $('#exampleModal').modal('show');
        });


        let deleteButtonTrans = '{{ trans('translation.delete') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('users.massDestroy') }}",
            className: 'btn-danger',
            action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                    return $(entry).data('entry-id');
                });

                if (ids.length === 0) {
                    alert('{{ trans('translation.no_row_selected') }}');
                    return;
                }

                if (confirm('{{ trans('translation.are_you_sure') }}')) {
                    $.ajax({
                        headers: { 'x-csrf-token': '{{ csrf_token() }}' },
                        method: 'POST',
                        url: config.url,
                        data: { ids: ids, _method: 'DELETE' }
                    })
                    .done(function () { location.reload() });
                }
            }
        };
        dtButtons.push(deleteButton);

        // Additional buttons if needed
        dtButtons.push({
            text: '{{ trans('translation.select_all') }}',
            className: 'btn-primary',
            action: function (e, dt, node, config) {
                dt.rows().select();
            }
        });

        dtButtons.push({
            text: '{{ trans('translation.deselect_all') }}',
            className: 'btn-secondary',
            action: function (e, dt, node, config) {
                dt.rows().deselect();
            }
        });

        let table = $('.datatable-User').DataTable({
            dom: 'Bfrtip',
            buttons: dtButtons.concat(['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']),
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 100,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('users.list') }}",
                type: "POST",
                data: { _token: "{{ csrf_token() }}" }
            },
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    defaultContent: '',
                    className: 'select-checkbox',
                    targets: 0
                },
                { data: "id" },
                { data: "name" },
                { data: "username" },
                { data: "discord_id" },
                { data: "email" },
                { data: "user_roles" },
                {
                    data: null,
                    render: function (data, type, user) {
                        let actions = '';
                        let confirmText = 'return confirm("{{ trans('translation.are_you_sure') }}")';
                        actions += ' <a class="btn btn-xs btn-primary" href="/admin/users/' + user.id + '">{{ trans('translation.view') }}</a>';
                        actions += ' <a class="btn btn-xs btn-info" href="/admin/users/' + user.id + '/edit">{{ trans('translation.edit') }}</a>';
                        actions += ' <a class="btn btn-xs btn-success btn-success" data-id="' + user.id + '" data-token="' + user.balance_in_wallet + '" data-name="' + user.name + '">{{ trans('translation.tokens') }}</a>';
                        if (user.id != 1) {
                            actions += ' <form action="/admin/users/' + user.id + '" method="POST" onsubmit=\'' + confirmText + '\' style=\'display: inline-block;\'>';
                            actions += '<input type="hidden" name="_method" value="DELETE">';
                            actions += '<input type="hidden" name="_token" value="{{ csrf_token() }}">';
                            actions += '<input type="submit" class="btn btn-xs btn-danger" value="{{ trans('translation.delete') }}">';
                            actions += '</form>';
                        }
                        return actions;
                    }
                }
            ],
            select: {
                style: 'multi+shift',
                selector: 'td:first-child'
            },
            rowCallback: function (row, data) {
                $(row).attr('data-entry-id', data.id);
            }
        });

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

        $("#add_tokens").on("input", function () {
            $(this).val($(this).val().replace(/[^0-9]/g, ""));
            const enteredValue = parseInt($(this).val(), 10);
            if (enteredValue > 10000) {
                $(this).val(10000);
            }
        });

        $("#add_tokens").on("paste", function (event) {
            event.preventDefault();
        });

        $("#addRandomCoins").on('submit', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: '{{ route('save-tokens') }}',
                type: 'json',
                method: 'post',
                data: $('#addRandomCoins').serialize(),
                success: function (response) {
                    if (response.success) {
                        console.log(response.success);
                        $('#exampleModal').modal('hide');
                        toastr.success(response.success);
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 2000);
                    } else if (response.error) {
                        console.error(response.error);
                        $('#exampleModal').modal('hide');
                        setTimeout(function () {
                            window.location.href = window.location.href;
                        }, 2000);
                    }

                    if ("{{ session('success') }}") {
                        toastr.success("{{ session('success') }}");
                    }
                    if ("{{ session('error') }}") {
                        toastr.error("{{ session('error') }}");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error saving tokens:", textStatus, errorThrown);
                }
            });
        });
    });
</script>

@endsection
