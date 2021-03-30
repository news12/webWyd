<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\NeilRepositoryInterface;
use App\Models\NeilCat;
use App\Models\NeilDelivery;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Exception;

class NeilController extends Controller
{
    //

    protected $neil;
    protected $neil_cat;
    protected $neil_delivery;
    private $tipo_msg;
    private $msg;

    public function __construct(
         NeilRepositoryInterface $neil, 
         NeilCat $neil_cat,
         NeilDelivery $neil_delivery)
    {
        $this->middleware('auth');
        //$this->middleware('auth.admin.user');
        $this->neil = $neil;
        $this->neil_cat = $neil_cat;
        $this->neil_delivery = $neil_delivery;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $data = $this->neil->All();
        $category = $this->neil_cat->All();
        return view('panel.neil')
        ->with('neil', $data)
        ->with('cat', $category);
    }

    public function aIndex()
    {
        $data = $this->neil->All();
        $category = $this->neil_cat->All();
        return view('panel.admin.neil')
        ->with('neil', $data)
        ->with('cat', $category);
    }

    public function create(Request $request)
    {
       //dd($request);
        if ($request->hasFile('img_item')) 
        {
            $imageName = ($request->img ? $request->img : 'no_img'.$request->item_id) . '.gif';

            //dd($imageName);
           // $imageName = $request->img_item->getClientOriginalName();
            $request->img_item->move(public_path('img/neil/'), $imageName);
        }
        try {
            $this->neil->create([
                'item_id' => $request->item_id,
                'name' => $request->name,
                'desc' => $request->desc,
                'stock' => ($request->stock ? $request->stock : 0),
                'cat_id' => ($request->cat_id ? $request->cat_id : 7),
                'type' => 1,
                'date' => new DateTime(),
                'price' => ($request->price ? $request->price : 0),
                'img' => ($request->img ? $request->img : 0),
                'ef1' => ($request->ef1 ? $request->ef1 : 0),
                'efv1' => ($request->efv1 ? $request->efv1 : 0),
                'ef2' => ($request->ef2 ? $request->ef2 : 0),
                'efv2' => ($request->efv2 ? $request->efv2 : 0),
                'ef3' => ($request->ef3 ? $request->ef3 : 0),
                'efv3' => ($request->efv3 ? $request->efv3 : 0),
                'autor' => Auth::user()->name,
            
            ]);
            $this->tipo_msg = 'success';
            $this->msg = 'Item criado com sucesso!!!';
        } catch (exception $err) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ['.$err->getMessage().'] tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return back()->withInput();
    }

    public function update(Request $request)
    {
       //dd($request);
        if ($request->hasFile('img_item')) 
        {
            $imageName = ($request->img ? $request->img : 'no_img'.$request->item_id) . '.gif';

            //dd($imageName);
           // $imageName = $request->img_item->getClientOriginalName();
            $request->img_item->move(public_path('img/neil/'), $imageName);
        }
        try {
            $this->neil->update(
                [
                'item_id' => $request->item_id,
                'name' => $request->name,
                'desc' => $request->desc,
                'stock' => ($request->stock ? $request->stock : 0),
                'cat_id' => ($request->cat_id ? $request->cat_id : 7),
                'type' => 1,
                'date' => new DateTime(),
                'price' => ($request->price ? $request->price : 0),
                'img' => ($request->img ? $request->img : 0),
                'ef1' => ($request->ef1 ? $request->ef1 : 0),
                'efv1' => ($request->efv1 ? $request->efv1 : 0),
                'ef2' => ($request->ef2 ? $request->ef2 : 0),
                'efv2' => ($request->efv2 ? $request->efv2 : 0),
                'ef3' => ($request->ef3 ? $request->ef3 : 0),
                'efv3' => ($request->efv3 ? $request->efv3 : 0),
                'autor' => Auth::user()->name,
            
                ],
                ['id' => $request->id]);

            $this->tipo_msg = 'success';
            $this->msg = 'Item criado com sucesso!!!';
        } catch (exception $err) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro: ['.$err->getMessage().'] tente novamente mais tarde';
        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return back()->withInput();
    }


    public function buyNeil(Request $request)
    {
       // dd($request);
       $loggedId = intval(Auth::id());
       $getCharOnline = intval(Auth::user()->slotid);
       $donate = intval(Auth::user()->donate);
       $status = 0;

       $neil_item = $this->neil->get(['*'],['id' => $request->id]);

       if ($neil_item->isEmpty())
       {
            $this->tipo_msg = 'error';
            $this->msg = 'Item não encontrado, tente novamente mais tarde....';

            $request->session()->flash($this->tipo_msg, $this->msg);

            return back()->withInput();
       }

       

        foreach ($neil_item as $item ) 
        {
            if ($donate < $item->price) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Você não possui donate suficiente para essa transação....';

                $request->session()->flash($this->tipo_msg, $this->msg);

                return back()->withInput();
            }

            if (!$item->stock) 
            {
                $this->tipo_msg = 'error';
                $this->msg = 'Não temos mais esse item em estoque, aguarde a reposição do item.';

                $request->session()->flash($this->tipo_msg, $this->msg);

                return back()->withInput();
            }

            try {

                $this->neil->dec_n('stock', 1, ['id' => $item->id]);

                if($getCharOnline < 0)
                {
                   $this->neil->decUser('donate', $item->price, ['id' => $loggedId]);
                   $status = 1;
                }
                // status = 0 precisa entregar o item e remover o cash da conta
                // status = 1 precisa entregar o item apenas
                $this->neil->delivery(
                    [
                        'item_id' => $item->item_id,
                        'buyer_id' => $loggedId,
                        'neil_id' => $item->id,
                        'status' => $status,
                        'price' => $item->price,
                        'date' => new DateTime(),
                        'ef1' => $item->ef1,
                        'efv1' => $item->efv1,
                        'ef2' => $item->ef2,
                        'efv2' => $item->efv2,
                        'ef3' => $item->ef3,
                        'efv3' => $item->efv3,
                        'delivery_fail' => 0,
                        'delivery_day' => 0,
    
                    ]);
                    
                    
                $this->tipo_msg = 'success';
                $this->msg = 'Item comprado com sucesso';
            } catch (exception $err) {
                $this->tipo_msg = 'error';
                $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar comprar o item, tente novamente mais tarde';
    
            }
        }
       

        $request->session()->flash($this->tipo_msg, $this->msg);

        return back()->withInput();
    }

    public function destroy(Request $request)
    {

        try {
            $this->neil->delete($request->id);

            $this->tipo_msg = 'success';
            $this->msg = 'Item excluido com sucesso';
        } catch (exception $err) {

            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar excluir o item, tente novamente mais tarde';

        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return back()->withInput();
    }
}
