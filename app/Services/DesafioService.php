<?php


namespace App\Services;


use App\Helpers\Utils;
use App\Repository\UsuarioRepository;

class DesafioService
{
    /**
     * @var UsuarioRepository
     */
    private $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * @param int $tamanhoMatriz
     * @return array
     */
    function GerarMatrizQuadrada(int $tamanhoMatriz)
    {
        $matrizQuadrada = [];
        for($x=0; $x < $tamanhoMatriz; $x++)
        {
            $matrizQuadrada[$x] = [];

            for($y=0; $y < $tamanhoMatriz; $y++)
            {
                $valor = rand(1,50);
                array_push($matrizQuadrada[$x], $valor);
            }
        }
        return $matrizQuadrada;
    }

    /**
     * @param $matriz
     * @return array
     */
    function SomaDiagonalMatrizQuadrada($matriz)
    {
        $diagonalEsqDir = $diagonalDirEsq = 0;
        $tamanhoMatriz = count($matriz) - 1;
        $aux = 0;

        foreach ($matriz as $key => $value)
        {
            $diagonalEsqDir += $matriz[$aux][$aux];
            $diagonalDirEsq += $matriz[$tamanhoMatriz-$aux][$aux];
            $aux++;
        }

        return ['diagonalEsqDir' => $diagonalEsqDir, 'diagonalDirEsq' => $diagonalDirEsq];
    }

    function ListarUsuarios()
    {
        return $this->usuarioRepository->ListarUsuarios();
    }
    function SalvarUsuario($dados)
    {
        // SE TIVER INFORMADO A SENHA, CRIPTOGRAFA ELA
        if(array_key_exists('password', $dados) && !empty($dados['password']))
        {
            $dados['password'] = password_hash($dados['password'], PASSWORD_BCRYPT);
        }

        $dados['msisdn'] = substr($dados['msisdn'], 0, 15);

        // GARANTIR QUE SO TENHA SIDO INFORMADO NUMEROS NO TELEFONE
        $dados['msisdn']  = '+55'.preg_replace( '/[^0-9]/', '', $dados['msisdn'] );
        // SALVA O USUARIO NA BASE DE DADOS DA APLICACOA
        $response = $this->usuarioRepository->SalvarUsuario($dados);
        //return $response;
        // SE FOR STRING ESTA RETORNANDO A MENSAGEM DE ERRO DO BANCO
        // CASO CONTRARIO ESTA RETORNANDO O OBJETO DE SUCESSO DA INSEÇÃO
        if(is_string($response))
        {
            return $response;
        }
        // ENVIA O USUARIO CRIADO PARA A API DA MLEARN
        $responseAPi = self::CriarUsuariomLearn($response);
        // SE TIVER SUCESSO AO CADASTRAR PELA API ATUALIZA O ID DA MLEARN NO USUARIO LOCAL
        if(!is_string($responseAPi))
        {
            self::AtualizarUsuario($response->id, ['mlearn_id' => $responseAPi['data']['data']['id']]);
        }
        return $response;
    }

    function AtualizarUsuario($id, $dados)
    {
        return $this->usuarioRepository->AtualizarUsuario($id, $dados);
    }

    private function CriarUsuariomLearn($dados)
    {
        $usuario = [
            'msisdn' => $dados->msisdn,
            'name' => $dados->name,
            'access_level' => $dados->access_level,
            'external_id' => $dados->id
        ];

        return Utils::ApiRequestPost(env('M_LEARN_API_URL').'/integrator/'.env('M_LEARN_SERVICE_ID').'/users', $usuario);
    }

    function DowngrademLearn($userId)
    {
        return Utils::ApiRequestPut(env('M_LEARN_API_URL').'/integrator/'.env('M_LEARN_SERVICE_ID').'/users/'.$userId.'/downgrade');
    }

    function UpgrademLearn($userId)
    {
        return Utils::ApiRequestPut(env('M_LEARN_API_URL').'/integrator/'.env('M_LEARN_SERVICE_ID').'/users/'.$userId.'/upgrade');
    }

    function AtualizarUsuarioPormLearnId($id, $dados)
    {
        return $this->usuarioRepository->AtualizarUsuarioPormLearnId($id, $dados);
    }
}
