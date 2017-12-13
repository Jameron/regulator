@extends('admin::layouts.app')
@section('content')
    <div class="row justify-content-md-left">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card @if(config('admin.theme')=='dark')card-dark @endif" style="margin-top: 1rem;">
                <h4 class="card-header">
                    {{ config('regulator.display.roles.card-header') }}
                </h4>
                <div class="card-body">
                    <h4 class="card-title"> {{ config('regulator.display.roles.card-title') }} </h4>
                    <h6 class="card-subtitle mb-2 text-muted"> {{ config('regulator.display.roles.card_subtitle') }} </h6>
                    @if(config('regulator.display.permissions.search')['show'])
                        @include('partials._search', ['search'=> config('regulator.display.roles.search') ])
                    @endif
                    @include('admin::partials.utils._success')
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
