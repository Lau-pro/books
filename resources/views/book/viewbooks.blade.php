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
                <div class="text-gray-900 sm:p-2 lg:p-6">
                   <table class="table-auto w-full text-center md:text-sm">
                    {{-- search filter --}}

                    <div class="py-2 px-2 sm:px-4 md:px-6 lg:px-8 flex flex-wrap">
                        <!-- Author Filter Form -->
                        <div class="w-full md:w-1/2 lg:w-1/3">
                            <form action="{{ route('book.view') }}" method="GET" class="max-w-lg w-full">
                                <x-input-label>
                                    Author
                                </x-input-label>
                                <div class="flex flex-wrap">
                                    <x-text-input name="author" :value="request('author')" class=""/>
                                    <input type="hidden" name="genre" value="{{ request('genre') }}"> 
                                    <x-primary-button class="mt-2 mx-3">
                                        {{__('Search')}}
                                    </x-primary-button>
                                </div>
                            </form>
                             <!-- Clear Button -->
                        @if(request('author') || request('genre'))
                        <div class="my-2">
                            <a href="{{ route('book.view') }}">
                                <x-primary-button>
                                    {{ __('Clear') }}
                                </x-primary-button>
                            </a>
                        </div>
                        @endif
                        </div>
                    
                       
                    
                        <!-- Genre Dropdown Filter -->
                        <div class="w-full md:w-1/2 lg:w-1/3 sm:flex sm:items-center my-2 md:">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-2 py-3 border border-slate-200 text-md leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ __('Genre') }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                    
                                <x-slot name="content">
                                    @foreach($genre as $genres)
                                    <form method="GET" action="{{ route('book.view') }}">
                                        <input name="genre" type="hidden" value="{{ $genres }}">
                                        <input type="hidden" name="author" value="{{ request('author') }}"> 
                                        <button type="submit" class="cursor-pointer block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            {{ $genres }}
                                        </button>
                                    </form>
                                    @endforeach
                                </x-slot>
                            </x-dropdown>
                        </div>
                    </div>
                    
{{--  --}}
                        <thead>
                            <tr class="bg-gray-600 text-white lg:text-lg md:text-md rounded-md text-sm lowercase md:uppercase lg:upppercase">
                            @foreach ( $header as $headers )
                                <th>{{ $headers }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ( $books as $book )
                            <tr class="even:bg-slate-200 py-3 rounded-md lg:text-lg text-xs md:text-md">
                                <td>N- {{ $book->isbn }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->genre }}</td>
                                <td>{{ $book->published_date }}</td>
                                    @php
                                    $uniqueId = uniqid();
                                    @endphp
                                <td class="flex flex-wrap justify-center gap-1">
                                    <!-- Dropdown for small screens -->
                                    <x-actionmenu 
                                        :edit-url="route('book.edit', ['id' => $book->id])" 
                                        :delete-url="route('book.del', ['id' => $book->id])" 
                                        :unique-id="$uniqueId" 
                                    />
                                
                                    <!-- Full buttons for larger screens -->
                                    <div class="hidden lg:flex flex-wrap justify-center gap-1">
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
                                    </div>
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
