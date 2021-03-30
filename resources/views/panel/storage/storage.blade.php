@extends('adminlte::page')

@section('title', 'Baú')

@section('content_header')
    <h3 class="title-page">Baú</h3>

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
          

    <table id="bau-itens" class="table table-bordered" style="width:100%">

    <thead>
        <tr class="titulo">
            <th scope="col">{{strtoupper(trans('site.img'))}}:</th>
            <th scope="col">{{strtoupper(trans('site.name'))}}:</th>
            <th scope="col">{{strtoupper(trans('site.slot'))}}:</th>
           
            {{--ação--}}
            <th>{{strtoupper(trans('site.action'))}}:</th>
        </tr>
        </thead>
        <tbody>
            @forelse($storage as $Storage)
              <!-- inicio modal-Venda -->
            <div class=" modal fade" id="modal-storage-item-{{$Storage->id}}" data-backdrop="static">
                <form method="POST" id="form-edit-item" action="{{url('/setSale')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content borda-arredondada">
                        <div class="modal-header">
                            <p>
                                <b><h4> {!! trans('site.item') !!}!</h4></b> 
                                
                            </p>
                            <img class="" src="{{asset('img/'.$Storage->itemID.'.png')}}">
                        </div>
                        <div class="modal-body modal-adm-itens">
                            <div class="form-group">
                                
                                <input name="item_id" type="text" hidden class="" id="item_id-{{$Storage->itemID}}" value="{{$Storage->itemID}}">
                                <label for="nome">{{trans('site.name')}}:
                                    <input name="nome" type="text" disabled
                                           class="form-control form-expandido borda-arredondada"
                                           id="nome-{{$Storage->id}}"
                                           value="{{$Storage->item_name}}">
                                </label>
                                <label for="slot">{{trans('site.slot')}}:
                                    <input name="slot" type="text" hidden class="" id="slot-{{$Storage->id}}" value="{{$Storage->slot}}">
                                    <input name="slot_view" disabled
                                              class="form-control form-expandido borda-arredondada"
                                              id="slot-{{$Storage->id}}"
                                              value="{{$Storage->slot}}">
                                    
                                </label>
                                    <div class="well well-lg well-status">
                                        <label for="efv1">

                                            @foreach($itemEffect[$Storage->ef1] as $ItemEffect)
                                                {{$ItemEffect}}: 
                                             @endforeach
                                        
                                            <input name="ef1" type="text" hidden class="" id="ef1-{{$Storage->id}}" value="{{$Storage->ef1}}">
                                            <input name="efv1" type="text" disabled
                                                class="form-control label-mini borda-arredondada"
                                                id="efv1-{{$Storage->id}}"
                                                value="{{$Storage->efv1}}">
                                        </label>
                                   
                                    
                                        <label for="efv2">

                                            @foreach($itemEffect[$Storage->ef2] as $ItemEffect)
                                                {{$ItemEffect}}: 
                                             @endforeach

                                            <input name="ef2" type="text" hidden class="" id="ef2-{{$Storage->id}}" value="{{$Storage->ef2}}">
                                            <input name="efv2" type="text" disabled
                                                   class="form-control label-mini borda-arredondada"
                                                   id="efv2-{{$Storage->id}}"
                                                   value="{{$Storage->efv2}}">
                                        </label>
                                      
                                        <label for="efv3">

                                            @foreach($itemEffect[$Storage->ef3] as $ItemEffect)
                                            {{$ItemEffect}}: 
                                            @endforeach

                                            <input name="ef3" type="text" hidden class="" id="ef3-{{$Storage->id}}" value="{{$Storage->ef3}}">
                                            <input name="efv3" type="text" disabled
                                                   class="form-control label-mini borda-arredondada"
                                                   id="efv3-{{$Storage->id}}"
                                                   value="{{$Storage->efv3}}">
                                        </label>

                                        <label for="price">{{trans('site.price')}}:
                                            <input name="price" type="number"
                                                   class="form-control label-mini borda-arredondada"
                                                   id="price-{{$Storage->id}}"
                                                   value="1">
                                        </label>

                                        <label for="classe"><div class="txt-mini">{{trans('site.char')}} que será mostrado na venda</div>
                                            <select id="id-char" name="id_char"
                                                    class="form-control">
                                                <option value="99">Selecione um Personagem</option>
                                                @foreach($character as $characters)
            
                                                    <option value="{{$characters->id}}">{{$characters->name}}</option>
            
                                                @endforeach
                                            </select>
                                        </label>

                                        <label for="classe"><div class="txt-mini">{{trans('site.city')}}</div>
                                            <select id="id-city" name="id_city"
                                                    class="form-control">
                                                <option value="99">Selecione uma Cidade</option>
                                                @foreach($city as $citys)
            
                                                    <option value="{{$citys->id}}">{{$citys->name}} --> Imposto({{$citys->tax}})</option>
            
                                                @endforeach
                                            </select>
                                        </label>
                                    </div>
                                   

                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default pull-left btn-cancel-item"
                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                            <button id="idsubmit-{{$Storage->id}}" type="submit"
                                    class="btn btn-primary btn-save-item">{!! trans('site.sell') !!}</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
                </form>
            </div>
             <!-- fim modal-Venda -->
                <tr scope="row">
                    <td>
                        <div class="popover-avatar" data-toggle="popover" data-html="true"
                            data-placement="right"
                            data-title="
                            <div class='level-color'>{{ $Storage->item_name }}
                            </div>" 
                            
                            data-content=" <h6><b>{!! trans('site.status') !!}:</b></h6>
                            <div class='status-bag'>
                               
                                    <div class='desc-ef1 effect'>
                                        @foreach($itemEffect[$Storage->ef1] as $ItemEffect)
                                            {{$ItemEffect}}
                                        @endforeach
                                        <div class='effect'>{{$Storage->ef1 > 0 ? $Storage->efv1 : ''}}</div>
                                    </div>
                                    <div class='desc-ef2 for'>
                                        @foreach($itemEffect[$Storage->ef2] as $ItemEffect)
                                        {{$Storage->ef2 > 0 ? $ItemEffect : ''}}
                                       @endforeach  
                                       <div class='for'>{{$Storage->ef2 > 0 ? $Storage->efv2 : ''}}</div>
                                    </div>
                                    <div class='desc-ef3 agi'>
                                        @foreach($itemEffect[$Storage->ef3] as $ItemEffect)
                                        {{$Storage->ef3 > 0 ? $ItemEffect : ''}}
                                       @endforeach  
                                       <div class='agi'>{{$Storage->ef3 > 0 ? $Storage->efv3 : ''}}</div>
                                    </div>
                                   
                            </div>" 

                                 data-trigger="hover">
                                 <img class="" src="{{asset('img/'.$Storage->itemID.'.png')}}">
                        </div>
                        
                    </td>
                    <td>{{$Storage->item_name}}</td>
                    <td>{{ $Storage->slot }}</td>
                   
                    {{--Ação--}}
                    <td>
                        <button type="submit" {{($Storage->itemID < 1 or $Storage->notrade) ? 'disabled' : 'enable'}}
                                class="btn btn-warning glyphicon glyphicon-pencil btn-right"
                                title="{{trans('site.transaction')}}"
                                data-toggle="modal"
                                data-target="#modal-storage-item-{{$Storage->id}}">
                                <p>{{trans('site.transaction')}}</p>
                        </button>
                       
                    </td>

                </tr>

            @empty
                <td> {!! trans('site.none_m') !!} {!! trans('site.item') !!} {!! trans('site.found_m') !!}
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