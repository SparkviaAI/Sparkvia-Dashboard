@can('section_edit')
    @if($theme->pages->where('theme_id', $theme->id)->first())
        <a class="btn btn-xs btn-primary"
           href="{{ route_relative('admin.pages.sections', $theme->pages->where('theme_id', $theme->id)->first()->id) }}">
            {{ trans('cruds.customize.title') }}
        </a>
    @endif
@endcan
