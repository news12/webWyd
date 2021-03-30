<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contract\NewsRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Exception;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $news;
    private $tipo_msg;
    private $msg;
    
    public function __construct( NewsRepositoryInterface $news)
    {
        $this->middleware('auth');
        //$this->middleware('auth.admin.user');
        $this->news = $news;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $sNews = $this->news->All();
        return view('panel.admin.news')
        ->with('news', $sNews);
    }

    public function create(Request $request)
    {
       // dd($request);
        try {
            $this->news->create(
                [
                    'title' => $request->title,
                    'news' => $request->news,
                    'type' => $request->type,
                    'date' => $request->date,
                    'hour' => $request->hour,
                    'autor' => Auth::user()->name
                ]);
                
            $this->tipo_msg = 'success';
            $this->msg = 'Noticia criada com sucesso';
        } catch (exception $err) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar criar uma noticia, tente novamente mais tarde';

        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return back()->withInput();
    }

    public function update(Request $request)
    {
       //dd($request);
        try {
            $this->news->update(
                [
                    'title' => $request->title,
                    'news' => $request->news,
                    'type' => $request->type,
                    'date' => $request->date,
                    'hour' => $request->hour,
                    'autor' => Auth::user()->name
                ],['id' => $request->id]);
                
            $this->tipo_msg = 'success';
            $this->msg = 'Noticia atualizada com sucesso';
        } catch (exception $err) {
            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar alterar a noticia, tente novamente mais tarde';

        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return back()->withInput();
    }

    public function destroy(Request $request)
    {

        try {
            $this->news->delete($request->id);

            $this->tipo_msg = 'success';
            $this->msg = 'Noticia excluida com sucesso';
        } catch (exception $err) {

            $this->tipo_msg = 'error';
            $this->msg = 'Ocorreu o seguinte erro ['.$err->getMessage().'] ao tentar excluir a noticia, tente novamente mais tarde';

        }

        $request->session()->flash($this->tipo_msg, $this->msg);

        return back()->withInput();
    }

}
