<form action="{{ $search['route'] }}" method="POST" class="form-inline">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <label class="sr-only" for="inlineFormInputName2">Search</label>
    <input type="text" name="search" class="form-control @if(config('admin.theme')=='dark')form-control-dark @endif" placeholder="{{ $search['placeholder'] }}">
    <button type="submit" class="btn btn-primary">@if(isset($search['icon']))<i class="fa fa-{{ $search['icon']}}" aria-hidden="true"></i>@endif {{$search['button_text']}}</button>
</form>
