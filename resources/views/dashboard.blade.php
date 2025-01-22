@extends('layouts.app')

@section('header')
    Projeto Integrador Arthur Teixeira Kai - SecureShopID
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
                    <h1 class="text-primary">Bem vindo ao meu site!</h1>
                    <p>
                        Este sistema contém duas funcionalidades principais: autenticação com reconhecimento facial; e um CRUD de produtos e vendas, com clientes e categorias de produtos.
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
