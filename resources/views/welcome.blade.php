@extends('layouts.guest')

@section('header')
    Bem-vindo ao SecureShopID
@endsection

@section('body')
    <div class="container text-center py-5">
        <h1 class="display-4">Bem-vindo ao meu site!</h1>
        <p class="lead mt-3">
            Utilize o reconhecimento facial para facilitar o login.
        </p>

        <div class="row mt-5 justify-content-center">
            <div class="col-md-6">
                <div class="card card-md">
                    <div class="card-body">
                        <h3 class="card-title">Login com Face</h3>
                        <p class="card-text">Acesse sua conta rapidamente com o reconhecimento facial.</p>
                        <a href="{{ route('face.login') }}" class="btn btn-primary btn-lg w-100 mt-4">Fazer Login com
                            Face</a>
                    </div>
                    <div class="hr-text">OU</div>
                    <div class="card-body">
                        <h3 class="card-title">Login com dados</h3>
                        <p class="card-text">Acesse sua conta da maneira convencional.</p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100 mt-4">Fazer Login</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-4 mt-md-0">
                <div class="card card-md">
                    <div class="card-body">
                        <h3 class="card-title">Cadastro</h3>
                        <p class="card-text">Registre-se agora e associe seu rosto à sua conta.</p>
                        <a href="{{ route('register') }}" class="btn btn-success btn-lg w-100 mt-4">Cadastrar-se</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
