@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-md-left">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card @if(config('admin.theme')=='dark')card-dark @endif" style="margin-top: 1rem;">
                <h4 class="card-header">
                    {{ config('regulator.display.card-header') }}
                </h4>
                <div class="card-body">
                    <h4 class="card-title"> {{ config('regulator.display.card-title') }} </h4>
                    <h6 class="card-subtitle mb-2 text-muted"> {{ config('regulator.dispaly.card_subtitle') }} </h6>
                    @if(config('regulator.display.search')['show'])
                        @include('partials._search', ['search'=> config('regulator.display.search') ])
                    @endif
                    @include('admin::partials.utils._success')
                    <a href="{{ url('/admin/users/create') }}" class="btn btn-primary">Create</a>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    @include('admin::partials.utils._sortable_column', 
                                    [
                                        'th' => 'Name', 
                                        'url' => url('admin/users?sortBy=name&search=' . $search), 
                                        'column' => 'name' 
                                        ])
                                        @include('admin::partials.utils._sortable_column', 
                                        [
                                            'th' => 'Email', 
                                            'url' => url('admin/users?sortBy=email&search=' . $search), 
                                            'column' => 'email' 
                                            ])
                                            @include('admin::partials.utils._sortable_column', 
                                            [
                                                'th' => 'Role(s)', 
                                                'url' => url('admin/users?sortBy=role&search=' . $search), 
                                                'column' => 'role' 
                                                ])
                                                @if(config('session.driver') == 'database') 
                                                    @include('admin::partials.utils._sortable_column', 
                                                    [
                                                        'th' => 'Online', 
                                                        'url' => url('admin/users?sortBy=online&search=' . $search), 
                                                        'column' => 'online' 
                                                        ])
                                                        @include('admin::partials.utils._sortable_column', 
                                                        [
                                                            'th' => 'Last Login', 
                                                            'url' => url('admin/users?sortBy=last_login&search=' . $search), 
                                                            'column' => 'last_login' 
                                                            ])
                                                        @endif
                                                        @include('admin::partials.utils._sortable_column', 
                                                        [
                                                            'th' => 'Enabled', 
                                                            'url' => url('admin/users?sortBy=enabled&search=' . $search), 
                                                            'column' => 'enabled' 
                                                            ])
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><a href="{{ url('admin/users/' . $user->id . '/edit' ) }}">{{ $user->name }}</a></td>
                                        <td><a href="{{ url('admin/users/' . $user->id . '/edit' ) }}">{{ $user->email }}</a></td>
                                        <td>
                                            @if(count($user->roles))
                                                @foreach($user->roles as $count => $role)
                                                    {!! $role->slug !!}@if($count < count($user->roles) && count($user->roles) !==1 && (($count+1) !==count($user->roles))), @endif
                                                @endforeach
                                            @endif
                                        </td>
                                        @if(config('session.driver') == 'database') 
                                            <td>{!! ($user->online=='yes') ? '<span class="online" style="background: #0c0;width: 20px;height: 20px;border-radius: 50%;"></span> Yes' : '<span class="offline" style="background: #f00;width: 20px;height: 20px;border-radius: 50%;"></span> No'  !!} </td>
                                            <td>{{ (!empty($user->last_login)) ? $user->last_login->tz('America/Los_Angeles')->format('n/j/Y h:i a') : 'N/A' }} </td>
                                        @endif
                                        <td>@if($user->disabled) No @else Yes @endif</td>
                                        <td><a href="{{ url('admin/users/' . $user->id . '/edit' ) }}">Edit</a></td>
                                        <td>
                                            <form action="{{ url('/admin/users/' . $user->id) }}" method="POST">
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
                            {!! $users->appends(['sortBy' => $sort_by, 'order' => $order])->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
