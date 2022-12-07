@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="title__container">Экскурсии</h1>
    <form class="d-flex mb-3" method="GET" action="{{ route('excursions.search') }}" role="search">
        <input class="form-control me-2" type="search" name="search" placeholder="Поиск" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Поиск</button>
      </form>
    <div class="container__items">
        @foreach ($excursion as $excurs)
        <div class="container__item">
            <div class="item__one">
                <img src="{{ asset('img/excurs/' . $excurs->photo) }}" class="item__one__img" alt="">
            </div>
            <div class="item__two">
                <h3 class="item__one__title">{{ $excurs->name }}</h3>
                <p class="item__two__description text-break">{{ $excurs->description }}</p>
                <p class="item__two__date">Начало мероприятия: {{ $excurs->date_start }}</p>
                <p class="">Окончание мероприятия: {{ $excurs->date_end }}1</p>
                <p class="">Мест: {{ $excurs->places }}</p>
                <p class="">Цена: {{  $excurs->price  }}&#8381;</p>
                <a href="{{ route('excursions.show', ['id' => $excurs->id]) }}" class="btn btn-outline-success">Подробнее</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
