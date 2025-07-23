@extends('layouts.admin.app')
@section('content')
    <section class="dasboard-all pages pt-4 pb-4 height100vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="category-top">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary Add-Category" style="background-color: #a05aff !important;">Add Category</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-scroll">
                        <h1 class="Category_List">Category List</h1>
                        <!-- NEW TABLE STARTS -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover datatable datatable-Category">
                                    <thead>
                                    <tr>
                                        <th width="10">
                                        </th>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Title</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- NEW TABLE ENDS -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('categories.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('id');
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')
                        return
                    }

                    if (confirm('{{ trans('global.areYouSure') }}')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                        .done(function () {
                            location.reload()
                        })
                    }
                }
            }
            dtButtons.push(deleteButton)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [[1, 'desc']],
                pageLength: 100,
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('categories.list') }}",
                    "dataType": "json",
                    "type": "POST",
                    "data": {_token: "{{ csrf_token() }}"}
                },
                columns: [
                    {
                        "data": null,
                        "orderable": false,
                        "searchable": false,
                        "defaultContent": '',
                        "className": 'select-checkbox',
                        "targets": 0
                    },
                    {"data": "id"},
                    {"data": "status"},
                    {"data": "title"},
                    {
                        "data": "options",
                        render: function (data, type, category) {
                            let actions = '';
                            let confirmText = 'return confirm("Are you sure")';
                            actions += ' <a class="btn btn-xs btn-info" href="/admin/categories/' + category.id + '/edit">Edit</a>';
                            actions += ' <form action="/admin/categories/' + category.id + '" method="POST" ' +
                                "onsubmit='" + confirmText + "' style='display: inline-block;'>  " +
                                '<input type="hidden" name="_method" value="DELETE"> ' +
                                '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                                '<input type="submit" class="btn btn-xs btn-danger" value="Delete"></form>';
                            return actions;
                        }
                    }
                ],
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child'
                }
            });

            let table = $('.datatable-Category:not(.ajaxTable)').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print','colvis' 
                    ]
                })
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });
    </script>

@endsection('content')