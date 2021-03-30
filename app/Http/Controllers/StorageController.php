<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\StorageRepositoryInterface;
use App\Repositories\Contract\CharacterRepositoryInterface;
use App\Repositories\Contract\SaleRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Exception;

class StorageController extends Controller
{
    //
    private $MaxSale = 10;
    private $tipo_msg;
    private $msg;
    protected $model;
    protected $char;
    protected $sale;
    protected $nData = array();

    public function __construct(
                                StorageRepositoryInterface $model,
                                CharacterRepositoryInterface $char,
                                SaleRepositoryInterface $sale
                               )
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->char = $char;
        $this->sale = $sale;
        
    }

    public function getStorage()
    {
        $loggedId = intval(Auth::id());
        $storage = $this->model->getStorage(['*'], [ 'accountID' => $loggedId]);
        $character = $this->char->getCharacter(['*'], [ 'accountID' => $loggedId]);
        $itemEffect = $this->model->all([ 'table' => 'itemeffect'], ['name']);
        $city = $this->model->all([ 'table' => 'city'], ['*']);

        //dd($storage);
        return view('panel.storage.storage')
                    ->with('storage', $storage)
                    ->with('itemEffect', $itemEffect)
                    ->with('character', $character)
                    ->with('city', $city);

    }

    public function setSale(Request $request)
    {
       
        //dd($request);
        if(!is_numeric($request->price))
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu um erro ao comparar dados enviados: O valor deve conter apenas numeros.';
            $request->session()->flash($this->tipo_msg, $this->msg);
            return back()->withInput();
        }
        
        $loggedId = intval(Auth::id());
        $getCharOnline = intval(Auth::user()->slotid);

        $notrade = $this->model->nGet([ 'table' => 'no_trade'], ['*'], $request->item_id);
       
        if(!$notrade->isEmpty())
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu um erro: esse item não pode ser comercializado.';
            $request->session()->flash($this->tipo_msg, $this->msg);
            return back()->withInput();
        }

        //dd($notrade);

        $countSale = $this->sale->nCount( 
            ['table' => 'sale_city'], 
            [ 'id' => $loggedId],
            ['id_account' => $loggedId]
           );

           if($countSale > $this->MaxSale)
           {
            $this->tipo_msg = 'error';
            $this->msg = 'Erro: Você não pode ter mais que ('.$this->MaxSale.') itens a venda no leilão.';
            $request->session()->flash($this->tipo_msg, $this->msg);
            return back()->withInput(); 
           }

        $character = $this->char->getOneCharacter(['id'], [ 'id_account' => $loggedId, 'id_character' => $request->id_char]);

        if($character->isEmpty())
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu um erro ao comparar dados enviados: personagem não encontrado.';
            $request->session()->flash($this->tipo_msg, $this->msg);
           // return redirect('nStorage');
           return back()->withInput();
        }
           
           $item = $this->model->nCount(['id'], [ 'id_account' => $loggedId, 'id_item' => $request->item_id, 'slot' => $request->slot]);

         if($item < 1)
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu um erro ao comparar dados enviados: item não encontrada.';
            $request->session()->flash($this->tipo_msg, $this->msg);
            //return redirect('nStorage');
            return back()->withInput();
        }

        //dd($itemAdd);
        if($request->id_city == 99)
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu um erro ao comparar dados enviados: cidade não encontrada.';
            $request->session()->flash($this->tipo_msg, $this->msg);
            //return redirect('nStorage');
            return back()->withInput();
        }
        
        $itemAdd = $this->model->nGetStatus(['*'], [ 'id_account' => $loggedId, 'id_item' => $request->item_id, 'slot' => $request->slot]);
        foreach ($itemAdd as $ItemAdd)
        {
            $this->nData['ef1'] = $ItemAdd->ef1;
            $this->nData['efv1'] = $ItemAdd->efv1;
            $this->nData['ef2'] = $ItemAdd->ef2;
            $this->nData['efv2'] = $ItemAdd->efv2;
            $this->nData['ef3'] = $ItemAdd->ef3;
            $this->nData['efv3'] = $ItemAdd->efv3;
        }
        
        try {

            $status = 0;
            if($getCharOnline < 0)
                $status = 1; 
          
            $this->sale->create(
                ['table' => 'sale_city'],
                [
                    'item_id' => $request->item_id,
                    'id_account' => $loggedId,
                    'id_char' => $request->id_char,
                    'price' => $request->price,
                    'status' => $status,
                    'slot' => $request->slot,
                    'ef1' =>  $this->nData['ef1'],
                    'efv1' =>  $this->nData['efv1'],
                    'ef2' =>  $this->nData['ef2'],
                    'efv2' =>  $this->nData['efv2'],
                    'ef3' =>  $this->nData['ef3'],
                    'efv3' =>  $this->nData['efv3'],
               
                ],
                ['id' => $request->id_city]
        );
        $this->model->update(
                                ['itemID' => 0,
                                    'ef1' => 0,
                                    'efv1' => 0,
                                    'ef2' => 0,
                                    'efv2' => 0,
                                    'ef3' => 0,
                                    'efv3' => 0,
                                ],
                                [
                                    'slot' => $request->slot,
                                    'id_account' => $loggedId
                                ]
                            );
            $this->tipo_msg = 'success';
            $this->msg = 'Item colocado a venda com sucesso!!!';
        } catch (exception $item) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $item->getMessage(). ' tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return redirect('nStorage');
    }
}
