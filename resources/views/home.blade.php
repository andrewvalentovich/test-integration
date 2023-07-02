@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Форма создания лида</div>

                <div class="card-body">
                    <a href="{{ route('lead.create') }}">Создать лид</a>
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
