@extends('layouts.admin.app')
@section('content')

<!-- @include('admin.settings.cards.locale') -->

<section class="dasboard-all pages pt-4 pb-4 height100vh">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-scroll">
                    <h1 class="Category_List">{{ trans('translation.locale_list') }}</h1>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-Locale">
                                <thead>
                                    <tr>
                                        <th width="10"></th>
                                        <th>{{ trans('translation.ID') }}</th>
                                        <th>{{ trans('translation.title') }}</th>
                                        <th>{{ trans('translation.slug') }}</th>
                                        <th>{{ trans('translation.flag_name') }}</th>
                                        <th>{{ trans('translation.status') }}</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($locales as $key => $locale)
                                    <tr data-entry-id="{{ $locale->id }}">
                                        <td></td>
                                        <td>{{ $locale->id ?? '' }}</td>
                                        <td>{{ $locale->title ?? '' }}</td>
                                        <td>{{ $locale->slug ?? '' }}</td>
                                        <td>{{ $locale->flag_name ?? '' }}</td>
                                        <td>
                                            <span class="badge badge-{{ $locale->status ? 'success' : 'secondary' }}">{{ $locale->status ? 'Enabled' : 'Disabled' }}</span>
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-info" href="{{ route('locales.edit', ['locale' => $locale->id]) }}">{{ trans('translation.edit') }}</a>
                                            <form action="{{ route('locales.destroy', ['locale' => $locale->id]) }}" method="POST" onsubmit="return confirm('{{ trans('translation.are_you_sure') }}');" style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('translation.delete') }}">
                                            </form>
                                        </td>
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
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        let deleteButtonTrans = '{{ trans('translation.delete_selected') }}';
        let deleteButton = {
            text: deleteButtonTrans,
            url: "{{ route('locales.massDestroy') }}",
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

        let table = $('.datatable-Locale').DataTable({
            dom: 'Bfrtip',
            buttons: dtButtons.concat(['copy', 'csv', 'excel', 'pdf', 'print', 'colvis']),
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 100,
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
</script>
@endsection
