@extends('adminlte::page')

@section('title', 'guilds')

@section('content_header')
    <h3 class="title-page">Ranking Guilds</h3>
    @if (session('success'))

        <div id="alerta-time" class="alert alert-success p-2">
            {!! session('success') !!}
        </div>
    @endif
    @if (session('error'))

        <div id="alerta-time" class="alert alert-danger p-2">
            {!! session('error') !!}
        </div>
    @endif
@stop

@section('content')
    <table id="lista-guild" class="table table-bordered table-hover table-panel" style="width:100%">

        <thead>
            <tr class="titulo">
                <th>Ranking</th>
                <th>{{strtoupper(trans('site.name'))}}:</th>
                <th>{{strtoupper(trans('site.leader'))}}:</th>
                <th>{{strtoupper(trans('site.lvl'))}}:</th>
                <th>{{strtoupper(trans('site.kingdom'))}}:</th>
                <th>{{strtoupper(trans('site.apply'))}}:</th>
            
            </tr>
        </thead>
        <tbody>
                @php
                    $rank = 1;
                    $apply = 'disabled';
                    $btn_style = 'btn-success';
                    $apply_name = 'site.unavailable';
                    $place_holder = 'A Guild não esta recrutando';
                    $apply_type = 0;
                    $modal = '#modal-aply-';
                @endphp
                @forelse($guild as $Guild)
                <tr class="text">
                    <td>{{$rank++}}º</td>
                    <td>{{ $Guild->name }}</td>
                    <td>{{ $Guild->leader }}</td>
                    <td>{{ $Guild->level }}</td>
                    <td><img class="classe-icon" src="{{asset('img/reino/icon/'.$Guild->leader_kingdom.'.png')}}"></td>
                    @if (!$guild_index && $char_online)
                       
                         
                        @if($Guild->request)
                            @if ($char_kingdom != $Guild->kingdom)
                                    @php
                                        $apply = 'disabled';
                                        $apply_name = 'site.unavailable';
                                        $place_holder = 'Você precisa ser do mesmo reino que a guild.';
                                    @endphp  
                                @else 
                                    @php
                                        $apply = 'enabled';
                                        $apply_name = 'site.apply';
                                        $place_holder = 'Aplicar na guild.';
                                    @endphp
                            @endif

                            @foreach ($guild_apply as $Guild_apply)
                                @if ($Guild_apply->guild_id == $Guild->id)
                                    @php
                                        $apply = 'enabled';
                                        $apply_name = 'site.cancel';
                                        $btn_style = 'btn-danger';
                                        $place_holder = 'Você já aplicou nessa guild.';
                                        $apply_type = 1;
                                        $modal = '#modal-remove-';
                                    @endphp
                                @endif

                            @endforeach

                          
            
                        @else
                            @php
                                $apply = 'disabled';
                                $apply_name = 'site.unavailable';
                                $place_holder = 'A Guild não esta aceitando aplicação.';
                            @endphp   

                        @endif
                    @else
                        @php
                            $apply = 'disabled';
                            $apply_name = 'site.unavailable';
                            $place_holder = 'Você já possui guild.';
                        @endphp   

                        @if (!$char_online)
                            {{$place_holder = 'Precisa de um char logado no jogo.'}}
                        @endif



                    @endif
                      <!-- inicio modal-apply -->
                        <div class=" modal fade" id="modal-aply-{{$Guild->id}}" data-backdrop="static">
                            <form method="POST" id="form-aply" action="{{url('/ghInOut')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content borda-arredondada">
                                            <div class="modal-header modal-dark">
                                                <p> 
                                                    <h2>Aplicar na Guild</h2>
                                                    <input name="guild_id" type="text" hidden class="" id="guild-{{$Guild->id}}" value="{{$Guild->id}}">
                                                    <input name="char_id" type="text" hidden class="" id="char-{{$char_id}}" value="{{$char_id}}">
                                                    <input name="ntype" type="text" hidden class="" id="type-{{$char_id}}" value="0">
                                                    <input name="apply_type" type="text" hidden class="" id="type-{{$char_id}}" value="{{$apply_type}}">
                                                </p>
                                            
                                            </div>
                                            <div class="modal-body modal-dark">
                                                    <div class="form-group">
                                                        <p>Deseja Realmente aplicar na guild [{!! $Guild->name !!}]?</p>
                                                
                                                    </div>
                                                        

                                            </div>
                                        
                                            <div class="modal-footer modal-dark">
                                                <button type="button" class="btn btn-danger pull-left btn-cancel-item"
                                                        data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                <button id="idsubmit-{{$Guild->id}}" type="submit"
                                                        class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                            </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </form>
                        </div>
                <!-- fim modal-apply -->    
                
                <!-- inicio modal-remove-apply -->
                    <div class=" modal fade" id="modal-remove-{{$Guild->id}}" data-backdrop="static">
                        <form method="POST" id="form-remove" action="{{url('/ghInOut')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content borda-arredondada">
                                        <div class="modal-header modal-dark">
                                            <p> 
                                                <h2>Remover Aplicação</h2>
                                                <input name="guild_id" type="text" hidden class="" id="guild-{{$Guild->id}}" value="{{$Guild->id}}">
                                                <input name="char_id" type="text" hidden class="" id="char-{{$char_id}}" value="{{$char_id}}">
                                                <input name="ntype" type="text" hidden class="" id="type-{{$char_id}}" value="0">
                                                <input name="apply_type" type="text" hidden class="" id="type-{{$char_id}}" value="{{$apply_type}}">
                                            </p>
                                        
                                        </div>
                                        <div class="modal-body modal-dark">
                                                <div class="form-group">
                                                    <p>Deseja Realmente remover aplicação da Guild [{!! $Guild->name !!}] ?</p>
                                            
                                                </div>
                                                    

                                        </div>
                                    
                                        <div class="modal-footer modal-dark">
                                            <button type="button" class="btn btn-danger pull-left btn-cancel-item"
                                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                            <button id="idsubmit-{{$Guild->id}}" type="submit"
                                                    class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                        </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </form>
                    </div>
            <!-- fim modal-remove-apply -->                
                    
                        <td>
                           
                            <button id="idsubmit-{{$Guild->id}}" title="{{$place_holder}}" type="submit" {{$apply}}
                                data-toggle="modal" data-target=" {{$modal}}{{$Guild->id}}"
                            class="btn {!! $btn_style !!} btn-save-item">{!! trans($apply_name) !!}</button>
                        </td>

                   
                </tr>

                    @empty
                        <td> {!! trans('site.none_f') !!} {!! trans('site.guild') !!} {!! trans('site.found_f') !!}
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
    <script> console.log('guilds!'); </script>
@stop