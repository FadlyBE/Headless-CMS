<x-layouts.admin>
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Create Post</h1>

    <form wire:submit.prevent="save" class="space-y-4">

        <div>
            <label>Title</label>
            <input wire:model="title" type="text" class="w-full border rounded p-2">
            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Slug</label>
            <input wire:model="slug" type="text" class="w-full border rounded p-2" readonly>
        </div>

        <div>
            <label>Content</label>
            <textarea wire:model="content" rows="6" class="w-full border rounded p-2"></textarea>
            @error('content') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Excerpt</label>
            <textarea wire:model="excerpt" class="w-full border rounded p-2"></textarea>
        </div>

        <div>
            <label>Image</label>
            <input type="file" wire:model="image">
            @error('image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label>Status</label>
            <select wire:model="status" class="w-full border rounded p-2">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>

        <div>
            <label>Categories</label>
            <div class="grid grid-cols-2 gap-2">
                @foreach ($categories as $cat)
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" wire:model="selectedCategories" value="{{ $cat->id }}">
                        <span>{{ $cat->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            Save Post
        </button>
    </form>
</div>
</x-layouts.admin>
