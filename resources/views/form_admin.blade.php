@extends('layouts.app')

@section('content')
    @if(Auth::user()->isAdmin())
        <?php
        $update = isset($order);
        ?>
        <h3 class="display-5">
            @if (!$update)
                Создание заявки:
            @else
                Ввод перевода:
            @endif
        </h3>
        <form action="{{$update ? route('order.update_admin',$order):route('order.store')}}" method="POST"
              class="card card-body" enctype=multipart/form-data>
            @csrf

            @if ($update)
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="language">Языки перевода <span class="text-danger"></span></label>
                <input type="text"
                       name="language"
                       id="language"
                       class="form-control @error('language') is-invalid @enderror"
                       placeholder="например: анг-рус..."
                       value="{{ old('language') ?? ($order->language ?? '') }}"
                       disabled>
                @error('language')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="input">Текст для перевода<span class="text-danger"></span></label>
                <textarea name="input"
                          id="input"
                          class="form-control @error('input') is-invalid @enderror"
                          placeholder="Что переводить?..."
                          disabled>
        {{ old('input') ?? ($order->input ?? '') }}
        </textarea>
                @error('input')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="output">Результат перевода<span class="text-danger">*</span></label>
                <textarea name="output"
                          id="output"
                          class="form-control @error('output') is-invalid @enderror"
                          placeholder="Введите результат перевода или любой комментарий, если есть вложенный файл...">{{ old('output') ?? ($order->output ?? '') }}
        </textarea>
                @error('output')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="input">Или вложите файл с текстом перевода<span class="text-danger">*</span></label>
                <input type="file"
                       name="file_output"
                       id ="file_output">
            </div>

            <button>
                @if (!$update)
                    Добавить
                @else
                    Сохранить
                @endif
            </button>
        </form>

    @endif
@endsection