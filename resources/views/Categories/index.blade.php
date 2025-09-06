<div>
    @extends('layouts.dashboard')

    @section('dashboardContent')
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold mb-5">Список категорий</h1>
            <a href="{{ route('categories.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Создать категорию</a>
            <table class="min-w-full mt-5 bg-white">
                <thead>
                    <tr class="w-full bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Название</th>
                        <th class="py-3 px-6 text-left">Действия</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($categories as $category)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left">{{ $category->id }}</td>
                            <td class="py-3 px-6 text-left">{{ $category->name }}</td>
                            <td class="py-3 px-6 text-left">
                                <a href="{{ route('categories.edit', $category->id) }}"
                                    class="text-yellow-500 hover:text-yellow-700">Редактировать</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
</div>
