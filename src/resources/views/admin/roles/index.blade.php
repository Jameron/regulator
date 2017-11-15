@extends('admin::layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
             <div class="panel @if(config('admin.theme')=='dark')panel-dark @elseif(config('admin.theme')=='light') panel-default @endif">
                    <div class="panel-heading">Roles Index Page</div>
                    <div class="panel-body">
                        @include('admin::partials.utils._success')
                        <a href="{{ url('/admin/roles/create') }}" class="btn btn-primary">Create</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Name', 
                                        'url' => url('admin/roles?sortBy=name&search=' . $search), 
                                        'column' => 'name' 
                                        ])
                                        <th>Edit</th>
                                        <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td><a href="{{ url('admin/roles/' . $role->id . '/edit' ) }}">{{ $role->name }}</a></td>
                                        <td><a href="{{ url('admin/roles/' . $role->id . '/edit' ) }}">Edit</a></td>
                                        <td>
                                            <form action="{{ url('/admin/roles/' . $role->id) }}" method="POST">
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
                            {!! $roles->appends(['sortBy' => $sort_by, 'order' => $order])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
