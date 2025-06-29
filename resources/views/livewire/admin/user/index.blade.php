<div class="p-4" x-data="{ modalOpen: @entangle('showModal') }">

    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">

        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">User List</h2>
            <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
                Create User
            </button>
        </div>


        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-2">Name</th>
                    <th class="text-left px-4 py-2">Email</th>
                    <th class="text-left px-4 py-2">Roles</th>
                    <th class="text-left px-4 py-2">Permissions</th>
                    <th class="text-left px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">
                        @foreach ($user->roles as $role)
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold mr-1 px-2.5 py-0.5 rounded">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-2">
                        @foreach ($user->permissions as $permission)
                        <span class="bg-green-100 text-green-800 text-xs font-semibold mr-1 px-2.5 py-0.5 rounded">{{ $permission->name }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-2">
                        <button wire:click="edit({{ $user->id }})" class="text-blue-500 hover:underline">Edit</button>
                        <button wire:click="deleteUser({{ $user->id }})" class="text-red-500 hover:underline ml-2">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div x-show="modalOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow w-[320px]" @click.away="modalOpen = false; $wire.closeModal()">

            <h2 class="text-xl font-bold mb-4">
                {{ $selectedUserId ? 'Edit User' : 'Create User' }}
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Name</label>
                <input wire:model.defer="name" type="text" class="w-full border rounded px-3 py-2">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input wire:model.defer="email" type="email" class="w-full border rounded px-3 py-2">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Role</label>
                <select wire:model.defer="role" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Role --</option>
                    @foreach ($allRoles as $id => $roleName)
                    <option value="{{ $roleName }}">{{ $roleName }}</option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Permissions</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($allPermissions as $permission)
                    <label class="inline-flex items-center text-sm">
                        <input type="checkbox" wire:model.defer="permissions" value="{{ $permission }}" class="mr-2">
                        {{ $permission }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button @click="modalOpen = false; $wire.closeModal()"
                    type="button"
                    class="px-4 py-2 bg-red-600 text-white rounded">Cancel</button>

                <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded">
                    {{ $selectedUserId ? 'Update' : 'Save' }}
                </button>

            </div>
        </div>
    </div>
</div>