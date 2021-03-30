<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\GuildRepositoryInterface;
use App\Repositories\Contract\CharacterRepositoryInterface;
//use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Exception;
use DateTimeZone;
use Image;

class GuildController extends Controller
{
    //
    protected $character;
    protected $model;
    private $tipo_msg;
    private $msg;
    public function __construct(
                                    CharacterRepositoryInterface $character,
                                    GuildRepositoryInterface $model
                                )
    {
        $this->middleware('auth');
        $this->character = $character;
        $this->model = $model;
    }

    public function index()
    {
        $char_id = 0;
        $guild_index = 0;
        $char_online = 0;
        $char_kingdom = 0;
    
        $account_id = intval(Auth::id());
        $myCharacter = $this->character->getCharacter(['*'], [ 'accountID' => $account_id]);
        $model = $this->model->getGuild();
       
        
        foreach ($myCharacter as $Character) 
        {
            
            if ($Character->online) 
            {
                $char_id = $Character->id;
                $guild_index = $Character->guildindex;
                $char_online = $Character->online;
                $char_kingdom = $Character->capeinfo;
                break;
            }
        }

        $guild_apply = $this->model->get([ 'table' => 'guild_in_out'],['*'], 
        [
            'char_id' => $char_id,
            'ntype' => 0,
            'status' => 0
       ]);

      //dd($guild_apply);

      

        return view('panel.guild.index')
        ->with('guild', $model)
        ->with('guild_index', $guild_index)
        ->with('char_online', $char_online)
        ->with('char_kingdom', $char_kingdom)
        ->with('guild_apply', $guild_apply)
        ->with('char_id', $char_id);

    }

    public function GuildMark(Request $request)
    {
       $id_calc = 10;
       $guild_id = "b000000";

       if ($request->guild_id < $id_calc) 
        $guild_id = "b0000000".$request->guild_id;
       else
       $guild_id = "b000000".$request->guild_id;

       if ($request->hasFile('imgFile')) 
       {
           $imageName = $guild_id . '.bmp';
           list($width, $height, $type, $attr) = getimagesize($request->imgFile);
          // dd($width,$height, $type, $attr);
            if ($width != 16 || $height != 12 || $type != 6) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'A imagem deve ser 16x12 no formato .bmp.';
        
                $request->session()->flash($this->tipo_msg, $this->msg);
 
                return back()->withInput();
            }
           //dd($width,$height, $type, $attr);
          // $imageName = $request->img_item->getClientOriginalName();

           $request->imgFile->move(public_path('guilds/img_guilds/'), $imageName);

           $this->tipo_msg = 'success';
           $this->msg = 'Emblema da Guild enviado com sucesso....';
       }
       else 
       {
        $this->tipo_msg = 'error';
        $this->msg = 'Imagem não encontrada....';
       }

       
        $request->session()->flash($this->tipo_msg, $this->msg);
 
        return back()->withInput();
    }

    public function Recruit(Request $request )
    {
       
        $account_id = intval(Auth::id());
        $request_char_id = 0;
        $guild_id = 0;
        $char_id = 0;
        $request_char_online = 0;
        $request_guild = 0;
        $member_type = 0;

        $myCharacter = $this->character->get(['table' => 'char'], ['*'], [ 'accountID' => $account_id, 'id' => $request->char_id, 'online' => 1]);
        $requestCharacter = $this->character->get(['table' => 'char'], ['*'], ['id' => $request->target]);

        if ($myCharacter->isEmpty() && !$request->ntype)
        {
             $this->tipo_msg = 'error';
             $this->msg = 'Char offline no jogo....';
 
             $request->session()->flash($this->tipo_msg, $this->msg);
 
             return back()->withInput();
        }

        if ($requestCharacter->isEmpty())
        {
             $this->tipo_msg = 'error';
             $this->msg = 'Char não encontrado....';
 
             $request->session()->flash($this->tipo_msg, $this->msg);
 
             return back()->withInput();
        }

        foreach ($myCharacter as $MyCharacter) 
        {
            $guild_id = $MyCharacter->guildindex;
            $member_type = $MyCharacter->membertype;
            $char_id = $MyCharacter->id;
        }

        if (!$member_type) 
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Somente lider ou sub lider da guild podem aceitar/recusar membros....';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }

        if (!$guild_id) 
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Você não faz parte de uma guild....';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }

        foreach ($requestCharacter as $RequestCharacter) 
        {
            $request_char_id =  $RequestCharacter->id;
            $request_char_online =  $RequestCharacter->online;
            $request_guild =  $RequestCharacter->guildindex;
        }

        if ($request_guild && $request_guild !=  $guild_id && !$request->ntype) 
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Jogador já faz parte de outra guild....';
                try 
                {
                    $this->model->remove(['table' => 'guild_in_out'], ['guild_id' => $request_guild, 'char_id' => $request_char_id]);
                } catch (exception $err) 
                {
                        $this->tipo_msg = 'error';
                        $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar aceitar na guild';
                        
                 }

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }

        if ($request->ntype)//ntype do painel 0 = aceitar 1 = recusar
        {
            try 
            {
                $this->model->remove(['table' => 'guild_in_out'], ['guild_id' => $guild_id, 'char_id' => $request_char_id, 'ntype' => 0, 'status' => 0]);
                $this->tipo_msg = 'success';
                $this->msg = 'Você recusou o jogador na guild....';
            } catch (exception $err) 
            {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar recusar o jogador na guild';
                    
             }

            $request->session()->flash($this->tipo_msg, $this->msg);
            return back()->withInput();
        }
        else 
        {
           
            try 
            {
                 //$this->model->update(['table' => 'char'],['guildindex' => $guild_id], ['id' => $request_char_id]);
                 $this->model->update(['table' => 'guild_in_out'],['status' => 3, 'office_id' => $char_id], ['guild_id' => $guild_id, 'char_id' => $request_char_id]);
                 $this->tipo_msg = 'success';
                 $this->msg = 'Aceitação enviada com sucesso....';
             } catch (exception $err) 
             {
                     $this->tipo_msg = 'error';
                     $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar aceitar o jogador na guild';
                     
              }

              $request->session()->flash($this->tipo_msg, $this->msg);
              return back()->withInput();
           
        }
    }

    public function Take(Request $request)
    {
        $date =  Carbon::now();
        //$date->toDateTimeString();
        $date->tz = new DateTimeZone('America/Sao_Paulo');
        $account_id = intval(Auth::id());
        $char_id = 0;
        $guild_id = 0;
        $member_type = 0;
        $max_gold = 2000000000;
        $max_gold_week = 0;
        $gold_week = 0;
        $gold_guild = 0;

        if (is_null($request->take)) 
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Nenhum valor de saque encontrado.';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }
       
          
        $gold = intval(Auth::user()->gold) + $request->take;

        $myCharacter = $this->model->get([ 'table' => 'char'],['*'], ['accountID' => $account_id, 'online' => 1]);

        if (!$myCharacter->isEmpty()) 
        {
            foreach ($myCharacter as $MyCharacter) 
            {
                $char_id = $MyCharacter->id;
                $guild_id = $MyCharacter->guildindex;
                $member_type = $MyCharacter->membertype;
            }

            $guild = $this->model->get([ 'table' => 'guild'],['*'], ['id' => $guild_id]);

            if ($guild->isEmpty()) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Guild não encontrada.';
    
                $request->session()->flash($this->tipo_msg, $this->msg);
    
                return back()->withInput();
            }

            foreach ($guild as $Guild) 
            { 
                $max_gold_week = $Guild->max_gold_week;
                $gold_week = $Guild->gold_week;
                $gold_guild = $Guild->gold;
            
            }
            
            $gold_week += $request->take;

            if ($gold_guild < $request->take) 
            {
               
               $this->tipo_msg = 'error';
               $this->msg = 'A guild nao possui essa quantida disponivel.';
   
               $request->session()->flash($this->tipo_msg, $this->msg);
   
               return back()->withInput();

            }

            if ($gold_week > $max_gold_week) 
            {
               $gold_week -= $max_gold_week;

               $this->tipo_msg = 'error';
               $this->msg = 'Saque maximo semanal atingido, voce ainda pode sacar a quantia de'.number_format($gold_week, 2,',','.').'.';
   
               $request->session()->flash($this->tipo_msg, $this->msg);
   
               return back()->withInput();

            }

            if ($max_gold > $gold) 
            {
                if ($member_type == 2) 
                {
                    try 
                    {
                        $this->model->guilDelivery(
                                                  [ 'char_id' =>$char_id,
                                                    'guild_id' => $guild_id,
                                                    'type' => 0,//0 = saque 1 = impost 2= outro
                                                    'status' => 0, //0 = enviado 2 = recebido 3 = fail
                                                    'gold' => $request->take, 
                                                    'city' => 10, //seta um id de cidade que n existe para validação
                                                    'date' => $date->toDateTimeString()
                                                    
                                                  ]
                                                );
    
                        $this->tipo_msg = 'success';
                        $this->msg = 'Solicitação efetuada com sucesso!!!';
                    } catch (exception $err) 
                    {
                            $this->tipo_msg = 'error';
                            $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'].';
                            
                     }
                
                
                    $request->session()->flash($this->tipo_msg, $this->msg);
                    return back()->withInput();
                }
                else
                {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Você não permissão tem parar para fazer isso.';
    
                    $request->session()->flash($this->tipo_msg, $this->msg);
    
                    return back()->withInput();
                }
            }
            else
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Não há espaço no bau para essa quantidade de gold.';

                $request->session()->flash($this->tipo_msg, $this->msg);

                return back()->withInput();
            }
        }
        else
         {
            $this->tipo_msg = 'error';
            $this->msg = 'Char não encontrado ou offline, tente novamente mais tarde....';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }

       

    }

    public function Impost(Request $request)
    {
        $date =  Carbon::now();
        $date->tz = new DateTimeZone('America/Sao_Paulo');
        $account_id = intval(Auth::id());
        $char_id = 0;
        $guild_id = 0;
        $member_type = 0;
        $max_gold = 2000000000;
        $gold_guild = 0;
        $city_impost = 0;

        if (is_null($request->impost)) 
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Nenhum valor de imposto encontrado.';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }
       
          
        $myCharacter = $this->model->get([ 'table' => 'char'],['*'], ['accountID' => $account_id, 'online' => 1]);

        if (!$myCharacter->isEmpty()) 
        {
            foreach ($myCharacter as $MyCharacter) 
            {
                $char_id = $MyCharacter->id;
                $guild_id = $MyCharacter->guildindex;
                $member_type = $MyCharacter->membertype;
            }

            $guild = $this->model->get([ 'table' => 'guild'],['*'], ['id' => $guild_id]);
            $city = $this->model->get([ 'table' => 'city'],['*'], ['id' => $request->city, 'guild_index' => $guild_id]);

            if ($guild->isEmpty()) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Guild não encontrada.';
    
                $request->session()->flash($this->tipo_msg, $this->msg);
    
                return back()->withInput();
            }

            if ($city->isEmpty()) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Cidade não encontrada ou você nao é dono dessa cidade.';
    
                $request->session()->flash($this->tipo_msg, $this->msg);
    
                return back()->withInput();
            }

            foreach ($guild as $Guild) 
            { 
                $max_gold_week = $Guild->max_gold_week;
                $gold_week = $Guild->gold_week;
                $gold_guild = $Guild->gold;
            
            }

            foreach ($city as $City) 
                $city_impost = $City->impost;
               
            
            $gold = intval(Auth::user()->gold) + $city_impost;

            if ($request->impost > $city_impost) 
            {
               
               $this->tipo_msg = 'error';
               $this->msg = 'A Cidade não possui esse valor de imposto.';
   
               $request->session()->flash($this->tipo_msg, $this->msg);
   
               return back()->withInput();

            }

            if ($max_gold > $gold) 
            {
                if ($member_type == 2) 
                {
                    try 
                    {
                        $this->model->guilDelivery(
                                                  [ 'char_id' =>$char_id,
                                                    'guild_id' => $guild_id,
                                                    'type' => 1,//0 = saque 1 = impost 2= outro
                                                    'status' => 0, //0 = enviado 2 = recebido 3 = fail
                                                    'gold' => $city_impost, 
                                                    'city' => $request->city,
                                                    'date' => $date->toDateTimeString()
                                                    
                                                  ]
                                                );
    
                        $this->tipo_msg = 'success';
                        $this->msg = 'Solicitação efetuada com sucesso!!!';
                    } catch (exception $err) 
                    {
                            $this->tipo_msg = 'error';
                            $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'].';
                            
                     }
                
                
                    $request->session()->flash($this->tipo_msg, $this->msg);
                    return redirect()->back()->withInput();
                }
                else
                {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Você não tem permissão parar para fazer isso.';
    
                    $request->session()->flash($this->tipo_msg, $this->msg);
    
                    return back()->withInput();
                }
            }
            else
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Não há espaço no bau para essa quantidade de gold.';

                $request->session()->flash($this->tipo_msg, $this->msg);

                return back()->withInput();
            }
        }
        else
         {
            $this->tipo_msg = 'error';
            $this->msg = 'Char não encontrado ou offline, tente novamente mais tarde....';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }

       

    }

    public function Tax(Request $request)
    {
        $date =  Carbon::now();
        $date->tz = new DateTimeZone('America/Sao_Paulo');
        $account_id = intval(Auth::id());
        $char_id = 0;
        $guild_id = 0;
        $member_type = 0;
      
        if (is_null($request->tax)) 
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Nenhum valor de imposto encontrado.';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }
       
          
        $myCharacter = $this->model->get([ 'table' => 'char'],['*'], ['accountID' => $account_id, 'online' => 1]);

        if (!$myCharacter->isEmpty()) 
        {
            foreach ($myCharacter as $MyCharacter) 
            {
                $char_id = $MyCharacter->id;
                $guild_id = $MyCharacter->guildindex;
                $member_type = $MyCharacter->membertype;
            }

           
            $city = $this->model->get([ 'table' => 'city'],['*'], ['id' => $request->city, 'guild_index' => $guild_id]);


            if ($city->isEmpty()) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Cidade não encontrada ou você nao é dono dessa cidade.';
    
                $request->session()->flash($this->tipo_msg, $this->msg);
    
                return back()->withInput();
            }

            
            if ($request->tax > 10) 
            {
               
               $this->tipo_msg = 'error';
               $this->msg = 'Não é possivel cobrar mais que 10%.';
   
               $request->session()->flash($this->tipo_msg, $this->msg);
   
               return back()->withInput();

            }

                if ($member_type == 2) 
                {
                    try 
                    {
                        $this->model->update(['table' => 'city'],['tax' => $request->tax], ['id' => $request->city, 'guild_index' => $guild_id]);
    
                        $this->tipo_msg = 'success';
                        $this->msg = 'Taxa atualizada com sucesso!!!';
                    } catch (exception $err) 
                    {
                            $this->tipo_msg = 'error';
                            $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'].';
                            
                     }
                
                
                    $request->session()->flash($this->tipo_msg, $this->msg);
                    return back()->withInput();
                }
                else
                {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Você não permissão tem parar para fazer isso.';
    
                    $request->session()->flash($this->tipo_msg, $this->msg);
    
                    return back()->withInput();
                }
            
            
        }
        else
         {
            $this->tipo_msg = 'error';
            $this->msg = 'Char não encontrado ou offline, tente novamente mais tarde....';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }

       

    }

    public function hGuild()
    {
        
        $loggedId = intval(Auth::id());
        $myCharacter = $this->character->getCharacter(['*'], [ 'accountID' => $loggedId]);
        $model = $this->model->getGuild();
        $member = $this->model->getMember();
        $user = $this->model->all_n([ 'table' => 'users']);
        $city = $this->model->all_n(['table' => 'city']);
        //$city = $this->model->get([ 'table' => 'city'],['*'], ['status' => 0]);
        $log = $this->model->all_n(['table' => 'guild_hall_log']);
        $guild_apply = $this->model->all_n(['table' => 'guild_in_out']);
       
        //dd($member);
        return view('panel.guild.hall')
                ->with('char', $myCharacter)
                ->with('guild', $model)
                ->with('member', $member)
                ->with('user', $user)
                ->with('city', $city)
                ->with('log', $log)
                ->with('guild_apply', $guild_apply);

    }

    public function memberInOut(Request $request)
    {
        $date =  Carbon::now();
        $date->tz = new DateTimeZone('America/Sao_Paulo');
        //$date->toDateTimeString();
        $dayOfWeek = $date->englishDayOfWeek;
        $account_id = intval(Auth::id());
        $char_id = 0;
        $guild_id = 0;
        $char_online = 0;
        $member_type = 0;
        $char_slot = -1;
        $nTypeStr = "";
        $target = 0;
        $guild_target = 0;
        $target_online = 0;
        $target_office = 0;
        $target_slot = 0;
        $target_account_id = 0;
        $price = 0;
        $evo = 0;
        $gold = 0;
        $office_id = 0;
        $guild_count = 0;

        $myCharacter = $this->character->getOneCharacter(['*'], [ 'id_account' => $account_id, 'id_character' => $request->char_id]);

        /*if ($dayOfWeek == "Sunday") 
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Indisponível aos domingos....';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }*/
      
        if ($myCharacter->isEmpty())
        {
             $this->tipo_msg = 'error';
             $this->msg = 'Char não encontrado, tente novamente mais tarde....';
 
             $request->session()->flash($this->tipo_msg, $this->msg);
 
             return back()->withInput();
        }

        foreach ($myCharacter as $MyChar) 
        {
           
           $char_id = $MyChar->id;
           $guild_id = $MyChar->guildindex;
           $char_slot = $MyChar->slotid;
           $char_online = $MyChar->online;
           $member_type = $MyChar->membertype;
           $evo = $MyChar->evo;

        }
        $price = ($evo + 1) * 5000000;
        // 0 = Entrada 1 = Saida 2 = kick
        if ($request->ntype == 1) //player solicitou saida
        { 
            $gold = intval(Auth::user()->gold);
            $nTypeStr = "Sair da";
           
            if (!$guild_id) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro [Guild não encontrada] tente novamente mais tarde';
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }
            if ($member_type) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro [Líderes de guild não podem sair.] tente novamente mais tarde';
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }
            if ($gold < $price) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro [precisa de pelo menos'.$price.' gold para sair da guild.] tente novamente mais tarde';
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }
        }
        else if ($request->ntype == 2) // player expulso
         {
            $nTypeStr = "expulsar da";
            $price = 0;
            $office_id = $char_id;
            if ( $member_type < 1) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro [Somente lideres podem expulsar membros da guild.]';
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }

            if (!$char_online) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro [Seu char precisa esta online no jogo.]';
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }

            $targetCharacter = $this->character->getOneCharacter(['*'], [ 'id_account' => $request->target_account_id, 'id_character' => $request->target]);

            if ($targetCharacter->isEmpty())
            {
                 $this->tipo_msg = 'error';
                 $this->msg = 'Char não encontrado, tente novamente mais tarde....';
     
                 $request->session()->flash($this->tipo_msg, $this->msg);
     
                 return back()->withInput();
            }

            foreach ($targetCharacter as $TargetChar) 
            {
            
                $target = $TargetChar->id;
                $guild_target = $TargetChar->guildindex;
                $target_slot = $TargetChar->slotid;
                $target_online = $TargetChar->online;
                $target_office = $TargetChar->membertype;
                $target_account_id = $TargetChar->accountID;
                $evo = $TargetChar->evo;

            }

            if ($target_office) //tentou expulsar lider ou sub lider da guild
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro [Lideres da guild não podem ser expulso.]';
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }

            if ($guild_id != $guild_target) //tentou expulsar membro de outra guild(proteção)
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro [O jogador não pertence a sua guild.]';
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }
           

        }
         else //player solicitou entrada
         {
            $nTypeStr = "aplicar na"; 
            if ($request->apply_type) 
            {
                $guild_apply = $this->model->get([ 'table' => 'guild_in_out'],['*'], ['guild_id' => $request->guild_id, 'char_id' => $char_id]);

                if ($guild_apply->isEmpty()) 
                {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Ocorreu o seguinte erro [Aplicação não encontrada] tente novamente mais tarde';
                    $request->session()->flash($this->tipo_msg, $this->msg);
                    return back()->withInput();
                }

                try 
                {
                    $this->model->remove(['table' => 'guild_in_out'], ['guild_id' => $request->guild_id, 'char_id' => $char_id]);
                    $this->tipo_msg = 'success';
                    $this->msg = 'Aplicação removida com sucesso!!!.';
                } catch (exception $err) 
                {
                        $this->tipo_msg = 'error';
                        $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar '. $nTypeStr. ' guild, tente novamente mais tarde';
                        
                }

              
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }  
            else 
            {
                if ($guild_id) 
                {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Ocorreu o seguinte erro [Você já esta em uma guild] tente novamente mais tarde';
                    $request->session()->flash($this->tipo_msg, $this->msg);
                    return back()->withInput();
                }
               
                $guild_request = $this->model->get([ 'table' => 'guild'],['*'], ['id' => $request->guild_id]);
    
                if ($guild_request->isEmpty()) 
                {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Ocorreu o seguinte erro [Guild não encontrada] tente novamente mais tarde';
                    $request->session()->flash($this->tipo_msg, $this->msg);
                    return back()->withInput();
                }
    
    
                /*$guild_member = $this->model->get([ 'table' => 'guild_member'],['*'], ['guild_id' => $request->guild_id]);
    
                foreach ($guild_member as $Guild_member) 
                    if ($request->guild_id == $Guild_member->guild_id) 
                        $guild_count++;*/
                    
              
                foreach ($guild_request as $Guild_request) 
                {
                    if ($Guild_request->max_member <= $Guild_request->member_count) 
                    {
                        $this->tipo_msg = 'error';
                        $this->msg = 'Ocorreu o seguinte erro [Guild full] tente novamente mais tarde';
                        $request->session()->flash($this->tipo_msg, $this->msg);
                        return back()->withInput();
                    }
    
                    if (!$Guild_request->request) 
                    {
                        $this->tipo_msg = 'error';
                        $this->msg = 'Ocorreu o seguinte erro [Guild não esta aceitando aplicação] tente novamente mais tarde';
                        $request->session()->flash($this->tipo_msg, $this->msg);
                        return back()->withInput();
                    }
    
                    $guild_id = $Guild_request->id;
                }
            }
            
         }

       
            if (!$char_online && $request->ntype < 2) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro [Char offline] ao tentar '. $nTypeStr.' guild, tente novamente mais tarde';
                $request->session()->flash($this->tipo_msg, $this->msg);
                return back()->withInput();
            }
                 try 
                {
                    $this->model->memberInOut(
                                                [ 'char_id' => ($request->ntype == 2) ? $target : $char_id,
                                                'guild_id' => ($request->ntype == 2) ? $guild_target : $guild_id,
                                                'account_id' => ($request->ntype == 2) ? $target_account_id : $account_id,
                                                'type' => $request->ntype,//0= entrada 1= saida
                                                'status' =>0, // 0= aguardando validação do emulador
                                                 'date' => $date->toDateTimeString(),
                                                 'price' => $price ,//custo para entrar ou sair da guild
                                                 'office_id' => ($request->ntype == 2) ? $char_id : 0,
                                                    
                                                ]
                                            );

                    $this->tipo_msg = 'success';
                    $this->msg = 'Obteve sucesso ao ' .$nTypeStr.' guild!!!';
                } catch (exception $err) 
                {
                        $this->tipo_msg = 'error';
                        $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar '. $nTypeStr. ' guild, tente novamente mais tarde';
                        
                 }
            
            
            $request->session()->flash($this->tipo_msg, $this->msg);
            return back()->withInput();
           

    
    }

    public function Donate(Request $request)
    {
        $date = new Carbon();
        $date->tz = new DateTimeZone('America/Sao_Paulo');
        $dayOfYear = $date->dayOfYear -1; //conversão para dayofYear c++
        $year = $date->year -1900; //conversão para year c++
        $donate_day = 0;
        $donate_year = 0;
        $account_id = intval(Auth::id());
        $gold = intval(Auth::user()->gold);
        $char_on = intval(Auth::user()->slotid);
        $fame = 0;
        $guild_id = 0;
        $char_id = $request->id;
        $char_slot = -1;
        $myCharacter = $this->character->getOneCharacter(['*'], [ 'id_account' => $account_id, 'id_character' => $request->id]);
        $req_gold = 0;
        $req_fame = 0;
        if ($myCharacter->isEmpty())
        {
             $this->tipo_msg = 'error';
             $this->msg = 'Char não encontrado, tente novamente mais tarde....';
 
             $request->session()->flash($this->tipo_msg, $this->msg);
 
             return back()->withInput();
        }
       
        foreach ($myCharacter as $MyChar) 
        {
           $fame = $MyChar->fame;
           $char_id = $MyChar->id;
           $guild_id = $MyChar->guildindex;
           $char_slot = $MyChar->slotid;
        }

        $member_Status = $this->model->get([ 'table' => 'guild_member'],['*'], ['char_id' => $char_id]);

        foreach ($member_Status as $nMember) {
            $donate_day = $nMember->donate_day;
            $donate_year = $nMember->donate_year;
        }
          // dd($dayOfYear, $donate_day);
        if ($year <= $donate_year) 
        {
            
            if ($dayOfYear <= $donate_day) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Esse personagem já efetuou uma doação no dia de hoje, volte amanhã.';

                $request->session()->flash($this->tipo_msg, $this->msg);

                return back()->withInput();
            }
        }

        if ($char_slot != $char_on) {
            $this->tipo_msg = 'error';
            $this->msg = 'Esse Personagem precisa estar logado no jogo, tente novamente mais tarde....';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }
      
        if ($request->gold < 0 && $request->fame < 0) 
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Nenhum valor de doação foi selecionado, tente novamente mais tarde...';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
        }

        $req_gold = ($request->gold) ? $request->gold * 1000000 : 0 ;
        $req_fame = ($request->fame) ? $request->fame : 0 ;

          if ($req_gold && $gold < $req_gold) 
          {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro [Gold insuficiente] ao tentar doar para a guild, tente novamente mais tarde';
            $request->session()->flash($this->tipo_msg, $this->msg);
            return back()->withInput();
          }

          if ($req_fame && $fame < $req_fame) 
          {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro [Fame insuficiente] ao tentar doar para a guild, tente novamente mais tarde';
            $request->session()->flash($this->tipo_msg, $this->msg);
            return back()->withInput();
          }
           
                try {
                   
                    // $this->model->dec([ 'table' => 'users'], 'gold', $req_gold, ['id' => $account_id]);
                    // $this->model->inc([ 'table' => 'guild_member'], 'donate', $request->gold, ['char_id' => $char_id]);
                    // $this->model->inc([ 'table' => 'guild_member'], 'contribuition', $request->gold, ['char_id' => $char_id]);

                    $this->model->createDonate(
                        [
                        'guild_id' => $guild_id,
                        'char_id' => $char_id,
                        'account_id' => $account_id,
                        'gold' => $req_gold,
                        'fame' => $req_fame,
                        'status' => 0,
                      
                    
                        ]);
                    } 
                catch (exception $err) 
                {
                    $this->tipo_msg = 'error';
                    $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar doar para a guild, tente novamente mais tarde';
                    $request->session()->flash($this->tipo_msg, $this->msg);
                    return back()->withInput();

                }
           
        

       
        $this->tipo_msg = 'success';
        $this->msg = 'Doação Efetuada com sucesso!!!';
        $request->session()->flash($this->tipo_msg, $this->msg);
        return back()->withInput();
       
    }
}
