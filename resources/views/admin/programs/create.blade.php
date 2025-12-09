<x-app-layout>
    <div class="py-8">
        <div class="max-w-md mx-auto bg-white shadow rounded-xl p-6">
            <h2 class="text-xl font-semibold mb-4">Create Program</h2>

            <form action="{{ route('admin.programs.store') }}" method="POST" class="space-y-3">
                @csrf

                <div>
                    <label class="block text-sm mb-1">Code</label>
                    <input type="text" name="code" class="border rounded w-full px-2 py-1 text-sm"
                           value="{{ old('code') }}" placeholder="ICT351">
                    @error('code')<div class="text-xs text-red-600 mt-1">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm mb-1">Name</label>
                    <input type="text" name="name" class="border rounded w-full px-2 py-1 text-sm"
                           value="{{ old('name') }}" placeholder="Information Communication Technology">
                    @error('name')<div class="text-xs text-red-600 mt-1">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="block text-sm mb-1">Description</label>
                    <textarea name="description" rows="3"
                              class="border rounded w-full px-2 py-1 text-sm">{{ old('description') }}</textarea>
                </div>

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg">
                    Save
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
