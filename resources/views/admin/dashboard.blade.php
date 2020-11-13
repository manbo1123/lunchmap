@extends('layout')

@section('content')
    <div class = 'container'>
        <div class="d-flex">
            <h1>Página de administrador!!!</h1>
        </div>
        <p>¡Hola! {{ Auth::user()->name }}</p>
        <a href="{{ route('shop.list') }}" class="btn btn-outline-secondary">
            <i class="fas fa-home fa-2x"></i>
        </a>
    </div>

    <div>
        <div class="hidden fixed top-0 right-0 py-1 sm:block">
            <div class="d-flex">
                <!--  ログアウト -->
                <form method="POST" action="{{ route('logout') }}" class="py-2">
                    @csrf
                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
@endsection

