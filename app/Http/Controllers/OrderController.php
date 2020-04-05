<?php

namespace App\Http\Controllers;

use App\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    function index_job_user(Request $request)
    {
        // фильтр по текущему пользователю
        // признак перевода = false
        return view('index_job_user',
            ['orders' => Order::all()
                ->where('user_id', Auth::user()->id)
                ->where('translated', false)]);
    }

    function index_archive_user(Request $request)
    {
        // фильтр по текущему пользователю
        // признак перевода = true
        return view('index_archive_user',
            ['orders' => Order::all()
                ->where('user_id', Auth::user()->id)
                ->where('translated', true)]);
    }

    function index_job_admin(Request $request)
    {
        // все пользователи
        // признак перевода = false
        return view('index_job_admin',
            ['orders' => Order::all()
                ->where('translated', false)]);
    }

    function index_archive_admin(Request $request)
    {
        // все пользователи
        // признак перевода = true
        return view('index_archive_admin',
            ['orders' => Order::all()
                ->where('translated', true)]);
    }

    function create()
    {
        return view('form_user');
    }

    protected function rules_user()
    {
        return [
            'input' => 'required',
            'language' => 'required'
        ];
    }

    protected function rules_admin()
    {
        return [
            'output' => 'required'
        ];
    }

    function store(Request $request)
    {
        $request->validate($this->rules_user());

        // установка часового пояса нужно для сохранения времени
        date_default_timezone_set('Asia/Almaty');
        $path = "";
        if ($request->hasFile('file_input')) {
            $path = $request->file_input->store('public/uploads');
        }

        $order = new Order($request->except('_token', 'user_id'));
        $order->user_id = Auth::user()->id;
        $order->file_input = $path;
        $order->output = "";
        $order->file_output = "";
        $order->translated = false;

        $order->save();

        return redirect()->route('order.index_job_user');

    }

    function show_job_user(Order $order)
    {
        return view('show_job_user', ['order' => $order]);
    }

    function show_archive_user(Order $order)
    {
        return view('show_archive_user', ['order' => $order]);
    }

    function show_job_admin(Order $order)
    {
        return view('show_job_admin', ['order' => $order]);
    }

    function show_archive_admin(Order $order)
    {
        return view('show_archive_admin', ['order' => $order]);
    }

    function edit_user(Order $order)
    {
        return view('form_user', ['order' => $order]);
    }

    function edit_admin(Order $order)
    {
        return view('form_admin', ['order' => $order]);
    }

    function update_user(Request $request, Order $order)
    {
        $rules = $this->rules_user();

        $request->validate($rules);
        $data = $request->except('_token', '_method');

        $order->fill($data);
        Storage::delete($order->file_input);

        $path = "";
        if ($request->hasFile('file_input')) {
            $path = $request->file_input->store('public/uploads');
        }
        $order->file_input = $path;

        $order->save();
        return redirect()->route('order.index_job_user', $order);
    }

    function update_admin(Request $request, Order $order)
    {
        $rules = $this->rules_admin();
        //

        $request->validate($rules);
        $data = $request->except('_token', '_method');

        // установка часового пояса нужно для сохранения времени
        date_default_timezone_set('Asia/Almaty');

        $order->fill($data);
        Storage::delete($order->file_output);

        $path = "";
        if ($request->hasFile('file_output')) {
            $path = $request->file_output->store('public/uploads');
        }
        $order->file_output = $path;

        // признак, что перевод проведен
        $order->translated = true;

        $order->save();
        return redirect()->route('order.index_job_admin', $order);
    }

    function delete(Order $order)
    {
        //Для создания символьной ссылки используйте Artisan-команду storage:link:
        //php artisan storage:link
        // https://laravel.ru/docs/v5/filesystem

        Storage::delete($order->file_input);
        $order->delete();
        return redirect()->route('order.index_job_user');
    }
}