@extends('admin::layouts.app')
@section('content')
    @component('admin::partials._card')
        @slot('header')
            Edit User
        @endslot
        @slot('body')
            @if(Gate::check('update_users') )
                    <form action="{{ url(config('regulator.user.resource_route') . '/' . $user->id) }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PATCH">
                    @include('regulator::partials.forms.user', ['submitButtonText' => 'Update', 'mode'=>'edit'])
                </form>
                @if(Gate::check('delete_users'))
                    @include('partials._delete_button', [
                        'route'=> config('regulator.permission.resource_route') . '/' . ($user->id),
                        'button_text'=>'Delete User'
                    ])
                @endif
            @endif
        @endslot
    @endcomponent
@endsection
