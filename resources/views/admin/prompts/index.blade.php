@extends('layouts.admin.app')
@section('content')

<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12" style="display: flex; justify-content: space-between;">
                <div class="category-top">
                    <a href="{{ route('prompts.create') }}" class="btn btn-primary Add-Category">{{ trans('translation.add_prompt') }}</a>
                </div>
                <!-- <div class="category-top pull-right">
                    <a class="btn btn-primary Add-Category" style="background-color: #a05aff !important;" id="btn_import_prompts_modal">Import Prompt</a>
                </div> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-scroll">
                    <h1 class="Category_List">{{ trans('translation.prompt_list') }}</h1>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-Prompt">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th>{{ trans('translation.ID') }}</th>
                                        <th style="width: 10%">{{ trans('translation.status') }}</th>
                                        <th style="width: 20%">{{ trans('translation.title') }}</th>
                                        <th style="width: 10%">{{ trans('translation.max_tokens') }}</th>
                                        <th style="width: 10%">{{ trans('translation.category') }}</th>
                                        <th style="width: 20%">{{ trans('translation.question') }}</th>
                                        <th style="width: 10%">&nbsp;</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('admin.prompts.modal.import_prompts-modal')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#btn_import_prompts_modal').on('click', function (e) {
            $('#importPromptModal').modal('show');
        });

        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        let deleteButtonTrans = '{{ trans('translation.delete_selected') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('prompts.massDestroy') }}",
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

        let table = $('.datatable-Prompt').DataTable({
            dom: 'Bfrtip',
            buttons: dtButtons.concat(['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']),
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 100,
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('prompts.list') }}",
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
                { data: "status" },
                { data: "title" },
                { data: "max_tokens" },
                { data: "category_title" },
                { data: "questions", orderable: false },
                {
                    data: null,
                    render: function (data, type, row) {
                        let actions = '';
                        let confirmText = 'return confirm("{{ trans('translation.are_you_sure') }}")';
                        actions += ' <a class="btn btn-xs btn-info" href="/admin/prompts/' + row.id + '/edit">{{ trans('translation.edit') }}</a>';
                        actions += ' <form action="/admin/prompts/' + row.id + '" method="POST" ' +
                            "onsubmit='" + confirmText + "' style='display: inline-block;'>  " +
                            '<input type="hidden" name="_method" value="DELETE"> ' +
                            '<input type="hidden" name="_token" value="{{ csrf_token() }}">' +
                            '<input type="submit" class="btn btn-xs btn-danger" value="{{ trans('translation.delete') }}"></form>';
                        return actions;
                    }
                }
            ],
            select: {
                style: 'multi+shift',
                selector: 'td:first-child'
            },
            rowCallback: function(row, data) {
                $(row).attr('data-entry-id', data.id);
            }
        });

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab click', function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });

    $(() => {
        $(document).on('click', '#btn_import_prompts', function () {
            document.getElementById('frmImportPrompts').submit();
        });
    });
</script>
@endsection
