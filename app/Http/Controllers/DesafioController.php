<?php

namespace App\Http\Controllers;

use App\Services\DesafioService;

class DesafioController extends Controller
{
    /**
     * @var DesafioService
     */
    private $desafioService;

    public function __construct(DesafioService $desafioService)
    {

        $this->desafioService = $desafioService;
    }

    // RETORNA VIEW DA TELA INICIAL DOS DESFIOS
    function Index()
    {
        return view('home');
    }

    // RETORNA RESULTADO COM METODOLOGIA MAIS ELABORADA PARA PODER ADAPTAR E RECEBER PARAMETRO DO TAMANHO DA MATRIZ
    function  DesafioUm()
    {
        $tamanhoMatriz = 5;
        // RECEBE UMA MATRIZ QUADRADA COM VALORES RANDOMICOS
        $matriz = $this->desafioService->GerarMatrizQuadrada($tamanhoMatriz);
        $matrizDiagonal = $this->desafioService->SomaDiagonalMatrizQuadrada($matriz);
        return view('desafio-um', compact('matriz', 'matrizDiagonal'));
    }

    function  DesafioDois()
    {
        $listaUsuarios = $this->desafioService->ListarUsuarios();
        return view('desafio-dois', compact('listaUsuarios'));
    }
}
