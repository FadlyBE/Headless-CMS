<div>
    @if (session()->has('message'))
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('message') }}
    </div>
    @endif
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">{{ __('sidebar.posts') }}</h2>
            @can('create_post')
            <button wire:click="create"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                {{ __('button.create') }}
            </button>
            @endcan
        </div>

        <table class="min-w-full border border-gray-300 mt-6">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4 border-b"> {{ __('thead.image') }}</th>
                    <th class="py-2 px-4 border-b">{{ __('thead.title') }}</th>
                    <th class="px-6 py-3 text-left">{{ __('thead.category') }}</th>
                    <th class="py-2 px-4 border-b">{{ __('thead.status') }}</th>
                    <th class="py-2 px-4 border-b">{{ __('thead.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td class="py-2 px-4 border-b">
                        @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Gambar" class="w-16 h-16 object-cover rounded">
                        @else
                        <span class="text-gray-400 italic">No Image</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">{{ $post->title }}</td>
                    <td class="px-6 py-4">
                        @foreach($post->categories as $category)
                        <span class="inline-block bg-blue-100 text-blue-700 text-xs px-2 py-1 rounded mr-1 mb-1">
                            {{ $category->name }}
                        </span>
                        @endforeach
                    </td>
                    <td class="py-2 px-4 border-b">{{ ucfirst($post->status) }}</td>
                    <td class="py-2 px-4 border-b space-x-2">
                    @can('edit_post')
                        <button wire:click="edit({{ $post->id }})" class="inline-flex items-center text-blue-600 hover:underline mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2M4 17l4.586-4.586a2 2 0 012.828 0L16 17M14 13l6-6m0 0a2.121 2.121 0 00-3-3L11 10" />
                            </svg>
                            {{ __('button.edit') }}
                        </button>
                        @endcan
                        @can('delete_post')
                        <button wire:click.prevent="delete({{ $post->id }})"
                            onclick="return confirm('Are you sure you want to delete?')"
                            class="inline-flex items-center text-red-600 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            {{ __('button.delete') }}
                        </button>
                        @endcan
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>

  
    <div x-data="{ showModal: @entangle('isOpen') }"
        x-show="showModal"
        wire:key="modal-post"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded w-full max-w-xl max-h-[90vh] overflow-y-auto"
            @click.away="showModal = false">
            <h2 class="text-xl font-bold mb-4">{{ $postId ? 'Edit' : 'Create' }} Post</h2>

            <form wire:submit.prevent="store" class="pb-4">
                <input type="text" wire:model.defer="title" placeholder="Title"
                    class="w-full p-2 border rounded mb-2">

                <textarea wire:model.defer="content" placeholder="Content"
                    class="w-full p-2 border rounded mb-2" rows="5"></textarea>

                <textarea wire:model.defer="excerpt" placeholder="Excerpt"
                    class="w-full p-2 border rounded mb-2"></textarea>

                <select wire:model.defer="status" class="w-full p-2 border rounded mb-2">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>

                
                <input type="file" wire:model="image_upload" class="w-full p-2 border rounded mb-2">
                @error('image_upload')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

              
                @if ($image_upload)
                <div class="mb-2">
                    <img src="{{ $image_upload->temporaryUrl() }}"
                        class="rounded object-cover"
                        style="width: 96px; height: 96px;">
                </div>
                @endif

             
                @if ($postId && $image_upload === null && $image = $posts->firstWhere('id', $postId)?->image)
                <div class="w-24 h-24 overflow-hidden rounded mb-2">
                    <img src="{{ asset('storage/' . $image) }}"
                        class="object-cover max-w-full max-h-full w-full h-full rounded">
                </div>
                @endif

                <div class="mb-4" x-data="{ open: false, selected: @entangle('selectedCategories') }">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Category</label>

                    <div @click="open = !open"
                        class="border border-gray-300 rounded px-4 py-2 bg-white cursor-pointer">
                        
                        <template x-if="selected.length > 0">
                            <span>
                                <template x-for="id in selected" :key="id">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold mr-1 px-2.5 py-0.5 rounded">

                                        <span x-text="$store.categories[id]"></span>
                                    </span>
                                </template>
                            </span>
                        </template>
                        <template x-if="selected.length === 0">
                            <span class="text-gray-400">Select Category</span>
                        </template>
                    </div>

                    
                    <div x-show="open" class="mt-2 border border-gray-200 rounded p-2 bg-white max-h-48 overflow-y-auto">
                        @foreach ($categories as $category)
                        <label class="block">
                            <input type="checkbox"
                                wire:model="selectedCategories"
                                value="{{ $category->id }}"
                                class="mr-2">
                            {{ $category->name }}
                        </label>
                        @endforeach
                    </div>

                    
                    <script>
                        document.addEventListener('alpine:init', () => {
                            Alpine.store('categories', {
                                @foreach ($categories as $category)
                                    {{ $category->id }}: @json($category->name){{ !$loop->last ? ',' : '' }}
                                @endforeach
                            });
                        });
                    </script>


                </div>


                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" @click="showModal = false"
                        class="px-4 py-2 bg-gray-300 rounded">{{ __('button.cancel') }}</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded">{{ __('button.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>