@extends('layouts.app')

@section('title')
    Главная
@endsection

@section('activeSettings')
    active
@endsection

@section('content')
<div class="container d-flex">
    <div>
        @include('layouts.dev.sidebarProfile')
    </div>
    <div class="p-3" style="width: 100%">
        <form action="{{ route('profile.changePassword') }}" method="POST" style="width: 100%;">
            @csrf
            @method('put')
            <h3>Сменить пароль</h3>
            <div class="mb-3">
              <label for="oldpassword" class="form-label">Введите старый пароль</label>
              <input type="password" name="oldpassword" class="form-control" id="oldpassword">
              @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Введите новый пароль</label>
              <input type="password" name="password" class="form-control" id="password">
              @error('newpassword')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Повторите пароль</label>
              <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>
        </form>
        <form class="mt-5" action="{{ route('profile.image') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Фотография</h3>
            <label for="#" style="margin-bottom: 5px">Выбрать изображение</label>
            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="file" id="inputGroupFile02">
            </div>

            <button type="submit" class="btn btn-primary">Подтвердить</button>
        </form>
    </div>
</div>
@endsection
