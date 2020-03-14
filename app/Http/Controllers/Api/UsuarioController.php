<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Utils;
use App\Http\Controllers\Controller;
use App\Services\DesafioService;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * @var DesafioService
     */
    private $desafioService;

    public function __construct(DesafioService $desafioService)
    {
        $this->desafioService = $desafioService;
    }

    function SalvarUsuario(Request $request)
    {
        $dados = $request->all();
        //dd($dados);
        $response = $this->desafioService->SalvarUsuario($dados);
        return Utils::ResponseJson($response);
    }
}
