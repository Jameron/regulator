@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Permissions Index Page</div>
                    <div class="panel-body">
                        @include('admin::partials.utils._success')
                        <a href="{{ url('/admin/permissions/create') }}" class="btn btn-primary">Create</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Name', 
                                        'url' => url('admin/permissions?sortBy=name&search=' . $search), 
                                        'column' => 'name' 
                                        ])
                                        <th>Edit</th>
                                        <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td><a href="{{ url('admin/permissions/' . $permission->id . '/edit' ) }}">{{ $permission->name }}</a></td>
                                        <td><a href="{{ url('admin/permissions/' . $permission->id . '/edit' ) }}">Edit</a></td>
                                        <td>
                                            <form action="{{ url('/admin/permissions/' . $permission->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE"> 
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-link"><span>Delete</span></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="table-footer">
                            {!! $permissions->appends(['sortBy' => $sort_by, 'order' => $order])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
