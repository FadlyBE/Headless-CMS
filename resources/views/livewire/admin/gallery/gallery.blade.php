<div class="p-4 space-y-4">
    <h2 class="text-lg font-semibold">📁 Media Manager</h2>
    @if (session()->has('message'))
    <div class="text-green-500">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="store" class="pb-4">

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

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">{{ __('button.save') }}</button>
    </form>

    <!-- List Images -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse ($images as $image)
            <div class="relative border rounded overflow-hidden group">
                <img src="{{ asset('storage/' . $image) }}" alt="Image" class="w-full h-32 object-cover">

                <button wire:click.prevent="delete('{{ $image }}')"
                    class="absolute top-1 right-1 bg-red-600 text-white px-2 py-1 text-xs rounded hidden group-hover:block">
                    Hapus
                </button>
            </div>
        @empty
            <p class="col-span-full text-gray-600">Tidak ada gambar ditemukan.</p>
        @endforelse
    </div>
</div>