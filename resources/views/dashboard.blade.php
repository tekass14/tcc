@extends('layouts.app')

@section('header')
    TCC Arthur Teixeira Kai - Face Recognition
@endsection

@section('body')
    <div class="row row-cards">
        <!-- Imagem à esquerda -->
        <div class="col-lg-5">
            <div class="card align-items-center">
                <div class="card-body text-center" style="height: 30em">
                    <img src="{{ asset('img/ilustrativo.png') }}" style="height: 30em" alt="Descrição da imagem"
                        class="img-fluid rounded">
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card">
                <div class="card-body" style="height: 30em">
                    <h1 class="text-primary">Bem vindo ao Face Recognition</h1>
                    <p>
                        Este sistema oferece uma plataforma para autenticação e registro usando reconhecimento
                        facial.
                        Simples, seguro e eficiente.
                    </p> <br>
                    <p>
                        Feito para aplicar os conhecimentos adquiridos em Desenvolvimento Web e Móvel, Banco de dados e
                        Análise de Projeto ao decorrer
                        de
                        todo o curso.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
