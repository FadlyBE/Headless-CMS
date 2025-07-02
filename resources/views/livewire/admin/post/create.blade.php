<x-layouts.admin>

<div class="max-w-5xl mx-auto bg-gray-100 p-6 rounded-lg">
    <h1 class="text-2xl font-semibold mb-6">Create Post</h1>

    <form wire:submit.prevent="save" enctype="multipart/form-data">
        <div class="grid grid-cols-2 gap-6">
            {{-- Title --}}
            <div>
                <label for="title" class="block font-medium">Title</label>
                <input type="text" wire:model.defer="title" id="title" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block font-medium">Image</label>
                <input type="file" wire:model="image" id="image" class="w-full">
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block font-medium">Slug</label>
                <input type="text" wire:model.defer="slug" id="slug" class="w-full border rounded px-3 py-2">
            </div>

            {{-- Status --}}
            <div>
                <label for="status" class="block font-medium">Status</label>
                <select wire:model.defer="status" id="status" class="w-full border rounded px-3 py-2">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            {{-- Content --}}
            <div class="col-span-2">
                <label for="content" class="block font-medium">Content</label>
                <textarea wire:model.defer="content" id="content" rows="6" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            {{-- Excerpt --}}
            <div class="col-span-2">
                <label for="excerpt" class="block font-medium">Excerpt</label>
                <textarea wire:model.defer="excerpt" id="excerpt" rows="4" class="w-full border rounded px-3 py-2"></textarea>
            </div>

            {{-- Categories --}}
            <div class="col-span-2">
                <label class="block font-medium mb-2">Categories</label>
                <div class="flex flex-wrap gap-4">
                    @foreach($categories as $category)
                        <label class="inline-flex items-center">
                            <input type="checkbox" wire:model="selectedCategories" value="{{ $category->id }}" class="mr-2">
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Submit --}}
            <div class="col-span-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    Save Post
                </button>
            </div>
        </div>
    </form>
</div>
</x-layouts.admin>
