@extends('layout')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col">
                <h3>Matriz quadrada</h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                @foreach($matriz as $key => $value)
                    <div class="row">
                    @foreach($value as $keySubMatriz => $valueSubMatriz)
                        <div class="col-1">
                            {{$valueSubMatriz}}
                        </div>
                    @endforeach
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <h3>Resultado</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span>Soma em diagional esquerda -> direita: {{$matrizDiagonal['diagonalEsqDir']}}</span>
            </div>
            <div class="col-12">
                <span>Soma em diagional direita -> esquerda: {{$matrizDiagonal['diagonalDirEsq']}}</span>
            </div>
            <div class="col-12">
                <span>Diferença entre diagonais: {{$matrizDiagonal['diagonalEsqDir'] - $matrizDiagonal['diagonalDirEsq']}}</span>
            </div>
        </div>
    </div>
@endsection
