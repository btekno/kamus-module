<?php

namespace Modules\Qamus\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Modules\Qamus\Entities\Bahasa;
use Modules\Qamus\Entities\Makna;
use Modules\Qamus\Entities\Usulan;

class IndexController extends Controller
{
	/**
     * Siapkan konstruktor controller
     * 
     * @param Model
     */
    public function __construct(Bahasa $bahasa, Makna $makna, Usulan $usulan)
    {
        $this->bahasa = $bahasa;
        $this->makna = $makna;
        $this->usulan = $usulan;
     
        $this->view = 'qamus::landing';
        view()->share([
            'view' => $this->view
        ]);
    }

    /**
     * Homepage (Landing Page)
     *
     * @return Illuminate\\View\\View
     */
    public function index()
    {
        return view("$this->view.index");
    }

    /**
     * Laman Panduan
     *
     * @return Illuminate\\View\\View
     */
    public function panduan()
    {
        return view("$this->view.panduan");
    }

    /**
     * Redirect to Search URI
     *
     * @return Response
     */
    public function redirect(Request $request)
    {
        return redirect()->route('kamus.search', [
            $request->get('language'), 
            $request->get('query')
        ]);
    }

    /**
     * Lakukan pencarian kata
     *
     * @return Response
     */
    public function search(Request $request, $language, $query)
    {
        $bahasa = $this->bahasa->whereKode($language)->firstOrFail();

        $result = $this->makna->whereBahasaId($bahasa->id)->whereKata($query)->first();
        $usulan = $this->usulan->whereBahasaId($bahasa->id)->whereKata($query)->get();
        
        $related = $this->makna->where('kata', 'LIKE', '%'.$query.'%')->whereVerified(1)->paginate(5);

        return view("$this->view.result", compact('query', 'bahasa', 'result', 'related', 'usulan'));
    }
}