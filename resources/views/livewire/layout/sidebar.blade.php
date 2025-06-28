<div class="h-full bg-white border-r shadow-sm p-4">
    <div class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Admin Panel</h2>
    </div>

    <nav class="space-y-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m4-6h3m-7 6h7"></path>
            </svg>
            Dashboard
        </a>

        <!-- Posts -->
        <a href="{{ route('admin.posts') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M19 21H5a2 2 0 01-2-2V7a2 2 0 012-2h4l2-2h2l2 2h4a2 2 0 012 2v12a2 2 0 01-2 2z">
                </path>
            </svg>
            Posts
        </a>

        <!-- Categories -->
        <a href="{{ route('admin.categories.index') }}" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M20 13V5a2 2 0 00-2-2H6a2 2 0 00-2 2v8m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6m16 0H4">
                </path>
            </svg>
            Categories
        </a>

        <a href="{{ route('admin.pages.index') }}"
            class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 4h14a2 2 0 012 2v14l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
            </svg>
            Pages
        </a>

        <!-- Users -->
        <a href="#" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
            <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M5.121 17.804A9 9 0 1112 21a9.003 9.003 0 01-6.879-3.196z"></path>
            </svg>
            Users
        </a>

        <!-- Logout -->
        <form method="POST" action="#">
            @csrf
            <button type="submit"
                class="w-full flex items-center px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-md">
                <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1">
                    </path>
                </svg>
                Logout
            </button>
        </form>
    </nav>
</div>