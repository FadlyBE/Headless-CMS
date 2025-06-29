<div class="bg-gray-100 p-4 rounded mb-4">
    <form wire:submit.prevent="save">
        {{-- Nama Role --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nama Role</label>
            <input wire:model.defer="name" type="text" class="w-full border rounded px-3 py-2" placeholder="Contoh: Admin">
            @error('name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Daftar Permissions --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Permissions</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                @foreach ($permissions as $permission)
                <label class="flex items-center space-x-2">
                    <input type="checkbox" wire:model="permission_ids" value="{{ $permission->id }}" class="text-blue-600">
                    <span>{{ $permission->name }}</span>
                </label>
                @endforeach
            </div>
            @error('permission_ids') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Tombol --}}
        <div class="flex space-x-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
            <button type="button" wire:click="$dispatch('roleSaved')" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-red-600">
                Cancel
            </button>
        </div>
    </form>
</div>