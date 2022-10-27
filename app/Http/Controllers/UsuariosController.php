<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $dados = DB::table('usuarios')->get();

        return view('usuarios.listar', ['usuarios' => $dados]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.novo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'nome'  => 'required|min:3|max:120',
            'email'      => 'required|min:0',
            'idade' => 'required|numeric|min:2',
            'telefone' => 'required|numeric|'
        ], [], ['nome' => 'nome', 'email' => 'email', 'idade' => 'idade', 'telefone' => 'telefone']);

        if ($validation->fails()) {
            return redirect('usuarios/novo')->withErrors($validation)->withInput();
        } else {
            DB::table('usuarios')->insert([
                'nome'  => $request->nome,
                'email'      => $request->email,
                'idade' => $request->idade,
                'telefone' => $request->telefone
            ]);
            return redirect('/usuarios')->with('mensagem', 'Usuario cadastrado.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = DB::table('usuarios')->where('id', $id)->first();

        return view('usuarios.detalhes', ['usuario' => $usuario]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = DB::table('usuarios')->where('id', $id)->first();

        return view('usuarios.editar', ['usuario' => $usuario]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            'nome'  => 'required|min:3|max:120',
            'email'      => 'required|min:0',
            'idade' => 'required|numeric|min:2',
            'telefone' => 'required|numeric|'
        ]);

        if ($validation->fails()) {
            return redirect('usuarios/editar/'.$id)->withErrors($validation);
        } else {
            DB::table('usuarios')->where('id', $id)->update([
                'nome'  => $request->nome,
                'email'      => $request->email,
                'idade' => $request->idade,
                'telefone' => $request->telefone,                
            ]);
            return redirect('usuarios')->with('mensagem', 'Alterado com sucesso!');
        }
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('usuarios')->where('id', $id)->delete();
        return redirect('usuarios')->with('mensagem', 'Excluído com sucesso!');
    }
}
