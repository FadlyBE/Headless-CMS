<x-layouts.admin>
<div class="max-w-3xl mx-auto py-10">
    <h1 class="text-2xl font-bold mb-6">Edit Post</h1>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="update" enctype="multipart/form-data" class="space-y-6">
        <div>
            <label class="block mb-1 font-medium">Title</label>
            <input type="text" wire:model="title" class="w-full border border-gray-300 rounded p-2">
            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Slug</label>
            <input type="text" wire:model="slug" class="w-full border border-gray-300 rounded p-2" readonly>
            @error('slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Excerpt</label>
            <textarea wire:model="excerpt" class="w-full border border-gray-300 rounded p-2" rows="2"></textarea>
        </div>

        <div>
            <label class="block mb-1 font-medium">Content</label>
            <textarea wire:model="content" class="w-full border border-gray-300 rounded p-2" rows="6"></textarea>
            @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Categories</label>
            <div class="flex flex-wrap gap-4">
                @foreach ($categories as $category)
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" class="mr-2">
                        {{ $category->name }}
                    </label>
                @endforeach
            </div>
        </div>

        <div>
            <label class="block mb-1 font-medium">Status</label>
            <select wire:model="status" class="w-full border border-gray-300 rounded p-2">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-medium">Current Image</label>
            @if ($image)
                <img src="{{ asset('storage/' . $image) }}" class="w-32 h-32 object-cover rounded mb-2">
            @endif
        </div>

        <div>
            <label class="block mb-1 font-medium">Replace Image</label>
            <input type="file" wire:model="newImage">
            @error('newImage') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Post
            </button>
        </div>
    </form>
</div>
</x-layouts.admin>