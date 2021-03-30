@extends('adminlte::page')

@section('title', 'Leilão')

@section('content_header')
    <h3 class="title-page">Leilão de Azran</h3>

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
    <table id="lista-sale" class="table table-bordered table-hover table-panel" style="width:100%">

    <thead>
        <tr class="titulo">
            <th>{{strtoupper(trans('site.img'))}}:</th>
            <th>{{strtoupper(trans('site.char'))}}:</th>
            <th>{{strtoupper(trans('site.item'))}}:</th>
            <th>{{strtoupper(trans('site.price'))}}:</th>
            {{-- <th>{{strtoupper(trans('site.date'))}} {{strtoupper(trans('site.prime'))}}</th> --}}
            <th>{{strtoupper(trans('site.date'))}} {{strtoupper(trans('site.end'))}}</th>

            {{--ação--}}
            <th>{{strtoupper(trans('site.action'))}}:</th>
        </tr>
        </thead>
        <tbody>
            @forelse($sale as $Sale)

                                <!-- inicio modal-Compra -->
                                <div class=" modal fade" id="modal-buy-item-{{$Sale->id}}" data-backdrop="static">
                                    <form method="POST" id="form-buy-item" action="{{url('/bSale')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content borda-arredondada">
                                                    <div class="modal-header">
                                                        <p> 
                                                            <h1>{{trans('site.warning')}}!</h1>
                                                            <input name="sale_id" type="text" hidden class="" id="sale-{{$Sale->id}}" value="{{$Sale->id}}">
                                                        </p>
                                                        <p class="p-aviso red n"> Necessário ter um char logado no jogo para efetuar compras.
                                                            Certifique-se de ter espaço disponível no bau, não nos resposabilizamos por perdas nesse tipo de transação.
                                                        </p>
                                                    </div>
                                                    <div class="modal-body modal-adm-itens">
                                                            <div class="form-group">
                                                                
                                                                <input name="item_id" type="text" hidden class="" id="item_id-{{$Sale->item_id}}" value="{{$Sale->item_id}}">
                                                                <p>
                                                                <h4>  Deseja realmente comprar o item <b class="green"> {{$Sale->item}} </b>?  
                                                                        por {{number_format($Sale->price, 2,',','.')}}</h4>
                                                                    
                                                                </p>
                                                                <img class="btn-right" src="{{asset('img/'.$Sale->item_id.'.png')}}">
                                                            </div>
                                                                
                            
                                                    </div>
                                                
                                                    <div class="modal-footer ">
                                                        <button type="button" class="btn btn-default pull-left btn-cancel-item"
                                                                data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                        <button id="idsubmit-{{$Sale->id}}" type="submit"
                                                                class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                                    </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </form>
                            </div>
                            <!-- fim modal-Compra -->
                          <!-- inicio modal-Cancelar Venda -->
                          <div class=" modal fade" id="modal-sale-item-{{$Sale->id}}" data-backdrop="static">
                                <form method="POST" id="form-cancel-item" action="{{url('/cSale')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content borda-arredondada">
                                                <div class="modal-header">
                                                    <p> 
                                                        <h1>{{trans('site.warning')}}!</h1>
                                                        <input name="sale_id" type="text" hidden class="" id="sale-{{$Sale->id}}" value="{{$Sale->id}}">
                                                    </p>
                                                    <p class="p-aviso red n"> O item só retornará para o bau quando um personagem estiver online no jogo.
                                                        Certifique-se de ter espaço disponível no bau, não nos resposabilizamos por perdas nesse tipo de transação.
                                                    </p>
                                                </div>
                                                <div class="modal-body modal-adm-itens">
                                                        <div class="form-group">
                                                            
                                                            <input name="item_id" type="text" hidden class="" id="item_id-{{$Sale->item_id}}" value="{{$Sale->item_id}}">
                                                            <p>
                                                                <h4>  Deseja realmente cancelar a venda do item <b class="red"> {{$Sale->item}} </b>? </h4>
                                                                
                                                            </p>
                                                            <img class="btn-right" src="{{asset('img/'.$Sale->item_id.'.png')}}">
                                                        </div>
                                                            
                        
                                                </div>
                                            
                                                <div class="modal-footer ">
                                                    <button type="button" class="btn btn-default pull-left btn-cancel-item"
                                                            data-dismiss="modal">{!! trans('site.back') !!}</button>
                                                    <button id="idsubmit-{{$Sale->id}}" type="submit"
                                                            class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                                </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </form>
                        </div>
                         <!-- fim modal-Cancelar Venda -->
                <tr class="text">
                    <td> <div class="popover-avatar" data-toggle="popover" data-html="true"
                            data-placement="right"
                            data-title="
                            <div class='level-color'>{{ $Sale->item }}
                            </div>" 
                            
                            data-content=" <h6><b>{!! trans('site.status') !!}:</b></h6>
                            <div class='status-bag'>
                               
                                    <div class='desc-ef1 effect'>
                                        @foreach($itemeffect[$Sale->ef1] as $ItemEffect)
                                            {{$ItemEffect}}
                                        @endforeach
                                        <div class='effect'>{{$Sale->ef1 > 0 ? $Sale->efv1 : ''}}</div>
                                    </div>
                                    <div class='desc-ef2 for'>
                                        @foreach($itemeffect[$Sale->ef2] as $ItemEffect)
                                        {{$Sale->ef2 > 0 ? $ItemEffect : ''}}
                                       @endforeach  
                                       <div class='for'>{{$Sale->ef2 > 0 ? $Sale->efv2 : ''}}</div>
                                    </div>
                                    <div class='desc-ef3 agi'>
                                        @foreach($itemeffect[$Sale->ef3] as $ItemEffect)
                                        {{$Sale->ef3 > 0 ? $ItemEffect : ''}}
                                       @endforeach  
                                       <div class='agi'>{{$Sale->ef3 > 0 ? $Sale->efv3 : ''}}</div>
                                    </div>
                                   
                            </div>
                            <div class='desc-price cols'>
                               <div class='cols'>{!! trans('site.price') !!}: {{number_format($Sale->price, 2,',','.')}}</div>
                            </div>" 

                                 data-trigger="hover">
                            <img class="" src="{{asset('img/'.$Sale->item_id.'.png')}}">
                        </div>
                    </td>
                    <td>{{$Sale->char}}</td>
                    <td>{{ $Sale->item }}</td>
                    <td>{{ number_format($Sale->price, 2,',','.' )}}</td>
                    {{-- <td>{{\Carbon\Carbon::parse($Sale->date_init)->format('d/m/Y H:i:s') }}</td> --}}
                    <td>{{ \Carbon\Carbon::parse($Sale->date_end)->format('d/m/Y H:i:s')}}</td>

                    {{--Ação--}}
                    <td>
                       
                       
                            @if ($account_id == $Sale->id_account)
                                <button type="submit"
                                    class="btn btn-danger glyphicon glyphicon-pencil btn-right"
                                    title="{{trans('site.cancel')}}"
                                    data-toggle="modal"
                                    data-target="#modal-sale-item-{{$Sale->id}}">
                                    <p>{{trans('site.cancel')}}</p>
                                </button>
                            @else
                                <button type="submit"
                                    class="btn btn-success glyphicon glyphicon-pencil btn-right"
                                    title="{{trans('site.buy')}}"
                                    data-toggle="modal"
                                    data-target="#modal-buy-item-{{$Sale->id}}">
                                    <p>{{trans('site.buy')}}</p>
                                </button> 
                            @endif
                       
                       
                    </td>

                </tr>

            @empty
            <tr class="text">
                <td> {!! trans('site.none_m') !!} {!! trans('site.item') !!} {!! trans('site.found_m') !!}
                    ...
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
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
    <script> console.log('Armia!'); </script>
@stop