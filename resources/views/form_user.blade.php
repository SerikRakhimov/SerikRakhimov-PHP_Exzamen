@extends('layouts.app')

@section('content')
<?php
$update = isset($order);
?>
<h3 class="display-5">
    @if (!$update)
        Создание заявки:
    @else
        Корректировка заявки:
    @endif
</h3>
<form action ="{{$update ? route('order.update_user',$order):route('order.store')}}" method="POST" class="card card-body" enctype=multipart/form-data>
    @csrf

    @if ($update)
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="language">Языки перевода <span class="text-danger">*</span></label>
        <input type="text"
               name="language"
               id="language"
               class="form-control @error('language') is-invalid @enderror"
               placeholder="Введите языки перевода (например: анг-рус)..."
               value="{{ old('language') ?? ($order->language ?? '') }}">
        @error('language')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="input">Текст для перевода<span class="text-danger">*</span></label>
        <textarea name="input"
                  id="input"
                  class="form-control @error('input') is-invalid @enderror"
                  placeholder="Введите текст для перевода или любой комментарий, если есть вложенный файл...">{{ old('input') ?? ($order->input ?? '') }}</textarea>
        @error('input')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="input">Или вложите файл с текстом для перевода<span class="text-danger">*</span></label>
        <input type="file"
               name="file_input"
               id ="file_input">
    </div>

    <button>
        @if (!$update)
            Добавить
        @else
            Сохранить
        @endif
    </button>
</form>
@endsection