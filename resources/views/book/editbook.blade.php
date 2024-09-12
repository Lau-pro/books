<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    {{-- edit book info --}}
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-1/2 py-8 px-10 flex justify-center">
                    <form class="w-full max-w-lg" method="POST" action="{{ route('book.update', ['id' => $book->id]) }}">
                        @csrf

                        <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full px-3 mb-6 md:mb-0">

                            <x-input-label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name" >
                              Book Title
                            </x-input-label>
                            <x-text-input name="title"
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border
                                        rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                                    id="grid-title"
                                    type="text"
                                    placeholder="Example title"
                                    value="{{ $book->title }}"
                                />
                                {{-- error message --}}
                                @error('title')
                                <x-input-error :messages="$errors->get('title')"/>
                                @enderror
                          </div>

                          <div class="w-full px-3">
                            <x-input-label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 mt-4" for="grid-last-name">
                              Book Author
                            </x-input-label>
                            <x-text-input value="{{ $book->author }}" name="author" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-author" type="text" placeholder="Doe" />
                            @error('author')
                            <x-input-error :messages="$errors->get('author')"/>
                             @enderror
                          </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                          <div class="w-full md:w-1/3 px-3">
                            <x-input-label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                              ISBN
                            </x-input-label>
                            <div class="relative">
                                <x-text-input value="{{ $book->isbn }}" name="isbn" class="pl-7 appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="isbn" type="text"/>
                                <span class="absolute inset-y-0 left-0 flex items-center pr-3 text-gray-500 ml-2">
                                    N-
                                </span>
                            </div>
                            @error('isbn')
                            <x-input-error :messages="$errors->get('isbn')"/>
                             @enderror
                          </div>
                          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <x-input-label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
                              Genre
                            </x-input-label>
                            <div class="relative">
                                <select name="genre" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-genre">
                                    <option value="{{ $book->genre }}" selected >{{ $book->genre }}</option>
                                    @foreach ( $genre as $genres )
                                    <option value="{{ $genres }}">{{ $genres }}</option>
                                    @endforeach
                                </select>
                                @error('genre')
                                <x-input-error :messages="$errors->get('genre')"/>
                                 @enderror
                              </div>
                          </div>
                          <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <x-input-label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
                              Published Date
                            </x-input-label>
                            <x-text-input value="{{ $book->published_date }}"
                             name="published_date" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-date" type="date"/>
                            @error('published_date')
                                <x-input-error :messages="$errors->get('published_date')"/>
                                 @enderror
                          </div>
                        </div>
                        <div class="w-full justify-center flex gap-4">
                            <x-primary-button type="submit">
                                {{ __('Update Book') }}
                            </x-primary-button>
                            <a href="{{ url()->previous() }}">
                            <x-danger-button type="button">
                                {{ __('Cancel') }}
                            </x-danger-button>
                            </a>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>