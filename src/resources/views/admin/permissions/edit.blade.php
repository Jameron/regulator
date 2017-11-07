@extends('admin::layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Permission</div>
                <div class="panel-body">
                    @include('admin::partials.utils._success')
                    <form action="/admin/permissions/{{$permission->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        @include('regulator::partials.forms.permission', ['submitButtonText' => 'Update', 'mode'=>'edit'])
                    </form>
                    @include('admin::partials.utils._errors')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
