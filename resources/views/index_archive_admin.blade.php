@extends('layouts.app')

@section('content')
    @if(Auth::user()->isAdmin())
        <h3 class="display-5" style="color:white;background-color: #6cb2eb">Архив</h3>
        <br>
        <table class="table  table-bordered table-hover">
            <caption>Выберите заявку для просмотра</caption>
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Дата заявки</th>
                <th scope="col">Языки перевода</th>
                <th scope="col">Текст для перевода</th>
                <th scope="col">Автор</th>
                <th scope="col">Дата исполнения</th>
                <th scope="col">Результат перевода</th>
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
                        <a href="{{route('order.show_archive_admin',$order)}}">
                            {{$order->created_at}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('order.show_archive_admin',$order)}}">
                            {{$order->language}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('order.show_archive_admin',$order)}}">
                            {{$order->input}}
                            @if($order->file_input!="")
                                <img src="{{Storage::url('save.png')}}"
                                     width="15" height="15">
                            @endif
                        </a>
                    </td>
                    <td>
                        <a href="{{route('order.show_archive_admin',$order)}}">
                            {{$order->user->name}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('order.show_archive_admin',$order)}}">
                            {{$order->updated_at}}
                        </a>
                    </td>
                    <td>
                        <a href="{{route('order.show_archive_admin',$order)}}">
                            {{$order->output}}
                            @if($order->file_output!="")
                                <img src="{{Storage::url('save.png')}}"
                                     width="15" height="15">
                            @endif
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
@endsection
