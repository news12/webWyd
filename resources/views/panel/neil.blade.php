@extends('adminlte::page')

@section('title', 'Panel Star Destiny')

@section('content_header')
    <h3 class="m-2 text-dark title-neil">Premium Neil</h3>
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
    <div class="d-flex flex-row justify-content-sm-center flex-wrap row">
       
            <div class="card card-success card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#home" class="nav-link active" data-toggle="tab">Home</a>
                        </li>
                        @foreach ($cat as $Cat)
                            <li class="nav-item">
                                <a href="#{{$Cat->name}}" class="nav-link" data-toggle="tab">{{$Cat->name}}</a>
                            </li>
                        @endforeach
                      
                     
                    </ul>
                </div>
                <div class="card-body card-body-neil">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home">
                            @foreach ($neil as $Neil)
                                 <!-- inicio modal-Compra -->
                                 <div class=" modal fade" id="modal-buy-item-{{$Neil->id}}" data-backdrop="static">
                                    <form method="POST" id="form-buy-item" action="{{url('/buyNeil')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content borda-arredondada">
                                                    <div class="modal-header">
                                                        <p> 
                                                            <h1>{{trans('site.warning')}}!</h1>
                                                            <input name="id" type="text" hidden class="" id="neil-{{$Neil->id}}" value="{{$Neil->id}}">
                                                        </p>
                                                        <p class="p-aviso red n"> O item só será entregue quando tiver pelo menos um char logado no jogo.
                                                            Certifique-se de ter espaço disponível no bau, não nos resposabilizamos por perdas nesse tipo de transação.
                                                        </p>
                                                    </div>
                                                    <div class="modal-body modal-adm-itens">
                                                            <div class="form-group">
                                                                
                                                                <input name="item_id" type="text" hidden class="" id="item_id-{{$Neil->item_id}}" value="{{$Neil->item_id}}">
                                                                <p>
                                                                <h4>  Deseja realmente comprar o item <b class="green"> {{$Neil->name}} </b>?  
                                                                        por {{number_format($Neil->price, 2,',','.')}}</h4>
                                                                    
                                                                </p>
                                                                <img class="btn-right" src="{{asset('img/neil/'.$Neil->img.'.gif')}}">
                                                            </div>
                                                                
                            
                                                    </div>
                                                
                                                    <div class="modal-footer ">
                                                        <button type="button" class="btn btn-default pull-left btn-cancel-item"
                                                                data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                        <button id="idsubmit-{{$Neil->id}}" type="submit"
                                                                class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                                    </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </form>
                            </div>
                            <!-- fim modal-Compra -->
                                <div class="card card-outline card-success card-neil">
                                    <div class="card-header card-header-neil">
                                    <h3 class="card-title card-title-neil">{{$Neil->name}}</h3><br>
                                    <p class="desc-card-neil">{{$Neil->desc}}</p>
                                            <div class="ribbon-wrapper">
                                                    <div class="ribbon bg-success">
                                                        {{$Neil->category}}
                                                    </div>
                                            </div>
                                    <div class="card-tools">
                                        <!-- Buttons, labels, and many other things can be placed here! -->
                                        <!-- Here is a label for example -->
                                        <img class="ribon-img" src="{{asset('img/neil/'.$Neil->img.'.gif')}}">
                                    
                                    </div>
                                    <!-- /.card-tools -->
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <p class="card-body-stock">
                                            Estoque:
                                            <span class="badge badge-primary">{{$Neil->stock}}</span>
                                        </p>
                                        <p class="card-body-price">
                                            Preço:
                                            <span class="badge badge-primary">{{number_format($Neil->price, 2,',','.')}}</span>
                                        </p>
                                        
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer card-footer-neil">
                                        <button type="submit" {{!$Neil->stock ? 'disabled' : 'enabled'}}
                                                class="btn btn-success btn-neil-buy"
                                                title="{{trans('site.buy')}}"
                                                data-toggle="modal"
                                                data-target="#modal-buy-item-{{$Neil->id}}">
                                               <p> {{ !$Neil->stock ? trans('site.out') : trans('site.buy') }}</p>
                                            </button> 
                                    </div>
                                    <!-- /.card-footer -->
                                </div>
                                <!-- /.card -->
                            @endforeach
                        </div>
                            @foreach ($cat as $Cat)
                                <div class="tab-pane fade" id="{{$Cat->name}}">
                                    @foreach ($neil as $Neil)
                                        @if ($Neil->category == $Cat->name)
                                            
                                            <!-- inicio modal-Compra -->
                                                <div class=" modal fade" id="modal-buy-item2-{{$Neil->id}}" data-backdrop="static">
                                                    <form method="POST" id="form-buy-item" action="{{url('/buyNeil')}}" enctype="multipart/form-data">
                                                        {{csrf_field()}}
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content borda-arredondada">
                                                                    <div class="modal-header">
                                                                        <p> 
                                                                            <h1>{{trans('site.warning')}}!</h1>
                                                                            <input name="id" type="text" hidden class="" id="neil-{{$Neil->id}}" value="{{$Neil->id}}">
                                                                        </p>
                                                                        <p class="p-aviso red n"> O item só será entregue quando tiver pelo menos um char logado no jogo.
                                                                            Certifique-se de ter espaço disponível no bau, não nos resposabilizamos por perdas nesse tipo de transação.
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-body modal-adm-itens">
                                                                            <div class="form-group">
                                                                                
                                                                                <input name="item_id" type="text" hidden class="" id="item_id-{{$Neil->item_id}}" value="{{$Neil->item_id}}">
                                                                                <p>
                                                                                <h4>  Deseja realmente comprar o item <b class="green"> {{$Neil->name}} </b>?  
                                                                                        por {{number_format($Neil->price, 2,',','.')}}</h4>
                                                                                    
                                                                                </p>
                                                                                <img class="btn-right" src="{{asset('img/neil/'.$Neil->img.'.gif')}}">
                                                                            </div>
                                                                                
                                            
                                                                    </div>
                                                                
                                                                    <div class="modal-footer ">
                                                                        <button type="button" class="btn btn-default pull-left btn-cancel-item"
                                                                                data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                                        <button id="idsubmit-{{$Neil->id}}" type="submit"
                                                                                class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                                                    </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </form>
                                            </div>
                                            <!-- fim modal-Compra -->
                                            <div class="card card-outline card-success card-neil">
                                                <div class="card-header card-header-neil">
                                                <h3 class="card-title card-title-neil">{{$Neil->name}}</h3><br>
                                                <p class="desc-card-neil">{{$Neil->desc}}</p>
                                                        <div class="ribbon-wrapper">
                                                                <div class="ribbon bg-success">
                                                                    {{$Neil->category}}
                                                                </div>
                                                        </div>
                                                <div class="card-tools">
                                                    <!-- Buttons, labels, and many other things can be placed here! -->
                                                    <!-- Here is a label for example -->
                                                    <img class="ribon-img" src="{{asset('img/neil/'.$Neil->img.'.gif')}}">
                                                
                                                </div>
                                                <!-- /.card-tools -->
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                    <p class="card-body-stock">
                                                        Estoque:
                                                        <span class="badge badge-primary">{{$Neil->stock}}</span>
                                                    </p>
                                                    <p class="card-body-price">
                                                        Preço:
                                                        <span class="badge badge-primary">{{number_format($Neil->price, 2,',','.')}}</span>
                                                    </p>
                                                    
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer card-footer-neil">
                                                    <button type="submit" {{!$Neil->stock ? 'disabled' : 'enabled'}}
                                                            class="btn btn-success btn-neil-buy"
                                                            title="{{trans('site.buy')}}"
                                                            data-toggle="modal"
                                                            data-target="#modal-buy-item2-{{$Neil->id}}">
                                                           <p> {{ !$Neil->stock ? trans('site.out') : trans('site.buy') }}</p>
                                                        </button> 
                                                </div>
                                                <!-- /.card-footer -->
                                            </div>
                                            <!-- /.card -->
                                    
                                        @endif
                                    @endforeach
                                </div>
                             @endforeach
                        
                    </div>
                </div>
            </div>
            
        
    </div>
@stop

@section('footer')
     @include('layouts.footer')
@stop
