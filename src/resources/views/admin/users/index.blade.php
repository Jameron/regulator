@extends('admin::layouts.app')
@section('content')

    @component('partials._card')
        @slot('header')
            Users
        @endslot
        @slot('body')

            @if(config('regulator.display.users.search')['show'])
                @include('partials._search', ['search'=> config('regulator.display.users.search') ])
            @endif
            <table class="table table-hover table-responsive table-striped">
                <thead>
                    <tr>
                    @foreach($columns as $key => $column)
                        @include('admin::partials.utils._sortable_column', 
                        [
                            'th' => $column['label'], 
                            'url' => url($resource_route . '?sortBy=' . $column['column'] . '&search=' . $search_string), 
                            'column' => $column['column']
                            ])
                    @endforeach
                        @include('admin::partials.utils._sortable_column', 
                        [
                            'th' => 'Option', 
                            'url' => null, 
                            'column' => null 
                            ])
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $user)
                        <tr>
                            @foreach($columns as $key => $column)
                            <td data-column="{{ $column['column'] }}">
                                @if(isset($column['link']))
                                    @if(isset($column['link']) && isset($column['link']['resource_route']))
                                        <a href="{{ url($column['link']['resource_route'] . '/' . $user->{$column['link']['id_column']} ) }}">{{ $user->{$column['column']}  }}</a>
                                    @endif
                                @else
                                    {{ $user->{$column['column']}  }}
                                @endif
                            </td>
                            @endforeach
                            <td>
                                <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                    <div class="btn-group mr-2" role="group" aria-label="First group">
                                        @if(Gate::check('update_owned_systems') || Gate::check('update_all_systems'))
                                            <a href="{{ url('systems/' . $user->id . '/edit' ) }}" class="btn btn-sm btn-secondary"><i class="fa fa-edit"></i></a>
                                        @endif
                                        @if(Gate::check('delete_owned_systems') || Gate::check('delete_all_systems'))
                                            <a href="{{ url('systems/' . $user->id . '/delete' ) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="table-footer">
                {!! $items->appends(['sortBy' => $sort_by, 'order' => $order])->render() !!}
            </div>
        @endslot
    @endcomponent

@endsection
