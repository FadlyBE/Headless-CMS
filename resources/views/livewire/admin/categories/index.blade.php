
<x-layouts.admin>
    <div class="max-w-3xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Kategori</h1>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="mb-6">
        <div class="flex items-center gap-2">
            <input type="text" wire:model.defer="name" placeholder="Nama kategori" class="border rounded p-2 w-full">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                {{ $isEditing ? 'Update' : 'Tambah' }}
            </button>
        </div>
        @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
    </form>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2 text-left">Nama</th>
                <th class="border px-4 py-2 text-left">Slug</th>
                <th class="border px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td class="border px-4 py-2">{{ $category->name }}</td>
                    <td class="border px-4 py-2">{{ $category->slug }}</td>
                    <td class="border px-4 py-2 space-x-2">
                        <button wire:click="edit({{ $category->id }})" class="text-blue-600 hover:underline">Edit</button>
                        <button wire:click="delete({{ $category->id }})" onclick="confirm('Yakin hapus?')" class="text-red-600 hover:underline">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>
</div>
</x-layouts.admin>