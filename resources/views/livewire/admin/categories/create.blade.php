<x-layouts.admin>
<div class="p-4">
    <h1 class="text-xl font-bold mb-4">Tambah Kategori</h1>

    <form wire:submit.prevent="store">
        <div class="mb-4">
            <label for="name" class="block mb-1 font-semibold">Nama Kategori</label>
            <input wire:model="name" type="text" id="name" class="w-full border rounded px-3 py-2">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('admin.categories.index') }}" class="ml-4 text-gray-600 underline">Kembali</a>
    </form>
</div>
</x-layouts.admin>
