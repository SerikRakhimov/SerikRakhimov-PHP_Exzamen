@extends('layouts.app')

@section('content')
<br>
<h3>Список заявок на перевод:</h3>
<br>
    @foreach($orders as $order)
        <a href="{{route('order.show',$order)}}" class="mb-3 card card-body d-flex flex-row align-items-center">
            {{$order->input}}
        </a>
    @endforeach

<div class="d-flex align-items-center">
    <a href="{{route('order.create')}}" class="btn btn-success ml-auto">
        Создать новую заявку
    </a>
    <a href="/" class="btn btn-success ml-auto">
        Назад
    </a>
</div>
@endsection
