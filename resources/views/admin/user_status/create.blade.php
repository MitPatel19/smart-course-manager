<x-app-layout>
    <div class="py-8">
        <div class="max-w-md mx-auto bg-white shadow rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Create User</h2>
            <p class="text-gray-600 text-sm mb-4">
                Use this form to create a new instructor or student account.
            </p>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 text-sm px-3 py-2 rounded mb-3">
                    <ul class="list-disc ml-4">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.user_status.store') }}" method="POST" class="space-y-3">
                @csrf

                <div>
                    <label class="block text-sm mb-1">Name</label>
                    <input type="text" name="name" class="border rounded w-full px-2 py-1 text-sm"
                           value="{{ old('name') }}" required>
                </div>

                <div>
                    <label class="block text-sm mb-1">Email</label>
                    <input type="email" name="email" class="border rounded w-full px-2 py-1 text-sm"
                           value="{{ old('email') }}" required>
                </div>

                <div>
                    <label class="block text-sm mb-1">Password</label>
                    <input type="password" name="password" class="border rounded w-full px-2 py-1 text-sm"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Minimum 6 characters.</p>
                </div>

                <div>
                    <label class="block text-sm mb-1">Role</label>
                    <select name="role" class="border rounded w-full px-2 py-1 text-sm">
                        <option value="instructor" @if(old('role') === 'instructor') selected @endif>Instructor</option>
                        <option value="student" @if(old('role') === 'student') selected @endif>Student</option>
                    </select>
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg">
                        Create User
                    </button>
                    <a href="{{ route('admin.user_status.index') }}"
                       class="ml-2 text-sm text-gray-600 underline">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
