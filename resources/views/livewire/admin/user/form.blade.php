<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg w-full max-w-lg">
        <h2 class="text-xl font-bold mb-4">{{ $userId ? 'Edit' : 'Create' }} User</h2>

        <div class="mb-4">
            <label class="block text-sm">Name</label>
            <input type="text" wire:model="name" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm">Email</label>
            <input type="email" wire:model="email" class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm">Role</label>
            <select wire:model="role" class="w-full border rounded p-2">
                <option value="">-- Select Role --</option>
                @foreach ($allRoles as $roleName)
                    <option value="{{ $roleName }}">{{ $roleName }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm">Permissions</label>
            @foreach ($allPermissions as $perm)
                <label class="block text-sm">
                    <input type="checkbox" wire:model="permissions" value="{{ $perm }}">
                    {{ $perm }}
                </label>
            @endforeach
        </div>

        <div class="flex justify-end space-x-2">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
            <button wire:click="$dispatch('closeModal')" class="bg-gray-300 px-4 py-2 rounded">Cancel</button>
        </div>
    </div>
</div>
