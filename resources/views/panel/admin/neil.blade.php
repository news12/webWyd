@extends('adminlte::page')


@section('title', 'Star => Neil')
@section('content_header')
    {{-- <p>{!! trans('txt_lang.msg_panel_admin_news') !!} » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p> --}}
  
@stop

@section('content')
    <div class=" modal fade" id="modal-adm-neil-criar" data-backdrop="static">
            <form method="POST" id="form-neil" action="{{url('/cNeil')}}" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content borda-arredondada">
                        <div class="modal-header">
                            <p><b><h4> {!! trans('site.item') !!}!</h4></b></p>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="img-item">
                                    <div class="uploadFile">IMG:
                                        <input id="uploadFile" placeholder="Selecione a imagem" disabled="disabled"/>
                                    </div>
                                    <div class="fileUpload btn btn-primary">
                                        <span>Upload</span>
                                        <input id="img-item" name="img_item" type="file" class="upload"/>
                                    </div>
                                </label>

                                <label class="input-alin-neil" for="item_id">Item ID: <br>
                                    <input name="item_id" type="number"
                                        class="form-control form-expandido borda-arredondada"
                                        id=""
                                        value="">
                                </label>

                                <label class="input-alin-neil" for="name">Nome: <br>
                                    <input name="name" type="text"
                                        class="form-control form-expandido borda-arredondada width-300"
                                        id=""
                                        value="">
                                </label>
                                <label for="desc">Descricao: <br>
                                    <textarea name="desc" class="form-control form-expandido area-text borda-arredondada btn-left width-400"
                                            id=""
                                            rows="5">

                                    </textarea>
                                </label>
                                <label class="input-alin-neil" for="stock">Estoque
                                    <input name="stock" type="number" class="form-control form-expandido borda-arredondada"
                                        id=""
                                        value="">
                                    
                                </label>

                                <label for="date">Data:
                                    <input name="date" type="date"
                                        class="form-control form-expandido datetimepicker borda-arredondada btn-left"
                                        id=""
                                        value="">
                                </label>

                                <label class="input-alin-neil" for="price">Preço:
                                    <input name="price" type="number"
                                        class="form-control form-expandido  borda-arredondada"
                                        id=""
                                        value="">
                                </label>

                                <label  class="input-alin-neil" for="img">Img Name: <br>
                                    <input name="img" type="text"
                                        class="form-control form-expandido borda-arredondada"
                                        id=""
                                        value="">
                                </label>
                                <label class="input-alin-neil" for="ef1">Ef1:
                                    <input name="ef1" type="number"
                                        class="form-control form-expandido  borda-arredondada "
                                        id=""
                                        value="">
                                </label>
                                <label class="input-alin-neil" for="efv1">Efv1:
                                    <input name="efv1" type="number"
                                        class="form-control form-expandido  borda-arredondada "
                                        id=""
                                        value="">
                                </label>
                                <label class="input-alin-neil" for="ef2">Ef2:
                                    <input name="ef2" type="number"
                                        class="form-control form-expandido  borda-arredondada"
                                        id=""
                                        value="">
                                </label>
                                <label class="input-alin-neil" for="efv2">Efv2:
                                    <input name="efv2" type="number"
                                        class="form-control form-expandido  borda-arredondada"
                                        id=""
                                        value="">
                                </label>
                                <label class="input-alin-neil" for="ef3">Ef3:
                                    <input name="ef3" type="number"
                                        class="form-control form-expandido  borda-arredondada"
                                        id=""
                                        value="">
                                </label>
                                <label class="input-alin-neil" for="efv3">Efv3:
                                    <input name="efv3" type="number"
                                        class="form-control form-expandido  borda-arredondada"
                                        id=""
                                        value="">
                                </label>

                                <label for="id_cat"><div class="txt-mini">{{trans('site.category')}}</div>
                                    <select id="id-cat" name="cat_id"
                                            class="form-control">
                                        <option value="99">Selecione uma Categoria</option>
                                        @foreach($cat as $category)
    
                                            <option value="{{$category->id}}">{{$category->name}}</option>
    
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default pull-left"
                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                            <button id="submit-neil" type="submit"
                                    class="btn btn-primary ">{!! trans('site.create') !!}</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </form>
    </div>

    {{-- <div class="justify-content-sm-center">
        <div class="col-xs-12">
            <div class="box"> --}}
                <div class="box-header">
                    <h3 class="box-title">{{strtoupper(trans('site.neil'))}}</h3>
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
                    <button id="id-new-noticia" type="submit" data-toggle="modal"
                            data-target="#modal-adm-neil-criar"
                            class="btn btn-success btn-new-noticia">{!! trans('site.create') !!}</button>
                </div>
                <!-- /.box-header -->
                {{-- <div class="box-body table-noticia-sao"> --}}
                    <table id="lista-news"

                           class="table table-bordered table-hover table-panel" style="width:100%">

                        <thead>
                        <tr class="titulo">
                            <th>IMG:</th>
                            <th>ID:</th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.item'))}}:</th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.name'))}}:</th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.desc'))}}:</th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.stock'))}}:</th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.category'))}}:</th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.price'))}}:</th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.date'))}}: </th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.ef1'))}}: </th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.efv1'))}}: </th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.ef2'))}}: </th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.efv2'))}}: </th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.ef3'))}}: </th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.efv3'))}}: </th>
                            <th class="font-admin-neil">{{strtoupper(trans('site.action'))}}:</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($neil as $Neil)
                            <div class=" modal fade" id="modal-adm-neil-{{$Neil->id}}" data-backdrop="static">
                                <form method="POST" id="form-uNeil" action="{{url('/uNeil')}}" enctype="multipart/form-data">
                                     {{csrf_field()}}
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content borda-arredondada">
                                        <div class="modal-header">
                                            <p><b><h4> {!! trans('site.item') !!}!</h4></b></p>
                                            <input name="id" type="text" hidden class="" id="neil-{{$Neil->id}}" value="{{$Neil->id}}">
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="img-item">
                                                    <div class="uploadFile">IMG:
                                                        <input id="uploadFile" placeholder="Selecione a imagem" disabled="disabled"/>
                                                    </div>
                                                    <div class="fileUpload btn btn-primary">
                                                        <span>Upload</span>
                                                        <input id="img-item" name="img_item" type="file" class="upload"/>
                                                    </div>
                                                </label>
                
                                                <label class="input-alin-neil" for="item_id">Item ID: <br>
                                                    <input name="item_id" type="number"
                                                        class="form-control form-expandido borda-arredondada "
                                                        id=""
                                                        value="{{$Neil->item_id}}">
                                                </label>
                
                                                <label for="name">Nome: <br>
                                                    <input name="name" type="text"
                                                        class="form-control form-expandido borda-arredondada width-300"
                                                        id=""
                                                        value="{{$Neil->name}}">
                                                </label>
                                                <label for="desc">Descricao: <br>
                                                    <textarea name="desc" class="form-control form-expandido area-text borda-arredondada btn-left width-400"
                                                            id=""
                                                            rows="5">
{{$Neil->desc}}               
                                                    </textarea>
                                                </label>
                                                <label class="input-alin-neil" for="stock">Estoque
                                                    <input name="stock" type="number" class="form-control form-expandido borda-arredondada"
                                                        id=""
                                                        value="{{$Neil->stock}}">
                                                    
                                                </label>
                
                                                <label class="" for="date">Data:
                                                    <input name="date" type="date"
                                                        class="form-control form-expandido datetimepicker borda-arredondada"
                                                        id=""
                                                        value="{{ date("Y-m-d",strtotime($Neil->date))}}">
                                                </label>
                
                                                <label class="input-alin-neil" for="price">Preço:
                                                    <input name="price" type="number"
                                                        class="form-control form-expandido  borda-arredondada "
                                                        id=""
                                                        value="{{$Neil->price}}">
                                                </label>
                
                                                <label class="input-alin-neil" for="img">Img Name: <br>
                                                    <input name="img" type="text"
                                                        class="form-control form-expandido borda-arredondada "
                                                        id=""
                                                        value="{{$Neil->img}}">
                                                </label>
                                                <label class="input-alin-neil" for="ef1">Ef1:
                                                    <input name="ef1" type="number"
                                                        class="form-control form-expandido  borda-arredondada"
                                                        id=""
                                                        value="{{$Neil->ef1}}">
                                                </label>
                                                <label class="input-alin-neil" for="efv1">Efv1:
                                                    <input name="efv1" type="number"
                                                        class="form-control form-expandido  borda-arredondada "
                                                        id=""
                                                        value="{{$Neil->efv1}}">
                                                </label>
                                                <label class="input-alin-neil" for="ef2">Ef2:
                                                    <input name="ef2" type="number"
                                                        class="form-control form-expandido  borda-arredondada "
                                                        id=""
                                                        value="{{$Neil->ef2}}">
                                                </label>
                                                <label class="input-alin-neil" for="efv2">Efv2:
                                                    <input name="efv2" type="number"
                                                        class="form-control form-expandido  borda-arredondada "
                                                        id=""
                                                        value="{{$Neil->efv2}}">
                                                </label>
                                                <label class="input-alin-neil" for="ef3">Ef3:
                                                    <input name="ef3" type="number"
                                                        class="form-control form-expandido  borda-arredondada "
                                                        id=""
                                                        value="{{$Neil->ef3}}">
                                                </label>
                                                <label class="input-alin-neil" for="efv3">Efv3:
                                                    <input name="efv3" type="number"
                                                        class="form-control form-expandido  borda-arredondada "
                                                        id=""
                                                        value="{{$Neil->efv3}}">
                                                </label>
                
                                                <label for="id_cat"><div class="txt-mini">{{trans('site.category')}}</div>
                                                    <select id="id-cat" name="cat_id"
                                                            class="form-control">
                                                        <option value="99">Selecione uma Categoria</option>
                                                        @foreach($cat as $category)
                                                            @if ($Neil->cat_id == $category->id)
                                                                <option selected
                                                                value="{{$category->id}}">{{$category->name}}</option>
                                                            @else
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endif
                                                            
                                                        @endforeach
                                                    </select>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default pull-left btn-cancel-noticia"
                                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                            <button id="idsubmit-{{$Neil->id}}" type="submit"
                                                    class="btn btn-primary btn-save-noticia">{!! trans('site.save') !!}</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                                 </form>
                            </div>


                            <tr class="text">
                                <td><img class="btn-right btn-admin-neil" src="{{asset('img/neil/'.$Neil->img.'.gif')}}"></td>
                                <td class="font-admin-neil">{{$Neil->id}}</td>
                                <td class="font-admin-neil">{{$Neil->item_id}}</td>
                                <td class="font-admin-neil">{{$Neil->name}}</td>
                                <td class="font-admin-neil">{{$Neil->desc}}</td>
                                <td class="font-admin-neil">{{$Neil->stock}}</td>
                                <td class="font-admin-neil">{{$Neil->category}}</td>
                                <td class="font-admin-neil">{{number_format($Neil->price, 2,',','.')}}</td>
                                <td class="font-admin-neil">{{date("d/m/Y", strtotime($Neil->date))}}</td>
                                <td class="font-admin-neil">{{$Neil->ef1}}</td>
                                <td class="font-admin-neil">{{$Neil->efv1}}</td>
                                <td class="font-admin-neil">{{$Neil->ef2}}</td>
                                <td class="font-admin-neil">{{$Neil->efv2}}</td>
                                <td class="font-admin-neil">{{$Neil->ef3}}</td>
                                <td class="font-admin-neil">{{$Neil->efv3}}</td>
                                <td>
                                    <button type="submit"
                                        class="btn btn-warning glyphicon glyphicon-pencil edit-adm-noticia btn-edit-del"
                                        title="{{trans('site.edit')}} {{trans('site.item')}}"
                                        data-toggle="modal"
                                        data-target="#modal-adm-neil-{{$Neil->id}}">
                                            <p>{{trans('site.edit')}}</p>
                                    </button>

                                    <form method="POST" id="form-dNeil" action="{{url('/dNeil')}}" enctype="multipart/form-data">
                                         {{csrf_field()}}
                                         <div hidden>
                                            <input id="id-{{$Neil->id}}"name="id" value="{{$Neil->id}}">
                                         </div>
                                   
                                        <button id="iddel-{{$Neil->id}}" type="submit"
                                                class="btn btn-danger glyphicon glyphicon-remove excluir-adm-noticia btn-edit-del"
                                                title="{{trans('site.delete')}} {{trans('site.item')}}">
                                                    <p>{{trans('site.delete')}}</p>
                                        </button>
                                    </form>
                                </td>

                            </tr>

                        @empty
                            <td> {!! trans('site.none_f') !!} {!! trans('site.news') !!} {!! trans('site.found_f') !!}
                                ...
                            </td>
                        @endforelse

                        </tbody>

                    </table>

                {{-- </div> --}}
                <!-- /.box-body -->
            {{-- </div> --}}
            <!-- /.box -->
        {{-- </div> --}}
        <!-- /.col -->
    {{-- </div> --}}
    <!-- /.row -->

@stop

@section('footer')
     @include('layouts.footer')
@stop