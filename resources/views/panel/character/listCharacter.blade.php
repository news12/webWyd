@extends('adminlte::page')

@section('title', 'Personagens')

@section('content_header')
    <h3 class="title-page">Personagens</h3>
@stop

@section('content')
    <table id="lista-itens"
    class="table table-bordered table-hover table-panel" style="width:100%">

    <thead>
        <tr class="titulo">
            <th>{{strtoupper(trans('site.class'))}}:</th>
            <th>{{strtoupper(trans('site.name'))}}:</th>
            <th>{{strtoupper(trans('site.lvl'))}}:</th>
            <th>{{strtoupper(trans('site.exp'))}}:</th>
            <th>{{strtoupper(trans('site.kingdom'))}}:</th>
            <th>{{strtoupper(trans('site.masterclass'))}}:</th>
            <th>{{strtoupper(trans('site.guild'))}}:</th>

            {{--ação--}}
            <th>{{strtoupper(trans('site.action'))}}:</th>
        </tr>
        </thead>
        <tbody>
            @forelse($characters as $character)
                <tr class="text">
                    <td><img class="classe-icon" src="{{asset('img/classe/icon/'.$character->classe_name.'.png')}}"></td>
                    <td>{{ $character->name }}</td>
                    <td>{{ $character->_level }}</td>
                    <td> {{ $character->exp }}</td>
                    <td><img class="classe-icon" src="{{asset('img/reino/icon/'.$character->kingdom.'.png')}}"></td>
                    <td>{{ $character->mclasse_name }}</td>
                    <td>{{$character->guildindex > 0 ? $character->guild : 'Nenhuma'}}</td>

                    {{--Ação--}}
                    <td>
                        <button type="submit"
                                class="btn btn-warning glyphicon glyphicon-pencil"
                                title="{{trans('site.view')}} {{trans('site.status')}}"
                                data-toggle="modal"
                                data-target="#modal-adm-item-{{$character->id}}">
                                <p>{{trans('site.view')}} {{trans('site.status')}}</p>
                        </button>
                       
                    </td>

                </tr>

            @empty
                <td> {!! trans('site.none_m') !!} {!! trans('site.character') !!} {!! trans('site.found_m') !!}
                    ...
                </td>
        @endforelse
        </tbody>
    </table>
@stop

@section('footer')
     @include('layouts.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Personagens!'); </script>
@stop