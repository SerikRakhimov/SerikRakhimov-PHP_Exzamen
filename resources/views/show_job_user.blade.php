@extends('layouts.app')

@section('content')
    <h3>Заявка:</h3>
    <div class="mb-3 btn-group btn-group-sm">

        <a class="btn btn-info" href="{{ route('order.edit_user', $order) }}">Изменить</a>

        <a class="btn btn-danger delete-link" href="{{route('order.delete', $order)}}" class="delete-link"
           data-target="delete-form">
            Удалить
            <form action="{{route('order.delete', $order)}}" method="POST" style="display:none;" id='delete-form'>
                @csrf
                @method('DELETE');
            </form>
        </a>
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
        <a class="btn btn-primary" href="{{ route('order.index_job_user') }}">Вернуться в Мои заявки</a>
    </div>

    <script>
        let link = document.querySelector('.delete-link');
        let target = link.dataset.target;

        link.addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById(target).submit();

        })

    </script>


@endsection