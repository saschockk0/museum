@extends('layouts.app')

@section('title')
    Главная
@endsection

@section('activeHome')
    active
@endsection

@section('content')
<div class="container d-flex">
    <div>
        @include('layouts.dev.sidebarProfile')
    </div>
    <div class="p-3">
        <div class="d-flex gap-4">
            <img class="img-profile" src="{{ asset('img/iconUser/'. Auth::user()->photo) }}" alt="" class="rounded">
            <div class="mt-4">
                <h3>{{ Auth::user()->name }} {{ Auth::user()->surname }}</h3>
                <p style="margin-bottom: 0">Дата регистрации: 2022-10-10</p>
                @if(Auth::user()->isAdmin() || Auth::user()->isModerator())
                <p class="fs-5">Статус: <span class="">{{ Auth::user()->role->name }}</span></p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
