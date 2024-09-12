<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full mx-2 my-4 px-2 text-end">
                <a href="{{ route('book.add') }}" class="bg-gray-600 text-white text-md font-semibold py-2 px-2 rounded-md shadow-gray-200 hover:bg-gray-800">New book</a>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" text-gray-900 sm:p-2 lg:p-6">
                   <table class="table-auto w-full text-center md:text-sm">
                        <thead>
                            <tr class="bg-gray-600 text-white font-bold lg:text-lg md:text-md rounded-md sm:text-sm sm:uppercase">
                            @foreach ( $header as $headers )
                                <th>{{ $headers }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ( $books as $book )
                            <tr class=" even:bg-slate-200 py-3 rounded-md sm:text-sm lg:text-lg md:text-md">
                                <td>N- {{ $book->isbn }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->genre }}</td>
                                <td>{{ $book->published_date }}</td>
                                <td class="flex flex-wrap justify-center gap-1">
                                    <a href="{{ route('book.edit', ['id' => $book->id]) }}">
                                        <x-primary-button>
                                            {{ __('Edit') }}
                                        </x-primary-button>
                                    </a>
                                   <form method="post" action="{{ route('book.del', ['id' => $book->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button type="submit">
                                        {{ __('Del') }}
                                    </x-danger-button>
                                </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                   </table>
                </div>
                <div class="my-2 px-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
