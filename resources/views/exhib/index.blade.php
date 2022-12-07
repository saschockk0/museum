@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="title__container">Выставки</h1>
    <form class="d-flex mb-3" method="GET" action="{{ route('exhib.search') }}" role="search">
        <input class="form-control me-2" type="search" placeholder="Поиск" name="search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Поиск</button>
      </form>
    <div class="container__items">
        @foreach ($exhibition as $exhib)
        <div class="container__item">
            <div class="item__one">
                <img src="{{ asset('img/exhib/' . $exhib->photo) }}" class="item__one__img" alt="">
            </div>
            <div class="item__two">
                <h3 class="item__one__title">{{ $exhib->name }}</h3>
                <p class="item__two__description text-break">{{ $exhib->description }}</p>
                <p class="item__two__date">Начало мероприятия: {{ $exhib->date_start }}</p>
                <p class="">Окончание мероприятия: {{ $exhib->date_end }}1</p>
                <p class="">Мест: {{ $exhib->places }}</p>
                <p class="">Цена: {{  $exhib->price  }}&#8381;</p>
                <a href="{{ route('exhib.showExhib', ['id' => $exhib->id]) }}" class="btn btn-outline-success">Подробнее</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
