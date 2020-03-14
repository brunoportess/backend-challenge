<?php


namespace App\Repository;


use App\Models\UserModel;

class UsuarioRepository
{
    /**
     * @var UserModel
     */
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    function SalvarUsuario($dados)
    {
        try {
            $usuario = $this->userModel->create($dados);
            return $usuario;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function AtualizarUsuario($id, $dados)
    {
        try {
            $usuario =$this->userModel->find($id);
            $usuario->fill($dados);
            //dd([$dados, $empresa]);
            $usuario->save();
            return $usuario;
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function AtualizarUsuarioPormLearnId($id, $dados)
    {
        try {
            $usuario =$this->userModel->where('mlearn_id', '=', $id)->first();
            $usuario->fill($dados);
            //dd([$dados, $empresa]);
            $usuario->save();
            return $usuario;
        }catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    function ListarUsuarios()
    {
        return $this->userModel->orderBy('name')->get();
    }
}
