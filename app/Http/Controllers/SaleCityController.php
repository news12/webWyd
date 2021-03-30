<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\SaleRepositoryInterface;
use App\Repositories\Contract\StorageRepositoryInterface;
use App\Repositories\Contract\CharacterRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use DateTime;

class SaleCityController extends Controller
{
    //
    private $tipo_msg;
    private $msg;
    protected $model;
    protected $char;
    protected $storage;
    protected $itemPrice;
    protected $itemID;
    protected $nData = array();

    public function __construct(
                                StorageRepositoryInterface $storage,
                                CharacterRepositoryInterface $char,
                                SaleRepositoryInterface $model
                               )
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->char = $char;
        $this->storage = $storage;
        
    }

    public function indexArmia ()
    {
        $loggedId = intval(Auth::id());
        $character = $this->char->getCharacter(['*'], [ 'accountID' => $loggedId]);
        $sale = $this->model->all_n( [ 'table' => 'sale_city'], ['id' => 0]);
        $itemEffect = $this->model->all([ 'table' => 'itemeffect'], ['name']);
        //dd($sale);
        return view('panel.sale.armia')
        ->with('sale', $sale)
        ->with('itemeffect', $itemEffect)
        ->with('character', $character)
        ->with('account_id', $loggedId);
    }

    public function indexAzran ()
    {
        $loggedId = intval(Auth::id());
        $character = $this->char->getCharacter(['*'], [ 'accountID' => $loggedId]);
        $sale = $this->model->all_n( [ 'table' => 'sale_city'], ['id' => 1]);
        $itemEffect = $this->model->all([ 'table' => 'itemeffect'], ['name']);
        //dd($sale);
        return view('panel.sale.azran')
        ->with('sale', $sale)
        ->with('itemeffect', $itemEffect)
        ->with('character', $character)
        ->with('account_id', $loggedId);
    }

    public function indexErion ()
    {
        $loggedId = intval(Auth::id());
        $character = $this->char->getCharacter(['*'], [ 'accountID' => $loggedId]);
        $sale = $this->model->all_n( [ 'table' => 'sale_city'], ['id' => 2]);
        $itemEffect = $this->model->all([ 'table' => 'itemeffect'], ['name']);
        //dd($sale);
        return view('panel.sale.erion')
        ->with('sale', $sale)
        ->with('itemeffect', $itemEffect)
        ->with('character', $character)
        ->with('account_id', $loggedId);
    }

    public function indexNipplehein ()
    {
        $loggedId = intval(Auth::id());
        $character = $this->char->getCharacter(['*'], [ 'accountID' => $loggedId]);
        $sale = $this->model->all_n( [ 'table' => 'sale_city'], ['id' => 3]);
        $itemEffect = $this->model->all([ 'table' => 'itemeffect'], ['name']);
        //dd($sale);
        return view('panel.sale.nipplehein')
        ->with('sale', $sale)
        ->with('itemeffect', $itemEffect)
        ->with('character', $character)
        ->with('account_id', $loggedId);
    }

    public function indexNoatum ()
    {
        $loggedId = intval(Auth::id());
        $character = $this->char->getCharacter(['*'], [ 'accountID' => $loggedId]);
        $sale = $this->model->all_n( [ 'table' => 'sale_city'], ['id' => 4]);
        $itemEffect = $this->model->all([ 'table' => 'itemeffect'], ['name']);
        //dd($sale);
        return view('panel.sale.Noatum')
        ->with('sale', $sale)
        ->with('itemeffect', $itemEffect)
        ->with('character', $character)
        ->with('account_id', $loggedId);
    }



    public function buy(Request $request)
    {
        $loggedId = intval(Auth::id());
        $getCharOnline = intval(Auth::user()->slotid);
        $goldStorage = intval(Auth::user()->gold);

        if($getCharOnline < 0)
        {
            $this->tipo_msg = 'error';
            $this->msg = 'Necessário pelo menos um char logado para efetuar compra';
            $request->session()->flash($this->tipo_msg, $this->msg);
            return back()->withInput();
        }

        $itemCount = $this->model->nCount([ 'table' => 'sale_city'], ['id'], ['id' => $request->sale_id]);
       
        if($itemCount < 1)
       {
           $this->tipo_msg = 'error';
           $this->msg = 'Ocorreu um erro ao comparar dados enviados: item não encontrada.';
           $request->session()->flash($this->tipo_msg, $this->msg);
           return back()->withInput();
       }

       $buyItem = $this->model->get($request->sale_id);
     
        $this->itemPrice = $buyItem->price;
        $this->itemID = $buyItem->id;
       
      if($goldStorage < $this->itemPrice)
      {
        $this->tipo_msg = 'error';
        $this->msg = 'Ocorreu um erro ao comparar dados enviados: Gold insuficiente.';
        $request->session()->flash($this->tipo_msg, $this->msg);
        return back()->withInput();
      }

        $data = new DateTime();
        try 
        {
            $this->model->nUpdate( 
                                    ['table' => 'sale_city'],
                                    ['status' => 5, 'id_buyer' => $loggedId, 'date_buy' => $data], //status 5 = compra
                                    ['id' => $this->itemID]
                                );

            $this->tipo_msg = 'success';
            $this->msg = 'Item comprado com sucesso!!!';

        } catch (exception $error) {

            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ' . $error;
    
        }
     
        $request->session()->flash($this->tipo_msg, $this->msg);
        return back()->withInput();
       //$item = $this->model->get($request->id);



    }

    public function cancel(Request $request)
    {
        $loggedId = intval(Auth::id());
        $getCharOnline = intval(Auth::user()->slotid);

        $itemCount = $this->model->nCount(
            [ 'table' => 'sale_city'], 
            ['id'], 
            ['id' => $request->sale_id, 'id_account' => $loggedId, 'status' => 1]);

        
        if($itemCount < 1)
       {
           $this->tipo_msg = 'error';
           $this->msg = 'Ocorreu um erro ao comparar dados enviados: item não encontrada.';
           $request->session()->flash($this->tipo_msg, $this->msg);
           return back()->withInput();
       }

      
       Try {

        $this->model->nUpdate(
                                ['table' => 'sale_city'],
                                ['status' => 2],//status de cancelado = 2
                                ['id' => $request->sale_id]
                          );

        $this->tipo_msg = 'success';
        $this->msg = 'Venda cancelada com sucesso!!!';

    } catch (exception $error) {

        $this->tipo_msg = 'error';
        $this->msg = 'Ocorreu o seguinte erro: ' . $error;

    }
    $request->session()->flash($this->tipo_msg, $this->msg);
    return back()->withInput();

    }
}
