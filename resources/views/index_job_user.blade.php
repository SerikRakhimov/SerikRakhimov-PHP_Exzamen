@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center">
        <a href="{{route('order.create')}}" class="btn btn-success ml-auto">
            Создать новую заявку
        </a>
    </div>
    <h3>Мои заявки</h3>
    <br>
    <table class="table  table-bordered table-hover">
        <caption>Выберите заявку для работы</caption>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Дата заявки</th>
            <th scope="col">Языки перевода</th>
            <th scope="col">Текст для перевода</th>
            <th scope="col">Автор</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        ?>
        @foreach($orders as $order)
            <?php
            $i++;
            ?>
            <tr>
                <th scope="row">{{$i}}</th>
                <td>
                    <a href="{{route('order.show_job_user',$order)}}">
                    {{$order->created_at}}
                    </a>
                </td>
                <td>
                    <a href="{{route('order.show_job_user',$order)}}">
                    {{$order->language}}
                    </a>
                </td>
                <td>
                    <a href="{{route('order.show_job_user',$order)}}">
                        {{$order->input}}
                        @if($order->file_input!="")
                            <img src="{{Storage::url('save.png')}}"
                                 width="15" height="15">
                        @endif
                    </a>
                </td>
                <td>
                    <a href="{{route('order.show_job_user',$order)}}">
                    {{$order->user->name}}
                    </a>
                </td>
            </tr>
            </a>
        @endforeach
        </tbody>
    </table>

@endsection
