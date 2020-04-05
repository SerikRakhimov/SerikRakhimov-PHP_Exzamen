@extends('layouts.app')

@section('content')
    <h3>Заявка:</h3>

    <p>Дата заявки: <b>{{$order->created_at}}</b></p>
    <p>Языки перевода: <b>{{$order->language}}</b></p>
    <p>Текст для перевода: <b>{{$order->input}}</b></p>
    @if($order->file_input!="")
        <a href="{{Storage::url($order->file_input)}}">
            <p>Скачать вложенный файл
                <img src="{{Storage::url('save.png')}}"
                     width="15" height="15" alt="Вложенный файл">
            </p>
        </a>
    @endif

    <p>Автор: <b>{{$order->user->name}}</b></p>
    <p>Дата исполнения: <b>{{$order->updated_at}}</b></p>

    <p>Результат перевода: <b>{{$order->output}}</b></p>
    @if($order->file_output!="")
        <a href="{{Storage::url($order->file_output)}}">
            <p>Скачать вложенный файл
                <img src="{{Storage::url('save.png')}}"
                     width="15" height="15" alt="Вложенный файл">
            </p>
        </a>
    @endif

    <div class="mb-3 btn-group btn-group-sm">
        <a class="btn btn-primary" href="{{ route('order.index_archive_user') }}">Вернуться в Мой архив</a>
    </div>

@endsection