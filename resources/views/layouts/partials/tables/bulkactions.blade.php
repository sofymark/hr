@if (ends_with($page_name, '.index'))
    @if(isset($id))
        <form action="{!! route($route . '.bulk', $id) !!}" method="POST" data-task="bulk">
    @else
        <form action="{!! route($route . '.bulk') !!}" method="POST" data-task="bulk">
    @endif
@endif

<ul class="fab-menu fab-menu-absolute fab-menu-top-right" data-fab-toggle="click" style="z-index: 1002;">
    <li>
        <a class="fab-menu-btn btn btn-primary btn-float btn-rounded btn-icon">
            <i class="fab-icon-open icon-grid3"></i>
            <i class="fab-icon-close icon-cross2"></i>
        </a>

        <ul class="fab-menu-inner">
            @can($permissionGroup . '.create')
                @if(isset($arg))
                    <li>
                        <div data-fab-label="{{ trans('messages.add') }}">
                            <a href="{!! route($route . '.create', $arg) !!}" class="btn btn-rounded btn-icon btn-float btn-success">
                                <i class="icon-plus3"></i>
                            </a>
                        </div>
                    </li>
                @else
                    <li>
                        <div data-fab-label="{{ trans('messages.add') }}">
                            <a href="{!! route($route . '.create') !!}" class="btn btn-rounded btn-icon btn-float btn-success">
                                <i class="icon-plus3"></i>
                            </a>
                        </div>
                    </li>
                @endif
            @endcan

            @if (ends_with($page_name, '.show') or ends_with($page_name, '.edit'))
                @can($permissionGroup . '.edit')

                    @if(isset($arg))
                        <li>
                            <div data-fab-label="{{ trans('messages.edit') }}">
                                <a href="{!! route($route . '.edit', [$arg, $model->id]) !!}" class="btn btn-rounded btn-icon btn-float btn-warning">
                                    <i class="icon-pencil"></i>
                                </a>
                            </div>
                        </li>
                    @else
                        <li>
                            <div data-fab-label="{{ trans('messages.edit') }}">
                                <a href="{!! route($route . '.edit', $model->id) !!}" class="btn btn-rounded btn-icon btn-float btn-warning">
                                    <i class="icon-pencil"></i>
                                </a>
                            </div>
                        </li>
                    @endif

                    @can($permissionGroup . '.destroy')
                        <li>
                            <div data-fab-label="{{ trans('messages.remove') }}">
                                <a href="#" class="btn btn-rounded btn-icon btn-float btn-danger" data-task="destroy">
                                    <i class="icon-bin"></i>
                                </a>
                                @if(isset($arg))
                                    <form action="{!! route($route . '.destroy', [$arg, $model->id]) !!}" method="POST" data-task="delete">
                                @else
                                    <form action="{!! route($route . '.destroy', $model->id) !!}" method="POST" data-task="delete">
                                @endif
                                    <input type="hidden" name="_method" value="DELETE"/>
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    @endcan
                @endcan
            @endif
            @if (ends_with($page_name, '.index'))
                @can($permissionGroup . '.destroy')
                    <li>
                        <div data-fab-label="{{ trans('messages.selectall') }}">
                            <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-float bulk-action select">
                                <i class="icon-checkbox-checked2"></i>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div data-fab-label="{{ trans('messages.deselectall') }}">
                            <a href="#" class="btn bg-teal-400  btn-rounded btn-icon btn-float bulk-action deselect">
                                <i class="icon-checkbox-unchecked2"></i>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div data-fab-label="{{ trans('messages.deleteselected') }}">
                            <a href="#" class="btn btn-rounded btn-icon btn-float btn-danger bulk-action delete">
                                <i class="icon-bin"></i>
                            </a>
                        </div>
                    </li>
                @endcan
            @else
                @if(isset($arg))
                    <li>
                        <div data-fab-label="{{ trans('messages.list') }}">
                            <a href="{!! route($route . '.index', $arg) !!}" class="btn btn-rounded btn-icon btn-float btn-success">
                                <i class="icon-list"></i>
                            </a>
                        </div>
                    </li>
                @else
                    <li>
                        <div data-fab-label="{{ trans('messages.list') }}">
                            <a href="{!! route($route . '.index') !!}" class="btn btn-rounded btn-icon btn-float btn-success">
                                <i class="icon-list"></i>
                            </a>
                        </div>
                    </li>
                @endif
            @endif
        </ul>
    </li>
</ul>

@if (ends_with($page_name, '.index'))
    <input type="hidden" name="_bulkIds" value="" />
    <input type="hidden" name="_bulkMethod" value="" />
    {{ csrf_field() }}
    </form>
@endif
