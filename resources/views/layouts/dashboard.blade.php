@extends('layouts.app')

@section('content')
    <div class="flex flex-grow">
        <aside class="w-1/4 bg-gray-800 text-white p-5">
            <h2 class="text-2xl font-bold mb-4">{{ Auth::user()->name }}</h2>
            <ul>
                <li><a href="{{ route('tasks.index') }}" class="block py-2 hover:bg-gray-700">Задачи</a></li>
                <li><a href="{{ route('categories.index') }}" class="block py-2 hover:bg-gray-700">Категории</a></li>
            </ul>
        </aside>
        @yield('dashboardContent')
    </div>
@endsection
