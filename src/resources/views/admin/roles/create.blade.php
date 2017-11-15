@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
             <div class="panel @if(config('admin.theme')=='dark')panel-dark @elseif(config('admin.theme')=='light') panel-default @endif">
                <div class="panel-heading">Create Role</div>
                <div class="panel-body">
                    @include('admin::partials.utils._success')
                    <form action="/admin/roles" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('regulator::partials.forms.role', ['submitButtonText' => 'Update', 'mode'=>'edit'])
                    </form>
                    @include('admin::partials.utils._errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
