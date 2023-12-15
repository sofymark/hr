<td class="text-success">
    @can($permissionGroup . '.edit')
        @if(isset($arg))
            <a href="{!! route($route . '.status', [$model->id, $arg]) !!}">
        @else
            <a href="{!! route($route . '.status', $model->id) !!}">
        @endif
    @endcan
        @if ($model->active == 1) <i class="icon-checkmark3"></i> @else <i class="icon-cross2"></i> @endif
    @can($permissionGroup . '.edit')</a>@endcan
</td>
