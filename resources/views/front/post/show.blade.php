@extends('layout.app')
@section('content')
    <div class="p-5 mx-auto sm:p-10 md:p-16 dark:bg-gray-800 dark:text-gray-100">
        <div class="flex flex-col max-w-3xl mx-auto overflow-hidden rounded">
            <img src="{{ asset($post->image) }}" alt="" class="w-full h-60 sm:h-96 dark:bg-gray-500">
            <div class="p-6 pb-12 m-4 mx-auto -mt-16 space-y-6 lg:max-w-2xl sm:px-10 sm:mx-12 lg:rounded-md dark:bg-gray-900">
                <div class="space-y-2">
                    <a rel="noopener noreferrer"  class="inline-block text-2xl font-semibold sm:text-3xl">{{ $post->title }}</a>
                    <p class="text-xs dark:text-gray-400">By
                        <span rel="noopener noreferrer" class="text-xs hover:underline">{{ $post->user->name }}</span> |
                        <span rel="noopener noreferrer" class="text-xs hover:underline">{{ $post->category->title }}</span> |
                        <time datetime="2021-02-12 15:34:18-0200">{{ $post->created_at->format('F d, Y') }}</time>
                    </p>
                </div>
                <div class="dark:text-gray-100">
                    {!! $post->body !!}
                </div>
            </div>
        </div>
    </div>
@endsection
