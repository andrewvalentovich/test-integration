@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Форма создания лида</div>

                <div class="card-body">
                    <form action="{{ route('lead.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="surname">Ваша фамилия</label>
                            <input type="text" name="surname" value="{{ old('surname') }}" class="form-control" id="surname" placeholder="Иванов">
                            @error('surname')
                                <label class="text-danger" for="surname">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Ваше имя</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Александр">
                            @error('name')
                            <label class="text-danger" for="name">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="patronymic">Ваше отчество</label>
                            <input type="text" name="patronymic" value="{{ old('patronymic') }}" class="form-control" id="patronymic" placeholder="Владимирович">
                            @error('patronymic')
                            <label class="text-danger" for="patronymic">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="birthDay">Дата рождения</label>
                            <input type="text" name="birthDay" value="{{ old('birthDay') }}" class="form-control" id="birthDay" placeholder="22.03.1992">
                            @error('birthDay')
                            <label class="text-danger" for="birthDay">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Номер телефона</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="phone" placeholder="89001231212">
                            @error('phone')
                            <label class="text-danger" for="phone">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Адрес электронной почты</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="name@example.com">
                            @error('email')
                            <label class="text-danger" for="email">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="comment">Комментарий</label>
                            <textarea class="form-control" name="comment" id="comment" rows="3">{{ old('comment') }}</textarea>
                            @error('comment')
                            <label class="text-danger" for="comment">{{ $message }}</label>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#birthDay", {
            dateFormat: "d.m.Y"
        });
    </script>
@endsection
