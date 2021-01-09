<?php

namespace App\Http\Controllers\Controle;

use App\Http\Controllers\Controller;
use App\Models\Autor;
use App\Models\Livro;
use App\Repositories\AutorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $autorRepository;

    public function __construct(AutorRepository $autorRepository)
    {
        $this->autorRepository = $autorRepository;
    }

    public function index()
    {
        $livros = Livro::with('autor')->orderBy('nome')->paginate(10);

        return view('controle.livros.index', ['livros' => $livros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $autors = Autor::pluck('nome', 'id')->toArray();
        return view('controle.livros.create', ['autors' => $autors]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|min:2|max:255',
            'autor_id' => 'required|min:1|max:255',
        ]);

        $input = $request->all();

        DB::beginTransaction();

        try {
            if (isset($input['autor_id'])) {
                $input['autor_id'] = $this->autorRepository->getAutor($input);
            }
            $livro = Livro::create($input);
            DB::commit();

            return redirect()->route('controle.livros.index')->with('msg', 'Registro criado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('error', true)->with('msg', 'Erro ao cadastrar.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro $livro)
    {
        $autors = Autor::pluck('nome', 'id')->toArray();

        return view('controle.livros.create', ['autors' => $autors, 'livro' => $livro]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livro $livro)
    {
        $request->validate([
            'nome' => 'required|min:2|max:255',
            'autor_id' => 'required|min:1|max:255',
        ]);

        $input = $request->all();
        $input['ativo'] = (isset($input['ativo'])) ? 1 : 0;

        DB::beginTransaction();

        try {
            if (isset($input['autor_id'])) {
                $input['autor_id'] = $this->autorRepository->getAutor($input);
            }

            $livro->update($input);
            DB::commit();

            return redirect()->route('controle.livros.index')->with('msg', 'Registro atualizado com sucesso!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', true)->with('msg', 'Erro ao atualizar.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        try {
            if (isset($input['autor_id'])) {
                $input['autor_id'] = $this->autorRepository->getAutor($input);
            }

            if ($livro->delete()) {
                return redirect()->route('controle.livros.index')->with('msg', 'Registro excluido com sucesso!');
            }

            return redirect()->back()->withInput()->with('error', true)->with('msg', 'Erro ao excluir registro.');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', true)->with('msg', 'Erro ao excluir registro.');
        }
    }
}
