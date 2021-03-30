@extends('adminlte::page')


@section('title', 'Star => News')
@section('content_header')
    {{-- <p>{!! trans('txt_lang.msg_panel_admin_news') !!} » {!! trans('site.welcome') !!}!!! » <b>{{$user->name}}</b></p> --}}
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
    <div class=" modal fade" id="modal-adm-noticia-criar" data-backdrop="static">
            <form method="POST" id="form-news" action="{{url('/cNews')}}" enctype="multipart/form-data">
              {{csrf_field()}}
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content borda-arredondada">
                        <div class="modal-header">
                            <p><b><h4> {!! trans('site.news') !!}!</h4></b></p>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="titulo">Titulo: <br>
                                    <input name="title" type="text"
                                        class="form-control form-expandido borda-arredondada btn-left width-400"
                                        id="titulo-criar"
                                        value="">
                                </label>
                                <label for="noticia">Noticia: <br>
                                    <textarea name="news" class="form-control form-expandido area-text borda-arredondada btn-left width-400"
                                            id="noticia-criar"
                                            rows="5">

                                    </textarea>
                                </label>
                                <label for="categoria">Categoria: 1 = news, 2 = update, 3 = att
                                    <input name="type" type="text" class="form-control form-expandido borda-arredondada btn-left"
                                        id="categoria-criar"
                                        value="">
                                    
                                </label>

                                <label for="data">Data:
                                    <input name="date" type="date"
                                        class="form-control form-expandido datetimepicker borda-arredondada btn-left"
                                        id="data-criar"
                                        value="">
                                </label>

                                <label for="data">Hora:
                                    <input name="hour" type="time"
                                        class="form-control form-expandido datetimepicker borda-arredondada btn-left"
                                        id="data-criar"
                                        value="">
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default pull-left btn-cancel-noticia"
                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                            <button id="submit-noticia" type="submit"
                                    class="btn btn-primary btn-create-noticia">{!! trans('site.create') !!}</button>
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
                    <h3 class="box-title">{{strtoupper(trans('site.news_p'))}}</h3>
                    <button id="id-new-noticia" type="submit" data-toggle="modal"
                            data-target="#modal-adm-noticia-criar"
                            class="btn btn-success btn-new-noticia">{!! trans('site.create') !!}</button>
                </div>
                <!-- /.box-header -->
                {{-- <div class="box-body table-noticia-sao"> --}}
                    <table id="lista-news"

                           class="table table-bordered table-hover table-panel" style="width:100%">

                        <thead>
                        <tr class="titulo">
                            <th>ID:</th>
                            <th>{{strtoupper(trans('site.title'))}}:</th>
                            <th>{{strtoupper(trans('site.news'))}}:</th>
                            <th>{{strtoupper(trans('site.type'))}}:</th>
                            <th>{{strtoupper(trans('site.date'))}}:</th>
                            <th>{{strtoupper(trans('site.hour'))}}:</th>
                            <th>{{strtoupper(trans('site.autor'))}}: </th>
                            <th>{{strtoupper(trans('site.action'))}}:</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($news as $noticia)
                            <div class=" modal fade" id="modal-adm-noticia-{{$noticia->id}}" data-backdrop="static">
                                <form method="POST" id="form-uNews" action="{{url('/uNews')}}" enctype="multipart/form-data">
                                     {{csrf_field()}}
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content borda-arredondada">
                                        <div class="modal-header">
                                            <p><b><h4> {!! trans('site.news') !!}!</h4></b></p>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="id_noticia">ID:
                                                    <input name="id" readonly type="text"
                                                           id="id-{{$noticia->id}}"
                                                           class="form-control form-expandido borda-arredondada btn-left"
                                                           value="{{$noticia->id}}">
                                                </label>
                                                <label for="titulo">Titulo: <br>
                                                    <input name="title" type="text"
                                                           class="form-control form-expandido borda-arredondada btn-left width-400"
                                                           id="titulo-{{$noticia->id}}"
                                                           value="{{$noticia->title}}">
                                                </label>
                                                <label for="noticia">Noticia:<br>
                                                    <textarea name="news"
                                                              class="form-control form-expandido area-text borda-arredondada btn-left width-400"
                                                              id="noticia-{{$noticia->id}}"
                                                              rows="5">
{{$noticia->news}}
                                                    </textarea>
                                                </label>
                                                <label for="categoria">Categoria: 1 = news, 2 = update, 3 = att
                                                    <input name="type" type="text"
                                                           class="form-control form-expandido borda-arredondada btn-left"
                                                           id="categoria-{{$noticia->id}}"
                                                           value="{{$noticia->type}}">
                                                    
                                                </label>

                                                <label for="data">Data:
                                                    <input name="date" type="date"
                                                           class="form-control form-expandido datetimepicker borda-arredondada btn-left"
                                                           id="date-{{$noticia->id}}"
                                                           value="{{$noticia->date}}">
                                                </label>
                                                <label for="data">Hora:
                                                    <input name="hour" type="time"
                                                           class="form-control form-expandido datetimepicker borda-arredondada btn-left"
                                                           id="hour-{{$noticia->id}}"
                                                           value="{{$noticia->hour}}">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default pull-left btn-cancel-noticia"
                                                    data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                            <button id="idsubmit-{{$noticia->id}}" type="submit"
                                                    class="btn btn-primary btn-save-noticia">{!! trans('site.save') !!}</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                                 </form>
                            </div>


                            <tr class="text">
                                <td>{{$noticia->id}}</td>
                                <td>{{ $noticia->title }}</td>
                                <td>{{ $noticia->news }}</td>
                                <td>{{ $noticia->type }}</td>
                                <td>{{date("d/m/Y", strtotime($noticia->date))}}</td>
                                <td>{{ $noticia->hour }}</td>
                                <td>{{ $noticia->autor }}</td>
                                <td>
                                    <button type="submit"
                                        class="btn btn-warning glyphicon glyphicon-pencil edit-adm-noticia btn-edit-del"
                                        title="{{trans('site.edit')}} {{trans('site.news')}}"
                                        data-toggle="modal"
                                        data-target="#modal-adm-noticia-{{$noticia->id}}">
                                            <p>{{trans('site.edit')}}</p>
                                    </button>

                                    <form method="POST" id="form-dNews" action="{{url('/dNews')}}" enctype="multipart/form-data">
                                         {{csrf_field()}}
                                         <div hidden>
                                            <input id="id-{{$noticia->id}}"name="id" value="{{$noticia->id}}">
                                         </div>
                                   
                                        <button id="iddel-{{$noticia->id}}" type="submit"
                                                class="btn btn-danger glyphicon glyphicon-remove excluir-adm-noticia btn-edit-del"
                                                title="{{trans('site.delete')}} {{trans('site.news')}}">
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