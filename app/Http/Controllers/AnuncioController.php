<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;

class AnuncioController extends Controller
{
    public function anuncios()
    {
        // Pega todos os anuncios do usuário logado
        $anuncios = Anuncio::where('user_id', auth()->id())->get();

        return inertia('Anuncio/Anuncios', [
            'anuncios' => $anuncios
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'telefone' => 'required',
            'whatsapp' => 'required',
            'email' => 'required|email',
            'cidade' => 'required',
            'tipo' => 'required',
        ]);

        $imageName = time() . '.' . $request->imagem->extension();

        $request->imagem->move(public_path('images'), $imageName);

        $anuncio = new Anuncio();
        $anuncio->titulo = $request->titulo;
        $anuncio->descricao = $request->descricao;
        $anuncio->imagem = $imageName;
        $anuncio->telefone = $request->telefone;
        $anuncio->whatsapp = $request->whatsapp;
        $anuncio->email = $request->email;
        $anuncio->cidade = $request->cidade;
        // Se o tipo for Ajudar, o valor é 0, se for Precisar, o valor é 1
        $anuncio->tipo = $request->tipo === 'Ajudar' ? 0 : 1;
        $anuncio->user_id = auth()->id();
        $anuncio->save();

        return redirect()->route('anuncios');
    }

    public function destroy(Anuncio $anuncio)
    {
        $anuncio->delete();

        return redirect()->route('anuncios');
    }

    public function show(Anuncio $anuncio)
    {
        return inertia('Anuncio/Show', [
            'anuncio' => $anuncio
        ]);
    }
}
