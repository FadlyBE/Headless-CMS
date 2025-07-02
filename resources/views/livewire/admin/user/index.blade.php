<div class="p-4" x-data="{ modalOpen: @entangle('showModal') }">

    @if (session()->has('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        @can('create_user')
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-2xl font-semibold text-gray-800">{{ __('sidebar.users')}}</h2>
            <button wire:click="create" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">
            {{ __('button.create')}}
            </button>
        </div>
        @endcan


        <table class="min-w-full bg-white border border-gray-200 rounded shadow">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-2">{{ __('thead.name')}}</th>
                    <th class="text-left px-4 py-2">Email</th>
                    <th class="text-left px-4 py-2">{{ __('sidebar.role')}}</th>
                    <th class="text-left px-4 py-2">{{ __('sidebar.permission')}}</th>
                    <th class="text-left px-4 py-2">{{ __('thead.action')}}</th>
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
                        @can('edit_user')
                        <button wire:click="edit({{ $user->id }})" class="inline-flex items-center text-blue-600 hover:underline mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5h2M4 17l4.586-4.586a2 2 0 012.828 0L16 17M14 13l6-6m0 0a2.121 2.121 0 00-3-3L11 10" />
                            </svg>
                            {{ __('button.edit')}}
                        </button>
                        @endcan
                        @can('delete_user')
                        <button wire:click.prevent="delete({{ $user->id }})"
                            onclick="return confirm('Are you sure you want to delete?')"
                            class="inline-flex items-center text-red-600 hover:underline">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            {{ __('button.delete')}}
                        </button>
                        @endcan

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
        <div class="bg-white p-6 rounded w-full max-w-xl shadow-xl" @click.away="modalOpen = false; $wire.closeModal()">

            <h2 class="text-xl font-bold mb-4">
                {{ $selectedUserId ? __('button.update') : __('button.save') }}
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">{{__('thead.name')}}</label>
                <input wire:model.defer="name" type="text" class="w-full border rounded px-3 py-2">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input wire:model.defer="email" type="email" class="w-full border rounded px-3 py-2">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">{{__('sidebar.role')}}</label>
                <select wire:model.defer="role" class="w-full border rounded px-3 py-2">
                    <option value="">-- Select Role --</option>
                    @foreach ($allRoles as $id => $roleName)
                    <option value="{{ $roleName }}">{{ $roleName }}</option>
                    @endforeach
                </select>
                @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">{{__('sidebar.permission')}}</label>
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
                    class="px-4 py-2 bg-red-600 text-white rounded">{{__('button.cancel')}}</button>

                <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded">
                    {{ $selectedUserId ? __('button.update') : __('button.save') }}
                </button>

            </div>
        </div>
    </div>
</div>