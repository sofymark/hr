<ul class="fab-menu fab-menu-absolute fab-menu-top-right" data-fab-toggle="click" style="z-index: 1002;">
    <li>
        <a class="fab-menu-btn btn btn-primary btn-float btn-rounded btn-icon">
            <i class="fab-icon-open icon-grid3"></i>
            <i class="fab-icon-close icon-cross2"></i>
        </a>

        <ul class="fab-menu-inner">

            @can($permissionGroup . '.create')
                <li>
                    <div data-fab-label="New item">
                        @if(isset($arg))
                            <a href="{!! route($lang.'.'.$route . '.create', $arg) !!}" class="btn btn-rounded btn-icon btn-float btn-success">
                                <i class="icon-plus3"></i>
                            </a>
                        @else
                            <a href="{!! route($lang.'.'.$route . '.create') !!}" class="btn btn-rounded btn-icon btn-float btn-success">
                                <i class="icon-plus3"></i>
                            </a>
                        @endif
                    </div>
                </li>
            @endcan

            @can($permissionGroup . '.destroy')
                <li>
                    <div data-fab-label="Delete">
                        <a href="#" class="btn btn-rounded btn-icon btn-float btn-danger" data-task="destroy">
                            <i class="icon-bin"></i>
                        </a>
                        @if(isset($arg))
                            <form action="{!! route($lang.'.'.$route . '.destroy', [$arg, $model->id]) !!}" method="POST" data-task="delete">
                                @else
                                    <form action="{!! route($lang.'.'.$route . '.destroy', $model->id) !!}" method="POST" data-task="delete">
                                        @endif
                                        <input type="hidden" name="_method" value="DELETE"/>
                                        {{ csrf_field() }}
                                    </form>
                    </div>
                </li>
            @endcan

            <li>
                <div data-fab-label="List items">
                    @if(isset($arg))
                        <a href="{!!  route($lang.'.'.$route . '.index', $arg)  !!}" class="btn btn-rounded btn-icon btn-float btn-success">
                            <i class="icon-list"></i>
                        </a>
                    @else
                        <a href="{!!  route($lang.'.'.$route . '.index')  !!}" class="btn btn-rounded btn-icon btn-float btn-success">
                            <i class="icon-list"></i>
                        </a>
                    @endif
                </div>
            </li>

        </ul>
    </li>
</ul>
