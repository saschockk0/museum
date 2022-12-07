@extends('layouts.app')

@section('title')
    Панель управления
@endsection

@section('activeAdmin')
    active
@endsection

@section('content')
<div class="container d-flex">
    <div>
        @include('layouts.dev.sidebarProfile')
    </div>
    <div class="p-3 w-100">
        @if(Auth::user()->isAdmin())
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Выдача доступа</h4>
            </div>
            <form action="{{ route('admin.roles') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <select name="user" class="form-select" aria-label="Default select example">
                        <option selected>Выберите пользователя</option>
                        @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} {{ $user->surname }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <select name="role" class="form-select" aria-label="Default select example">
                        <option selected>Выберите роль</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Изменить</button>
            </form>

        </div>
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Сотрудники</h4>
            </div>
            <div class="table__admin">
            <table class="table table__admin" style="vertical-align: middle">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Уровень доступа</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($staff as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role->name }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        @endif
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h4>Экскурсии</h4>
                <a href="#" data-bs-toggle="modal" data-bs-target="#createExcurs" class="btn btn-primary">Добавить</a>
            </div>
            <div class="table__admin">
            <table class="table table__admin" style="vertical-align: middle">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Начало мероприятия</th>
                    <th scope="col">Окончание мероприятия</th>
                    <th scope="col">Мест</th>
                    <th scope="col">Статус</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($excursion as $excurs)
                    <tr>
                        <th scope="row">{{ $excurs->id }}</th>
                        <td style="max-width: 215px" class="text-break">{{ $excurs->name }}</td>
                        <td>{{ $excurs->date_start }}</td>
                        <td>{{ $excurs->date_end }}</td>
                        <td>{{ $excurs->places }}</td>
                        <td><span class="badge text-bg-success">{{ $excurs->status->name }}</span></td>
                        <td><a class="btn btn-outline-success" href="{{ route('excursions.show', ['id' => $excurs->id]) }}">Открыть</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="mt-5">
            
                <tbody>
                    @foreach ($exhibition as $exhib)
                    <tr>
                        <th scope="row">{{ $exhib->id }}</th>
                        <td style="max-width: 215px" class="text-break">{{ $exhib->name }}</td>
                        <td>{{ $exhib->date_start }}</td>
                        <td>{{ $exhib->date_end }}</td>
                        <td>{{ $exhib->places }}</td>
                        <td><span class="badge text-bg-success">{{ $exhib->status->name }}</span></td>
                        <td><a class="btn btn-outline-success" href="{{ route('exhib.showExhib', ['id' => $exhib->id]) }}">Открыть</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>


    </div>
</div>

@include('layouts.dev.modalAddExcurs')
@include('layouts.dev.modalAddExhib')
@endsection
