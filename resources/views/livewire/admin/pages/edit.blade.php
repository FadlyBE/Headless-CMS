<x-layouts.admin>
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Page</h1>

    <form wire:submit.prevent="update" class="space-y-4">
        <div>
            <label class="block font-semibold">Title</label>
            <input wire:model="title" type="text" class="w-full border p-2 rounded" />
            @error('title') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Slug</label>
            <input wire:model="slug" type="text" class="w-full border p-2 rounded" />
            @error('slug') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Body</label>
            <textarea wire:model="body" rows="6" class="w-full border p-2 rounded"></textarea>
            @error('body') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block font-semibold">Status</label>
            <select wire:model="status" class="w-full border p-2 rounded">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Update
        </button>
    </form>
</div>
</x-layouts.admin>