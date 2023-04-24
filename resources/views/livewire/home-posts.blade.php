<div>
    <section class="dark:bg-gray-800 dark:text-gray-100">
        <div class="container max-w-6xl p-6 mx-auto space-y-6 sm:space-y-12">
            <div class="grid justify-center grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($posts as $post)
                    <a rel="noopener noreferrer" href="{{ route('post.show',$post->id) }}"
                       class="max-w-sm mx-auto group hover:no-underline focus:no-underline dark:bg-gray-900">
                        <img role="presentation" class="object-cover w-full rounded h-44 dark:bg-gray-500"
                             src="{{ asset($post->image) }}">
                        <div class="p-6 space-y-2">
                            <h3 class="text-2xl font-semibold group-hover:underline group-focus:underline">{{ $post->title }}</h3>
                            <span class="text-xs dark:text-gray-400">{{ $post->created_at->format('F d, Y') }}</span>
                            <p>{{ $post->bodyPreview() }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="flex justify-center">
                <button type="button" class="px-6 py-3 text-sm rounded-md hover:underline dark:bg-gray-900 dark:text-gray-400" wire:click.prevent="loadMore">Load more posts...</button>
            </div>
        </div>
    </section>
</div>
