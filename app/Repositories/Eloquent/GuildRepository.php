<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contract\GuildRepositoryInterface;
use App\Models\Guild;
use App\Models\GuildMember;
use App\Models\GuildDonate;
use App\Models\GuildInOut;
use App\Models\GuildDelivery;
use Illuminate\Support\Facades\DB;

class GuildRepository extends BaseRepository  implements GuildRepositoryInterface
{

    private $table_name = "guild";
    private $table_member = "guild_member";
    private $table_hall = "guild_hall";
    private $table_char = "char";
    private $table_classe = 'classe';
    private $table_evo = 'mclasse';
    private $talbe_user = 'users';

    protected $guild_member = GuildMember::class;
    protected $guild_donate = GuildDonate::class;
    protected $guild_in_out = GuildInOut::class;
    protected $guild_delivery = GuildDelivery::class;


    public function getGuild($field = ['*'],$where = [null])
    {
        $data = DB::table($this->table_name)
            //->join($this->table_member, $this->table_name.'.id', '=', $this->table_member.'.guild_id')
            ->leftJoin($this->table_char, $this->table_name.'.leader_id', '=', $this->table_char.'.id')
            ->select($this->table_name.'.*', $this->table_char. '.name as leader', $this->table_char. '.capeinfo as leader_kingdom')
            ->get();
            
            

         // dd($data);

        return $data;
    }
    
    public function createMember($fields = [null])
    {
        $data = new $this->guild_member;
        $data->guild_id = $fields['guild_id'];
        $data->char_id = $fields['char_id'];
        $data->office = $fields['office'];
        $data->donate = $fields['donate'];
        $data->contribuition = $fields['contribuition'];
        $data->donate_day = $fields['donate_day'];
        $data->donate_year = $fields['donate_year'];
        $data->save();

        return $data;
    }

    public function createDonate($fields = [null])
    {
        $data = new $this->guild_donate;
        $data->guild_id = $fields['guild_id'];
        $data->char_id = $fields['char_id'];
        $data->account_id = $fields['account_id'];
        $data->gold = $fields['gold'];
        $data->fame = $fields['fame'];
        $data->status = $fields['status'];
        $data->save();

        return $data;
    }

    public function guilDelivery($fields = [null])
    {
        $data = new $this->guild_delivery;
        $data->guild_id = $fields['guild_id'];
        $data->char_id = $fields['char_id'];
        $data->type = $fields['type'];
        $data->status = $fields['status'];
        $data->gold = $fields['gold'];
        $data->city_id = $fields['city'];
        $data->date = $fields['date'];
        $data->save();

        return $data;
    }

    public function memberInOut($fields = [null])
    {
        $data = new $this->guild_in_out;
        $data->char_id = $fields['char_id'];
        $data->guild_id = $fields['guild_id'];
        $data->account_id = $fields['account_id'];
        $data->ntype = $fields['type'];
        $data->status = $fields['status'];
        $data->date = $fields['date'];
        $data->price = $fields['price'];
        $data->office_id = $fields['office_id'];
        $data->save();

        return $data;
    }

    public function getMember($field = ['*'],$where = [null])
    {
        $data = DB::table($this->table_char)
                ->join($this->table_member, $this->table_char.'.id', '=', $this->table_member.'.char_id')
                ->join($this->table_classe, $this->table_char.'.classinfo', '=', $this->table_classe.'.id')
                ->join($this->table_evo, $this->table_char.'.evo', '=', $this->table_evo.'.id')
                ->select($this->table_char.'.*', $this->table_member.'.office as office', $this->table_member.'.donate as guild_donate', 
                $this->table_member.'.contribuition as contribuition',$this->table_classe.'.name as classe_name', $this->table_evo.'.name as evo_name')
                ->orderBy('office', 'desc')
                ->orderBy('evo', 'desc')
                ->orderBy('_level', 'desc')
                ->get();

        return $data;
    }

    
    public function all_n($table, $fields = ['*'])
    {
        if ($table['table'] == 'city') {
            $data = DB::table($table['table'])
            ->leftJoin('guild','city.guild_index', '=', 'guild.id')
            ->select($table['table'].'.*', 'guild.name as guild')
            ->where('city.status','=', 0)
            ->get();
             

            return $data;
        }
        else if ($table['table'] == 'guild_in_out')
        {
        $data = DB::table($table['table'])
            ->leftJoin('char','guild_in_out.char_id', '=', 'char.id')
            ->select($table['table'].'.*', 'char.name as char_name', 'char._level as char_level', 'char.evo as char_evo')
            ->get();
             

        return $data;
        }
        else
        {
        $data = DB::table($table['table'])
            ->select($fields)
            ->orderBy('id', 'desc')
            ->get();
             

        return $data;
        }
    }

    public function all()
    {
        
    }

}