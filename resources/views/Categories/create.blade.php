@extends('layouts.app')


@section('content')
<div>
    <div class="container">
        <h1 class="text-2xl font-bold mb-5">Создать категорию</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                @session('CategoryCreated')
                    <div class="text-green-500">Категория успешно создана!</div>
                @endsession
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Название</label>
                <input type="text" name="name" id="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{old('name')}}">
                @error('name')
                    <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Создать</button>
            <a href="{{ route('categories.index') }}" class="ml-3 text-gray-600">Назад к списку категорий</a>
        </form>
    </div>
    
</div>
@endsection
