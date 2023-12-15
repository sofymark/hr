@if(method_exists($model, 'getSortableColumns'))
<tr class="bg-blue">
    <th></th>
    @foreach($model::getSortableColumns() as $name => $attributes)
        @if(isset($hideRole) && $name == "role_user.role_id")
            @continue;
        @endif
        @if(!array_key_exists('accessCallback', $attributes) && !array_key_exists('permissionGroup', $attributes))
            <th @if(array_key_exists('toggle', $attributes)) data-toggle="true" @elseif (array_key_exists('hide', $attributes)) data-hide="phone,tablet" @endif>
                @if($model::isSortable($name))
                    <a href="{{ $model::getSortURL($name) }}" class="stable">
                        {!! $model::getLabel($name) !!}
                        @if($model::isSorted($name))
                            @if($model::getDirection($name) == 'asc')
                                <i class="icon-arrow-up8"></i>
                            @elseif($model::getDirection($name) == 'desc')
                                <i class="icon-arrow-down8"></i>
                            @endif
                        @endif
                    </a>
                @else
                    {{ $model::getLabel($name) }}
                @endif
            </th>
        @endif

        @if(!array_key_exists('accessCallback', $attributes) && array_key_exists('permissionGroup', $attributes))
            @can($attributes['permissionGroup'] . '.edit')
            <th @if(array_key_exists('toggle', $attributes)) data-toggle="true" @elseif (array_key_exists('hide', $attributes)) data-hide="phone,tablet" @endif>
                @if($model::isSortable($name))
                    <a href="{{ $model::getSortURL($name) }}" class="stable">
                        {!! $model::getLabel($name) !!}
                        @if($model::isSorted($name))
                            @if($model::getDirection($name) == 'asc')
                                <i class="icon-arrow-up8"></i>
                            @elseif($model::getDirection($name) == 'desc')
                                <i class="icon-arrow-down8"></i>
                            @endif
                        @endif
                    </a>
                @else
                    {{ $model::getLabel($name) }}
                @endif
            </th>
            @endcan
        @endif

        @if(array_key_exists('accessCallback', $attributes) && method_exists($model, $attributes['accessCallback']) && $model::{$attributes['accessCallback']}())
            <th @if(array_key_exists('toggle', $attributes)) data-toggle="true" @elseif (array_key_exists('hide', $attributes)) data-hide="phone,tablet" @endif>
                @if($model::isSortable($name))
                    <a href="{{ $model::getSortURL($name) }}" class="stable">
                        {!! $model::getLabel($name) !!}
                        @if($model::isSorted($name))
                            @if($model::getDirection($name) == 'asc')
                                <i class="icon-arrow-up8"></i>
                            @elseif($model::getDirection($name) == 'desc')
                                <i class="icon-arrow-down8"></i>
                            @endif
                        @endif
                    </a>
                @else
                    {{ $model::getLabel($name) }}
                @endif
            </th>
        @endif
    @endforeach
    <th></th>
</tr>
@endif
