@extends('admin::layouts.app')
@section('content')
    @component('admin::partials._card')
        @slot('header')
            View User
        @endslot
        @slot('body')
            @if(Gate::check($permissions['read']) )
                @include('admin::partials.utils._attributes', ['attributes'=>$attributes])
            @endif
        @endslot
    @endcomponent
@endsection
