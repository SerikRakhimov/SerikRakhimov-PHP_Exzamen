@extends('layouts.app')

@section('content')
    <h3>Заявка:</h3>
    <div class="mb-3 btn-group btn-group-sm">

        <a class="btn btn-info" href="{{ route('order.edit', $order) }}">Изменить</a>

        <a class="btn btn-danger delete-link" href="{{route('order.delete', $order)}}" class="delete-link"
           data-target="delete-form">
            Удалить
            <form action="{{route('order.delete', $order)}}" method="POST" style="display:none;" id='delete-form'>
                @csrf
                @method('DELETE');
            </form>
        </a>
        <a class="btn btn-primary" href="{{ route('order.index', $order) }}">Список заявок</a>
    </div>

    <p>{{$order->language}}</p>
    <p>{{$order->input}}</p>
    <p>{{$order->output}}</p>
    <p>{{$order->user_id}}</p>
    <script>
        let link = document.querySelector('.delete-link');
        let target = link.dataset.target;

        link.addEventListener('click', function (event) {
            event.preventDefault();
            document.getElementById(target).submit();

        })

    </script>
@endsection