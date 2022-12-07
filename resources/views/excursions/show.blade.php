@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container__show">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mt-3">Назад</a>
        <img src="{{ asset('img/excurs/' . $excursion->photo) }}" class="img-show" alt="">
        <h1 class="title__show">{{ $excursion->name }}</h1>
        <p class="text-bresk text__show"><span class="fw-bold">Описание</span>: {{ $excursion->description }}</p>
        <p><span class="fw-bold">Начало мероприятия</span>: {{ date("Y-m-d H:i", strtotime($excursion->date_start)) }}</p>
        <p><span class="fw-bold">Окончание мероприятия</span>: {{ date("Y-m-d H:i", strtotime($excursion->date_end)) }}</p>
        <p><span class="fw-bold">Стоимость билета</span>: {{ $excursion->price }}&#8381;</p>
        <p><span class="fw-bold">Места</span>: {{ $excursion->places }}</p>
        <p><span class="fw-bold">Статус</span>: <span class="badge text-bg-success">{{ $excursion->status->name }}</span></p>
        @if($checkUser == "default")
        <a href="{{ route('profile.index') }}" class="btn btn-outline-warning">Авторизируйтесь</a>
        @elseif($excursion->status->id ==2)
        <button class="btn btn-outline-danger" disabled>Записаться невозможно</button>
        @elseif ($checkUser == Null)
        <a href="{{ route('excursions.writeExcurs', ['id' => $excursion->id]) }}" class="btn btn-outline-primary">Записаться</a>
        @else
        <button type="button" class="btn btn-outline-warning" disabled>Вы уже записаны</button>
        @endif
    </div>
    @if(Auth::check())
    @if(Auth::user()->isAdmin() || Auth::user()->isModerator())
    <div class="mt-5 mb-5">
        @if (session('status'))
                <div class="alert alert-success alert-info mt-2" role="alert">
                    {{ session('status') }}
                </div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <h4>Записанные на экскурсию</h4>
            <a href="#" data-bs-toggle="modal" class="btn btn-success" data-bs-target="#changeExcurs">Сменить статус</a>
        </div>
        <div class="table__admin">
        <table class="table table__admin" style="vertical-align: middle">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Почта</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($excursion->user as $user)
                <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->surname }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    {{-- <form method="GET" action="{{ route('admin.excursDeleteUser', ['id' => $excursion->id]) }}">
                        <input type="hidden" value="{{ $user->id }}" name="user_id">
                        <button class="btn btn-outline-danger" type="submit">Удалить запись</button>
                    </form> --}}
                    <a class="btn btn-outline-danger" href="{{ route('admin.excursDeleteUser', ['user' => $user->id, 'excurs'=>$excursion->id]) }}">Удалить запись</a>
                </td>

            </tr>
            @endforeach

            </tbody>
          </table>
    </div>
    @endif
    @endif
</div>

@include('layouts.dev.modalStatusExcurs')
@endsection
