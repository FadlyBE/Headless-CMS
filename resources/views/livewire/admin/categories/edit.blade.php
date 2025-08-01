<x-layouts.admin>
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Edit Kategori</h1>

    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label for="name" class="block mb-1 font-semibold">Nama Kategori</label>
            <input wire:model="name" type="text" id="name" class="w-full border rounded px-3 py-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">{{ __('button.update')}}</button>

        <a href="{{ route('admin.categories.index') }}" class="ml-4 text-gray-600 underline">Cancel</a>
    </form>
</div>
</x-layouts.admin>