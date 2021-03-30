<?php

namespace App\Repositories\Eloquent;

use App\Models\Character;
use App\Repositories\Contract\CharacterRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CharacterRepository extends BaseRepository implements CharacterRepositoryInterface
{

    private $table_name = 'char';
    protected $model = Character::class;


    public function getCharacter($field = ['*'],$where = [null])
    {
        $data = DB::table($this->table_name)
            ->join('classe', 'char.classinfo', '=', 'classe.id')
            ->join('mclasse','char.evo', '=', 'mclasse.id')
            ->leftJoin('guild', 'char.guildindex', '=', 'guild.id')
            ->leftJoin('kingdom', 'char.capeinfo', '=', 'kingdom.id')
            ->select('char.*','classe.name as classe_name', 'mclasse.name as mclasse_name',
            'guild.name as guild', 'kingdom.name as kingdom')
            ->where('accountID', $where['accountID'])
            ->get();
            
            

          // dd($data);

        return $data;
    }

    public function getOneCharacter($field = ['*'],$where = [null])
    {
        $data = DB::table($this->table_name)
            ->select($field)
            ->where('accountID', $where['id_account'])
            ->where('char.id', $where['id_character'])
            ->get();
            
            

           // dd($data);

        return $data;
    }

    public function all()
    {
        $data = DB::table($this->table_name)
        ->join('classe', 'char.classinfo', '=' ,'classe.id')
        ->join('mclasse', 'char.evo', '=', 'mclasse.id')
        ->leftJoin('guild', 'char.guildindex', '=', 'guild.id')
        ->leftJoin('kingdom', 'char.capeinfo', '=', 'kingdom.id')
        ->select('char.*', 'classe.name as classe_name', 'mclasse.name as mclasse_name', 
        'guild.name as guild', 'kingdom.name as kingdom')
        ->orderByRaw("evo DESC, _level DESC, exp DESC")
        ->get();
        //dd($data);
        return $data;
    }
}