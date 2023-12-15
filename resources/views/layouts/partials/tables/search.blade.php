@if(method_exists($model, 'getSearchableColumns'))
    @if($model::isInSearchState() || $totalRecords)
        <tr class="filter">
            <td></td>
            @foreach($model::getSearchableColumns() as $name => $attributes)
            @if(isset($hideRole) && $name == "role_user.role_id")
                @continue;
            @endif
            @if($attributes['type']!='empty')
                @if(strtolower($attributes['element']) == 'text')
                    <td><input type="text" name="{{ $model::getSearchColumnKey($name) }}" value="{{ session($model::getSearchColumnKey($name)) }}" class="form-control" data-input="true"/></td>
                @elseif(strtolower($attributes['element']) == 'date')
                    <td>
                        <div class="date input-group fixed-width-md">
                            <div class="date-picker input-group date">
                                <input type="text" class="form-control" placeholder="From" name="{{ $model::getSearchColumnKey($name) }}_from" value="{{ session($model::getSearchColumnKey($name) . '_from') }}" data-input="true"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                        <div class="date input-group fixed-width-md">
                            <div class="date-picker input-group date">
                                <input type="text" class="form-control" placeholder="To" name="{{ $model::getSearchColumnKey($name) }}_to" value="{{ session($model::getSearchColumnKey($name) . '_to') }}" data-input="true"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </td>
                @elseif(strtolower($attributes['element']) == 'time')
                    <td>
                        <div class="input-group fixed-width-md">
                            <input class="time" class="form-control" placeholder="From" name="{{ $model::getSearchColumnKey($name) }}_from" value="{{ session($model::getSearchColumnKey($name) . '_from') }}" type="text" data-input="true">
                            <span class="input-group-addon"><i class="pg-clock"></i></span>
                        </div>
                        <div class="input-group fixed-width-md">
                            <input class="time" class="form-control" placeholder="To" name="{{ $model::getSearchColumnKey($name) }}_to" value="{{ session($model::getSearchColumnKey($name) . '_to') }}" type="text" data-input="true">
                            <span class="input-group-addon"><i class="pg-clock"></i></span>
                        </div>
                    </td>
                @elseif(strtolower($attributes['element']) == 'yesno')
                    <td>
                        <select class="select" name="{{ $model::getSearchColumnKey($name) }}" data-input="true">
                            <option value="">All</option>
                            <option value="1" @if(session($model::getSearchColumnKey($name)) == '1') selected="selected" @endif>Yes</option>
                            <option value="0" @if(session($model::getSearchColumnKey($name)) == '0') selected="selected" @endif>No</option>
                        </select>
                    </td>
                @elseif(strtolower($attributes['element']) == 'lookup')

                    @if(!array_key_exists('accessCallback', $attributes) && array_key_exists('lookupPermissionGroup', $attributes))
                        @can($attributes['lookupPermissionGroup'] . '.edit')
                        <td>
                            <select class="select" name="{{ $model::getSearchColumnKey($name) }}" data-input="true">
                                <option value="">All</option>
                                @foreach($model::getLookup($attributes['lookupModel']) as $row)
                                    <option value="{{ $row[$attributes['lookupId']] }}" @if(session($model::getSearchColumnKey($name)) == $row[$attributes['lookupId']]) selected="selected" @endif>{{ $row[$attributes['lookupValue']] }}</option>
                                @endforeach
                            </select>
                        </td>
                        @endcan
                    @endif

                    @if(array_key_exists('accessCallback', $attributes) && method_exists($model, $attributes['accessCallback']) && $model::{$attributes['accessCallback']}())
                        <td>
                            <select class="select" name="{{ $model::getSearchColumnKey($name) }}" data-input="true">
                                <option value="">All</option>
                                @foreach($model::getLookup($attributes['lookupModel']) as $row)
                                    <option value="{{ $row[$attributes['lookupId']] }}" @if(session($model::getSearchColumnKey($name)) == $row[$attributes['lookupId']]) selected="selected" @endif>{{ $row[$attributes['lookupValue']] }}</option>
                                @endforeach
                            </select>
                        </td>
                    @endif

                @elseif(strtolower($attributes['element']) == 'array')

                    <td>
                        <select class="select" name="{{ $model::getSearchColumnKey($name) }}" data-input="true">
                            <option value="">All</option>
                            @foreach($attributes['values'] as $k => $v)
                                <option value="{{ $k }}" @if(session($model::getSearchColumnKey($name)) == $k) selected="selected" @endif>{{ $v }}</option>
                            @endforeach
                        </select>
                    </td>

                @endif
            @else
            <td></td>
            @endif
            @endforeach
            <th width="10%">
                <form method="post" action="{!! route($route . '.search') !!}">
                    @foreach($model::getSearchableColumns() as $name => $attributes)
                    @if($attributes['type']!='empty')
                        @if(!in_array(strtolower($attributes['element']),['date','time']))
                            <input type="hidden" id="{{ $model::getSearchColumnKey($name) }}" name="{{ $model::getSearchColumnKey($name) }}" value="{{ session($model::getSearchColumnKey($name)) }}"/>
                        @else
                            <input type="hidden" id="{{ $model::getSearchColumnKey($name) }}_from" name="{{ $model::getSearchColumnKey($name) }}_from" value="{{ session($model::getSearchColumnKey($name) . '_from') }}"/>
                            <input type="hidden" id="{{ $model::getSearchColumnKey($name) }}_to" name="{{ $model::getSearchColumnKey($name) }}_to" value="{{ session($model::getSearchColumnKey($name) . '_to') }}"/>
                        @endif
                    @endif
                    @endforeach
                    {{ csrf_field() }}
                    <button type="button" id="submitSearch" name="submitSearch">
                        <i class="icon-search4"></i>
                    </button>
                    @if(session(strtolower($model::getSearchPrefix()) . 'has_values'))
                    <button type="button" id="submitReset" name="submitReset">
                        <i class="icon-eraser"></i>
                    </button>
                    @endif
                </form>
            </td>
        </tr>
    @endif
@endif
