@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-teal-400 shadow-lg rounded-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-600 to-primary-800 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">My Tasks</h1>
            </div>
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert-block bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-6 mt-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert-block bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-6 mt-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="px-6 py-4 border-b">
                <form action="{{ route('todos.store') }}" method="POST">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="flex-grow">
                            <input
                                type="text"
                                name="title"
                                placeholder="Add new task"
                                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                                required
                            >
                            @error('title')
                            <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                            @enderror                        </div>

                    </div>
                    <div class="mt-3">
                    <textarea
                        name="description"
                        placeholder="Description (optional)"
                        class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-primary-500"
                        rows="2"
                    ></textarea>
                    </div>
                    <div>
                        <button type="submit" class="relative inline-block px-6 py-3 font-semibold text-white rounded-full overflow-hidden group no-underline">
                            <span class="absolute inset-0 bg-gradient-to-r from-pink-300 via-purple-300 to-pink-300 bg-[length:200%_200%] transition-all duration-500 group-hover:animate-gradient-hover"></span>
                            <span class="relative z-10">Add</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Todo List -->
            <div class="divide-y">
                @foreach($todos as $todo)
                    <div class="px-6 py-4 flex items-center">
                        <div class="flex-grow">
                            <div class="flex items-center">
                                <form action="{{ route('todos.toggle', $todo['id']) }}" method="POST" class="mr-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="flex items-center justify-center w-6 h-6 rounded-full border {{ $todo['completed'] ? 'bg-green-500 border-green-500' : 'border-gray-300' }}">
                                        @if($todo['completed'])
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                                <h3 class="text-lg font-medium text-gray-900 {{ $todo['completed'] ? 'line-through text-gray-400' : '' }}">{{ $todo['title'] }}</h3>
                            </div>
                            @if(!empty($todo['description']))
                                <p class="text-sm text-gray-600">{{ $todo['description'] }}</p>
                            @endif
                            <p class="mt-1 text-xs text-gray-400">Created at: {{ \Carbon\Carbon::parse($todo['created_at'])->format('d.m.Y') }}</p>
                        </div>
                        <div>
                            <form action="{{ route('todos.destroy', $todo['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
