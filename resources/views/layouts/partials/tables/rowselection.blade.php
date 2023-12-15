@can($permissionGroup . '.edit')
    @if(!isset($systemic) || !$systemic)
        <td>
            <div class="checkbox">
                <label>
                    <input type="checkbox" class="control-primary" name="selected[]" id="selected{{ $model->id }}" value="{{ $model->id }}">
                </label>
            </div>
        </td>
    @else
        <td></td>
    @endif
@else
    <td></td>
@endcan