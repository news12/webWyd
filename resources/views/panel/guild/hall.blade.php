@extends('adminlte::page')

@section('title', 'Guild Hall')

@section('content_header')

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
                        @foreach ($char as $Char)
                            <li class="nav-item">
                                <a href="#char-{{$Char->id}}" class="{{($loop->first) ? 'nav-link' : 'nav-link'}}" data-toggle="tab">{{$Char->name}}</a>
                            </li>
                            
                        @endforeach
                      
                     
                    </ul>
                </div>
                <div class="card-body no-padding">
                    <div class="tab-content">
                            @foreach ($char as $Char)
                                <!-- inicio modal-donate -->
                                <div class=" modal fade" id="modal-gh-donate-{{$Char->id}}" data-backdrop="static">
                                    <form method="POST" id="form-gh-donate" action="{{url('/ghDonate')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content borda-arredondada">
                                                    <div class="modal-header modal-dark">
                                                        <p> 
                                                            <h1>{{trans('site.donate')}}!</h1>
                                                            <input name="id" type="text" hidden class="" id="gh-{{$Char->id}}" value="{{$Char->id}}">
                                                        </p>
                                                       
                                                    </div>
                                                    <div class="modal-body modal-dark">
                                                            <div class="form-group">
                                                                
                                                                <label for="gold"><div class="txt-dark">{{trans('site.coin')}}</div>
                                                                    <select id="gold" name="gold" class="form-control select-dark">
                                                                        <option class="select-dark" value="0">Selecione uma Valor</option>
                                                                        <option class="select-dark" value="5">5kk</option>
                                                                        <option class="select-dark" value="10">10kk</option>
                                                                        <option class="select-dark" value="30">30kk</option>
                                                                        <option class="select-dark" value="50">50kk</option>
                                                                    </select>
                                                                </label>

                                                                <label for="fame"><div class="txt-dark">{{trans('site.fame')}}</div>
                                                                    <select id="fame" name="fame" class="form-control select-dark">
                                                                        <option class="select-dark" value="0">Selecione uma Valor</option>
                                                                        <option class="select-dark" value="5">100</option>
                                                                        <option class="select-dark" value="10">300</option>
                                                                        <option class="select-dark" value="30">500</option>
                                                                        <option class="select-dark" value="50">1000</option>
                                                                    </select>
                                                                </label>

                                                            </div>
                                                                
                            
                                                    </div>
                                                
                                                    <div class="modal-footer modal-dark">
                                                        <button type="button" class="btn btn-danger pull-left btn-cancel-item"
                                                                data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                        <button id="idsubmit-{{$Char->id}}" type="submit"
                                                                class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                                    </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </form>
                            </div>
                            <!-- fim modal-donate -->
                            <!-- inicio modal-exit -->
                                <div class=" modal fade" id="modal-gh-exit-{{$Char->id}}" data-backdrop="static">
                                    <form method="POST" id="form-gh-exit" action="{{url('/ghInOut')}}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content borda-arredondada">
                                                    <div class="modal-header modal-dark">
                                                        <p> 
                                                            <h2>Deseja Realmente sair da Guild??</h2>
                                                            <input name="char_id" type="text" hidden class="" id="gh-{{$Char->id}}" value="{{$Char->id}}">
                                                            <input name="ntype" type="number" hidden class="" id="gh-ntype" value="1">
                                                        </p>
                                                       
                                                    </div>
                                                    <div class="modal-body modal-dark">
                                                        @php
                                                            $price = ($Char->evo + 1) *5000000;
                                                        @endphp
                                                            <div class="form-group">
                                                                <p>Será necessário pagar uma taxa de {{number_format($price, 2,',','.')}} de gold.</p>
                                                               <p>Ao sair da guild você perderá todo seu progresso de contribuição!!</p>

                                                            </div>
                                                                
                            
                                                    </div>
                                                
                                                    <div class="modal-footer modal-dark">
                                                        <button type="button" class="btn btn-danger pull-left btn-cancel-item"
                                                                data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                        <button id="idsubmit-{{$Char->id}}" type="submit"
                                                                class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                                    </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </form>
                            </div>
                            <!-- fim modal-exit -->
                             
                                <!-- inicio modal-log -->
                                <div class=" modal fade" id="modal-gh-log-{{$Char->id}}" data-backdrop="static">
                                    
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content borda-arredondada">
                                                    <div class="modal-header modal-dark">
                                                        <p> 
                                                            <h1>{{trans('site.log')}} {{trans('site.guild')}}!</h1>
                                                            
                                                        </p>
                                                       
                                                    </div>
                                                    <div class="modal-body modal-dark hg-body-log">
                                                        <table class="table table-dark table-head-fixed">
                                                            <thead>
                                                              <tr>
                                                                <th>Descrição</th>
                                                                <th>Data</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($log as $Log)
    
                                                                    @if ($Char->guildindex == $Log->guild_id)
                                                                        <tr>
                                                                            <td>{{$Log->log}}</td>
                                                                            <td>{{$Log->date}}</td>
                                                                        </tr>
                                                                    @endif
    
                                                                @endforeach
                                                             
                                                            </tbody>
                                                          </table>  
                                                                
                                                    </div>
                                                
                                                    <div class="modal-footer modal-dark">
                                                        <button type="button" class="btn btn-danger pull-left btn-cancel-item"
                                                                data-dismiss="modal">{!! trans('site.back') !!}</button>
                                                        
                                                    </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    
                            </div>
                            <!-- fim modal-log -->
                                <div class="tab-pane fade" id="char-{{$Char->id}}">
                                    @foreach ($guild as $Guild)
                               
                                        @if ($Guild->id == $Char->guildindex)
                                               <!-- inicio modal-leader -->
                                                <div class=" modal fade" id="modal-gh-panel-{{$Char->id}}" data-backdrop="static">
                                                    {{-- <form method="POST" id="form-gh-panel" action="{{url('/ghPanel')}}" enctype="multipart/form-data">
                                                        {{csrf_field()}} --}}
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content borda-arredondada">
                                                                    <div class="modal-header modal-dark modal-header-panel">
                                                                        <p> 
                                                                            <h1>{{trans('site.panel')}} {{trans('site.leader')}}!</h1>
                                                                            <input name="id" type="text" hidden class="" id="gh-{{$Char->id}}" value="{{$Char->id}}">
                                                                        </p>
                                                                    
                                                                    </div>
                                                                    <div class="modal-body modal-dark hg-body-panel-leader">
                                                                            <div class="form-group">

                                                                                <label for="gold"><div class="txt-dark txt-impost">{{trans('site.coin')}}</div>
                                                                                    <input name="gold" readonly type="text"
                                                                                        id="gold-{{$Guild->id}}"
                                                                                        class="borda-arredondada btn-left 
                                                                                        bg-gradient-warning text-dark border border-warning gh-input-panel-gold"
                                                                                        value="{{number_format($Guild->gold, 2,',','.')}}">
                                                                                </label>
                                                                                
                                                                                <label for="gold"><div class="txt-dark txt-impost">Max</div>
                                                                                    <input name="max_gold" readonly type="text"
                                                                                        id="max-{{$Guild->id}}"
                                                                                        class="borda-arredondada btn-left 
                                                                                        bg-gradient-warning text-dark border border-warning gh-input-panel-gold"
                                                                                        value="{{number_format($Guild->max_gold, 2,',','.')}}">
                                                                                </label>

                                                                    
                                                                                <label for="gold-max-week"><div class="txt-dark txt-impost">Max | {{trans('site.week')}}</div>
                                                                                    <input name="max_gold_week" readonly type="text"
                                                                                        id="max-week-{{$Guild->id}}"
                                                                                        class="borda-arredondada btn-left 
                                                                                        bg-gradient-warning text-dark border border-warning gh-input-panel-gold"
                                                                                        value="{{number_format($Guild->max_gold_week, 2,',','.')}}">
                                                                                </label>

                                                                                <label for="gold-week"><div class="txt-dark txt-impost">{{trans('site.loot')}} | {{trans('site.week')}}</div>
                                                                                    <input name="gold_week" readonly type="text"
                                                                                        id="week-{{$Guild->id}}"
                                                                                        class="borda-arredondada btn-left 
                                                                                        bg-gradient-warning text-dark border border-warning gh-input-panel-gold"
                                                                                        value="{{number_format($Guild->gold_week, 2,',','.')}}">
                                                                                </label>

                                                                                <label for="take"><div class="txt-dark txt-impost">{{trans('site.take')}}</div>
                                                                                    <form method="POST" id="form-gh-take" action="{{url('/ghTake')}}" enctype="multipart/form-data">
                                                                                        {{csrf_field()}}
                                                                                        <input name="take" type="number"
                                                                                            id="take-{{$Guild->id}}"
                                                                                            class="borda-arredondada btn-left 
                                                                                            bg-gradient-warning text-dark border border-warning gh-input-panel-gold"
                                                                                            placeholder="valor a ser retirado"
                                                                                            value="">
                                                                                            <button class="btn btn-success gh-btn-take"  type="submit">
                                                                                                <p>{!! trans('site.take')!!}</p>
                                                                                            </button>
                                                                                    </form>
                                                                                </label>

                                                                                <div class="gh-panel">
                                                                                        @foreach ($city as $pCity)
                                                                                            @if ($Guild->id == $pCity->guild_index)
                                                                                                <div class="gh-panel-city">
                                                                                                   <div class="txt-dark title-city">{{$pCity->name}}</div>
                                                                                                        <div class="gh-impost">
                                                                                                            <form method="POST" id="form-gh-impot{{$pCity->name}}" action="{{url('/ghImpost')}}" enctype="multipart/form-data">
                                                                                                                {{csrf_field()}}
                                                                                                                <p>Imposto Acumulado</p>
                                                                                                                <input name="city" type="text" hidden class="" id="gh-city{{$pCity->id}}" value="{{$pCity->id}}">
                                                                                                                <input name="impost" type="text" readonly
                                                                                                                    id="impost-{{$pCity->id}}"
                                                                                                                    class="borda-arredondada gh-input-panel
                                                                                                                    bg-gradient-warning text-dark border border-warning"
                                                                                                                    value="{{number_format($pCity->impost,2,',','.')}}">
                                                                                                                    <button class="btn btn-success  gh-btn-panel"  type="submit">
                                                                                                                        <p>{!! trans('site.retract')!!}</p>
                                                                                                                    </button>
                                                                                                            </form>
                                                                                                        </div>
                                                                                                       
                                                                                                           <div class="gh-tax">
                                                                                                                <form method="POST" id="form-gh-taz{{$pCity->name}}" action="{{url('/ghTax')}}" enctype="multipart/form-data">
                                                                                                                    {{csrf_field()}}
                                                                                                                    <p>Taxa (10% max.)</p>
                                                                                                                    <input name="city" type="text" hidden class="" id="gh-city{{$pCity->id}}" value="{{$pCity->id}}">
                                                                                                                        <input name="tax" type="number" step="0.010"
                                                                                                                            id="tax-{{$Guild->id}}"
                                                                                                                            class="borda-arredondada gh-input-panel-tax
                                                                                                                            bg-gradient-warning text-dark border border-warning"
                                                                                                    
                                                                                                                            value="{{$pCity->tax}}">
                                                                                                                            <button class="btn btn-success gh-btn-panel"  type="submit">
                                                                                                                                <p>{!! trans('site.change')!!}</p>
                                                                                                                            </button>
                                                                                                                </form>
                                                                                                            </div>         
                                                                                                       
                                                                                                   
                                                                                                      
                                                                                                </div>
                                                                                            @endif
                                                                                        @endforeach
                                                                                </div>

                                                                            </div>
                                                                                
                                            
                                                                    </div>
                                                                
                                                                    <div class="modal-footer modal-dark">
                                                                        <div class="gh-panel-warning">
                                                                            <p>ATENÇÃO: Antes de fazer qualquer retirada, certifique-se de ter espaço no bau, valor acima do maximo permitido será perdido!!</p>
                                                                        </div>
                                                                         <form method="POST" id="form-gh-panel" action="{{url('/guildMark')}}" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="fileUpload btn btn-success btn-upload">
                                                                                <input name="guild_id" type="text" hidden class="" id="gh-{{$Guild->id}}" value="{{$Guild->id}}">
                                                                                <span>Upload GuildMark</span>
                                                                                <input id="img-item" name="imgFile" type="file" class="upload"/>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-warning pull-left btn-cancel-item">
                                                                                {!! trans('site.submit') !!} {!! trans('site.guildmark') !!}
                                                                            </button>
                                                                         </form>
                                                                        <button type="button" class="btn btn-danger pull-left btn-cancel-item"
                                                                                data-dismiss="modal">{!! trans('site.back') !!}</button>
                                                                        {{-- <button id="idsubmit-{{$Char->id}}" type="submit"
                                                                                class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button> --}}
                                                                    </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    {{-- </form> --}}
                                            </div>
                                        <!-- fim modal-leader -->
                                            <div class="card card-outline card-dark card-guild-hall">
                                                <div class="card-header card-header-hall">
                                                    <div class="gh-name">{{ trans('site.guild') }}:</div>
                                                    <div class="name-desc">{{$Guild->name}}</div>
                                                    <div class ="gh-fame">{{ trans('site.fame')}}:</div>
                                                    <div class= "name-desc">{{number_format($Guild->fame, 2,',','.')}}</div>     
                                                    <div class ="gh-gold">{{ trans('site.coin')}}:</div>
                                                    <div class= "name-desc">{{number_format($Guild->gold, 2,',','.')}}</div>     
                                                    <div class ="gh-level">{{ trans('site.lvl')}}:</div>
                                                    <div class= "name-desc name-mini">{{$Guild->level}}</div>      
                                                    <div class="card-tools">
                                                        <!-- Buttons, labels, and many other things can be placed here! -->
                                                        <!-- Here is a label for example -->
                                                        {{-- <img class="ribon-img" src="{{asset('img/guild/'.$Guild->img.'.gif')}}"> --}}
                                                    
                                                    </div>
                                                <!-- /.card-tools -->
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body card-body-hall">
                                                    <table class="table table-dark table-head-fixed">
                                                        <thead>
                                                          <tr>
                                                            <th>Cargo</th>
                                                            <th>Player</th>
                                                            <th>Classe</th>
                                                            <th>Master</th>
                                                            <th>Lv.</th>
                                                            <th>Fame</th>
                                                            <th>Contribuição</th>
                                                            <th>Status</th>
                                                            @if ($Char->membertype > 0)
                                                            <th>Ação</th>
                                                            @endif
                                                          </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $MemberOn = 0;
                                                            $MemberOff = 0;
                                                            $MemberTotal = 0;
                                                            $applyTotal = 0;
                                                            @endphp
                                                         
                                                            @foreach ($member as $Member)
                                                                @if ($Guild->id == $Member->guildindex)
                                                                        <!-- inicio modal-kick -->
                                                                        <div class=" modal fade" id="modal-gh-kick-{{$Member->id}}" data-backdrop="static">
                                                                            <form method="POST" id="form-gh-kick" action="{{url('/ghInOut')}}" enctype="multipart/form-data">
                                                                                {{csrf_field()}}
                                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                    <div class="modal-content borda-arredondada">
                                                                                            <div class="modal-header modal-dark">
                                                                                                <p> 
                                                                                                    <h2>Expulsar da Guild</h2>
                                                                                                    <input name="char_id" type="text" hidden class="" id="gh-{{$Char->id}}" value="{{$Char->id}}">
                                                                                                    <input name="target" type="text" hidden class="" id="gh-{{$Member->id}}" value="{{$Member->id}}">
                                                                                                    <input name="target_account_id" type="text" hidden class="" id="gh-{{$Member->accountID}}" value="{{$Member->accountID}}">
                                                                                                    <input name="ntype" type="number" hidden class="" id="gh-ntype" value="2">
                                                                                                </p>
                                                                                            
                                                                                            </div>
                                                                                            <div class="modal-body modal-dark">
                                                                                                    <div class="form-group">
                                                                                                        <p>Deseja Realmente expulsar o jogador [{!! $Member->name !!}]</p>
                                                                                                    <p>Ao ser expulso da guild ele perderá todo seu progresso de contribuição!!</p>

                                                                                                    </div>
                                                                                                        

                                                                                            </div>
                                                                                        
                                                                                            <div class="modal-footer modal-dark">
                                                                                                <button type="button" class="btn btn-danger pull-left btn-cancel-item"
                                                                                                        data-dismiss="modal">{!! trans('site.cancel') !!}</button>
                                                                                                <button id="idsubmit-{{$Char->id}}" type="submit"
                                                                                                        class="btn btn-success btn-save-item">{!! trans('site.confirm') !!}</button>
                                                                                            </div>
                                                                                    </div>
                                                                                    <!-- /.modal-content -->
                                                                                </div>
                                                                                <!-- /.modal-dialog -->
                                                                            </form>
                                                                        </div>
                                                                        <!-- fim modal-kick -->
                                                                    <tr>
                                                                        <td>{{$Member->office}}</td>
                                                                        <td>{{$Member->name}}</td>
                                                                        <td>{{$Member->classe_name}}</td>
                                                                        <td><span class="tag tag-success">{{$Member->evo_name}}</span></td>
                                                                        <td>{{$Member->_level}}</td>
                                                                        <td>{{number_format($Member->fame, 2,',','.')}}</td>
                                                                        <td>{{$Member->contribuition}}</td>
                                                                        @foreach ($user as $User)

                                                                            @if ($User->id == $Member->accountID)
                                                                                @if ($User->slotid == $Member->slotid)
                                                                                    <td class="green">On</td>   
                                                                                    @php
                                                                                        $MemberOn++
                                                                                    @endphp
                                                                                @else
                                                                                    <td class="red">Off</td> 
                                                                                    @php
                                                                                        $MemberOff++
                                                                                     @endphp
                                                                                @endif
                                                                                @php
                                                                                    $MemberTotal++
                                                                                @endphp
                                                                            @endif
                                                                           
                                                                        @endforeach

                                                                        @if ($Char->membertype ==2 && $Char->id == $Member->id)
                                                                            <td>
                                                                            
                                                                                <button class="btn btn-warning gh-btn-action-office"  data-toggle="modal"
                                                                                    data-target="#modal-gh-panel-{{$Member->id}}"><p>{!! trans('site.panel')!!}</p></button>
                                                                            </td>
                                                                        @endif

                                                                        @if ($Char->membertype && $Char->id != $Member->id && !$Member->membertype)
                                                                            <td>
                                                                                {{-- <button class="btn btn-warning gh-btn-action-office"  data-toggle="modal"
                                                                                    data-target="#modal-gh-action-edit-{{$Char->id}}"><p>{!! trans('site.edit')!!}</p></button> --}}
                                                                                <button class="btn btn-warning gh-btn-action-office"  data-toggle="modal"
                                                                                    data-target="#modal-gh-kick-{{$Member->id}}"><p>{!! trans('site.kick')!!}</p></button>
                                                                            </td>
                                                                        @endif
                                                                       
                                                                    </tr>
                                                                @endif

                                                            @endforeach
                                                         
                                                        </tbody>
                                                      </table>
                                                          <!-- inicio modal-apply -->
                                                          <div class=" modal fade" id="modal-gh-apply-{{$Guild->id}}" data-backdrop="static">
                                                            {{-- <form method="POST" id="form-gh-apply" action="{{url('/gRecruit')}}" enctype="multipart/form-data">
                                                                {{csrf_field()}}       --}}
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content borda-arredondada gh-modal-apply">
                                                                            <div class="modal-header modal-dark">
                                                                                <p> 
                                                                                    <h1>{{trans('site.guild')}} {{trans('site.application')}}!</h1>
                                                                                    
                                                                                </p>
                                                                            
                                                                            </div>
                                                                            <div class="modal-body modal-dark hg-body-apply">
                                                                                <table class="table table-dark table-head-fixed">
                                                                                    <thead>
                                                                                    <tr>
                                                                                        <th>{{trans('site.date')}}</th>
                                                                                        <th>{{trans('site.player')}}</th>
                                                                                        <th>{{trans('site.lvl')}}</th>
                                                                                        <th>{{trans('site.masterclass')}}</th>
                                                                                        <th>{{trans('site.cost')}}</th>
                                                                                        <th>{{trans('site.action')}}</th>

                                                                                    </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($guild_apply as $Guild_apply)
                                                                                            @if ($Guild_apply->guild_id == $Guild->id && !$Guild_apply->ntype && !$Guild_apply->status)
                                                                                                @php
                                                                                                $applyTotal++;  
                                                                                                $evo = 'Mortal';
                                                                                                   switch ($Guild_apply->char_evo) 
                                                                                                   {
                                                                                                       case 0:
                                                                                                            $evo = 'MORTAL';
                                                                                                           break;

                                                                                                        case 1:
                                                                                                            $evo = 'ARCH';
                                                                                                           break;

                                                                                                        case 2:
                                                                                                            $evo = 'CELESTIAL';
                                                                                                           break;

                                                                                                        case 3:
                                                                                                            $evo = 'SUPER CELESTIAL';
                                                                                                           break;
                                                                                                       
                                                                                                       default:
                                                                                                            $evo = 'Indefinida';
                                                                                                           break;
                                                                                                   }
                                                                                                @endphp  
                                                                                            
                                                                                                        <tr>
                                                                                                            <td>{{date('d/m/Y',strtotime($Guild_apply->date))}}</td>
                                                                                                            <td>{{$Guild_apply->char_name}}</td>
                                                                                                            <td>{{$Guild_apply->char_level}}</td>
                                                                                                            <td>{{$evo}}</td>
                                                                                                            <td>{{number_format($Guild_apply->price, 2,',','.')}}</td>
                                                                                                            <td>
                                                                                                                <form method="POST" id="form-gh-refuse" action="{{url('/gRecruit')}}" enctype="multipart/form-data">
                                                                                                                {{csrf_field()}}      
                                                                                                                <input name="char_id" type="text" hidden class="" id="gh-refuse-{{$Char->id}}" value="{{$Char->id}}">
                                                                                                                <input name="target" type="text" hidden class="" id="gh-refuse-{{$Guild_apply->char_id}}" value="{{$Guild_apply->char_id}}">
                                                                                                                <input name="ntype" type="text" hidden class="" id="gh-refuse-{{$Guild_apply->char_id}}" value="1">

                                                                                                                <button class="btn btn-warning gh-btn-action-refuse" id="recusar"  data-toggle="modal"
                                                                                                                    data-target="#modal-gh-action-edit-{{$Char->id}}"><p>{!! trans('site.refuse')!!}</p></button>
                                                                                                                </form>
                                                                                                                <form method="POST" id="form-gh-apply" action="{{url('/gRecruit')}}" enctype="multipart/form-data">
                                                                                                                    {{csrf_field()}}      
                                                                                                                    <input name="char_id" type="text" hidden class="" id="gh-apply-{{$Char->id}}" value="{{$Char->id}}">
                                                                                                                    <input name="target" type="text" hidden class="" id="gh-apply-{{$Guild_apply->char_id}}" value="{{$Guild_apply->char_id}}">
                                                                                                                    <input name="ntype" type="text" hidden class="" id="gh-refuse-{{$Guild_apply->char_id}}" value="0">
    
                                                                                                                <button class="btn btn-warning gh-btn-action-apply"  id="aceitar" data-toggle="modal"
                                                                                                                    data-target="#modal-gh-kick-{{$Member->id}}"><p>{!! trans('site.accept')!!}</p></button>
                                                                                                                </form>
                                                                                                            </td>
                                                                                                           
                                                                                                        </tr>
                                                                                                
                                                                                            @endif
                                                                                            @endforeach
                                                                                    </tbody>
                                                                                </table>  
                                                                                                
                                                                            </div>
                                                                                
                                                                            <div class="modal-footer modal-dark">
                                                                                    <button type="button" class="btn btn-danger pull-left btn-cancel-item"
                                                                                        data-dismiss="modal">{!! trans('site.back') !!}</button>
                                                                                        
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            {{-- </form>           <!-- /.modal-content --> --}}
                                                        </div>
                                                         <!-- /.modal-apply -->
                                                    
                                                </div>
                                                <!-- /.card-body -->
                                                <div class="card-footer card-footer-hall">
                                                    <div class="gh-status-player">
                                                       <div class="gh-status-on">
                                                        {{$MemberOn}}
                                                       </div>
                                                       <div class="gh-status-off">
                                                        {{$MemberOff}}
                                                        </div>
                                                        <div class="gh-status-max">
                                                      {{$MemberTotal}} / {{$Guild->max_member}}
                                                        </div>
                                                    </div>
                                                    <div class="gh-ally-enemy">
                                                        <div class="gh-ally">
                                                            <p>NINGUEM</p>
                                                        </div>
                                                        <div class="gh-enemy">
                                                            <p>NINGUEM</p>
                                                        </div>
                                                    </div>
                                                    <div class="gh-btn-action">
                                                        <button class="btn btn-warning gh-btn-donate"  data-toggle="modal"
                                                        data-target="#modal-gh-donate-{{$Char->id}}"><p>{!! trans('site.donate')!!}</p></button>
                                                        <button class="btn btn-warning gh-btn-request" {{$Char->membertype < 1 ? 'disabled' : 'enabled'}} 
                                                            data-toggle="modal"data-target="#modal-gh-apply-{{$Guild->id}}">

                                                            @if ($applyTotal)
                                                                <div class="gh-apply-count"><p>{{$applyTotal}}</p></div>
                                                            @endif
                
                                                            <p>{!! trans('site.request')!!}</p>

                                                        </button>
                                                        <button class="btn btn-warning gh-btn-storage" data-toggle="modal"
                                                        data-target="#modal-gh-log-{{$Char->id}}"><p>{!! trans('site.log')!!}</p></button>
                                                    </div>
                                                    <div class="gh-city">
                                                        @foreach ($city as $City)
                                                            <div class="gh-{!! $City->name!!}">
                                                                <div class="gh-city-title">
                                                                    <div class="gh-p-title">{!! $City->name!!}</div>
                                                                </div>
                                                                <div class="gh-city-guild">
                                                                  <p>Dono:</p>
                                                                    
                                                                </div>
                                                                <div class="gh-city-guild-name">
                                                                    <p>{{$City->guild_index ? $City->guild : 'Livre'}}</p>
                                                                </div>
                                                                <div class="gh-city-tax">
                                                                    <p>Tax:</p> 
                                                                   
                                                                </div>
                                                                <div class="gh-city-tax-value">
                                                                    <p>{{$City->tax}}</p>
                                                                </div>
                                                            </div> 
                                                        @endforeach
                                                       
                                                    </div>
                                                  
                                                    <button type="submit"
                                                            class="btn btn-danger btn-gh-exit"
                                                            title="{{trans('site.buy')}}"
                                                            data-toggle="modal"
                                                            data-target="#modal-gh-exit-{{$Char->id}}">
                                                           <p> {{ trans('site.exit') }}</p>
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
