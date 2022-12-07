@extends('layouts.app')

@section('title')
    Экскурсии
@endsection

@section('activeExcurs')
    active
@endsection

@section('content')
<div class="container d-flex">
    <div>
        @include('layouts.dev.sidebarProfile')
    </div>
    <div class="p-3 w-100">
        <div class="mt-5">

            <div class="table__admin">
            <table class="table table__admin" style="vertical-align: middle">
                <thead>
                  <tr>
                    <th  scope="col">Номер мероприятия</th>
                    <th  scope="col">Название мероприятия</th>
                    <th  scope="col">Начало мероприятия</th>
                    <th  scope="col">Окончание мероприятия</th>
                    <th  scope="col"></th>
                    <th  scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($user->excurs as $val)
                    <tr>
                        <td >{{ $val->id }}</td>
                        <td style="max-width: 215px" class="text-break">{{ $val->name }}</td>
                        <td >{{ $val->date_start }}</td>
                        <td >{{ $val->date_end }}</td>
                        <td ><a href="{{ route('excursions.show', ['id' => $val->id]) }}" class="btn btn-outline-success">Просмотр</a></td>
                        <td><a href="{{ route('profile.excursDelete', ['id' => $val->id]) }}" class="btn btn-outline-danger">Отменить запись</a></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>


    </div>
</div>
@endsection
