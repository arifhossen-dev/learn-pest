<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create product') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-hidden overflow-x-auto p-6 bg-white border-b border-gray-200">
                    <div class="min-w-full align-middle">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf
 
                            <div>
                                <label for="name">
                                    {{ __('Name') }}
                                </label>
                                <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                                @if ($errors->get('name'))
                                    <span class="mt-2">
                                        {{ $errors->get('name') }}
                                    </span>
                                @endif
                            </div>
 
                            <div class="mt-4">
                                <label for="price">
                                    {{ __('price') }}
                                </label>
                                <input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required autofocus />
                                @if ($errors->get('price'))
                                    <span class="mt-2">
                                        {{ $errors->get('price') }}
                                    </span>
                                @endif
                            </div>
 
                            <div class="flex items-center mt-4">
                                <button>
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>