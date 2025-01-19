@extends('layouts.app')

@section('header')
    Gerenciamento de Conta
@endsection

@section('body')
    @if (empty(auth()->user()->face_id))
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <h3 class="card-title">Cadastrar Face</h3>
            </div>
            <div class="card-body">
                <p class="text-muted">Descrição</p>
                <div class="text-end">
                    <a href="/face/register" class="btn btn-primary">
                        Cadastrar
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 6l6 6l-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Atualizar Face</h3>
        </div>
        <div class="card-body">
            <p class="text-muted">Descrição</p>
            <div class="text-end">
                <a href="/face/edit" class="btn btn-primary">
                    Atualizar
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Deletar Face</h3>
        </div>
        <div class="card-body">
            <p class="text-muted">Descrição</p>
            <div class="text-end">
                <a href="/face/delete" class="btn btn-danger">
                    Deletar
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right"
                        width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 6l6 6l-6 6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
        <!-- Deletar Conta -->
        <div class="card mb-4">
            <div class="card-body">
                @livewire('profile.delete-user-form')
            </div>
        </div>
    @endif
@endsection
