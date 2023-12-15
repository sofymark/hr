@can($permissionGroup . '.edit')
    @if(!isset($systemic) || !$systemic || request()->user()->isAdministrator())
    <td class="row-action">
        <div class="btn-group">
            <ul class="icons-list">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-menu9"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        @if(isset($arg))
                            <li><a href="{{ route($route . '.show', [$arg, $model->id]) }}"><i class="icon-eye"></i> View</a></li>
                        @else
                            <li><a href="{{ route($route . '.show', $model->id) }}"><i class="icon-eye"></i> View</a></li>
                        @endif
                        @if(isset($arg))
                            <li><a href="{{ route($route . '.edit', [$arg, $model->id]) }}"><i class="icon-pencil"></i> Edit</a></li>
                        @else
                            <li><a href="{{ route($route . '.edit', $model->id) }}"><i class="icon-pencil"></i> Edit</a></li>
                        @endif
                        @can($permissionGroup . '.destroy')
                            <li role="separator" class="divider"></li>
                            <li>
                                <a data-task="destroy" href="#"><i class="icon-trash"></i> Delete</a>
                                @if(isset($arg))
                                    <form data-task="delete" method="POST" action="{{ route($route . '.destroy', [$arg, $model->id]) }}">
                                @else
                                    <form data-task="delete" method="POST" action="{{ route($route . '.destroy', $model->id) }}">
                                @endif
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endcan
                    </ul>
                </li>
            </ul>
        </div>
    </td>
    @else
    <td></td>
    @endif
@else
<td></td>
@endcan
