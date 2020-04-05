@extends('layouts.app')

@section('content')
    @if(Auth::user()->isAdmin())
        <h3 class="display-5" style="color:white;background-color: #6cb2eb">Заявка:</h3>
        <div class="mb-3 btn-group btn-group-sm">
            <a class="btn btn-info" href="{{ route('order.edit_admin', $order) }}">Ввести перевод</a>
        </div>

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

        <div class="mb-3 btn-group btn-group-sm">
            <a class="btn btn-primary" href="{{ route('order.index_job_admin') }}">Вернуться в Перевод</a>
        </div>

    @endif
@endsection