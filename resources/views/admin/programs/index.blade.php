<x-app-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-semibold">Programs</h2>
                    <p class="text-gray-600 text-sm">Create and manage academic programs.</p>
                </div>
                <a href="{{ route('admin.programs.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg shadow">
                    + New Program
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-3 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded-xl overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left">Code</th>
                            <th class="px-3 py-2 text-left">Name</th>
                            <th class="px-3 py-2 text-left">Courses</th>
                            <th class="px-3 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programs as $program)
                            <tr class="border-t">
                                <td class="px-3 py-2 font-mono text-xs">{{ $program->code }}</td>
                                <td class="px-3 py-2">{{ $program->name }}</td>
                                <td class="px-3 py-2">{{ $program->courses_count }}</td>
                                <td class="px-3 py-2 space-x-2">
                                    <a href="{{ route('admin.programs.courses', $program) }}"
                                       class="text-indigo-600 text-xs underline">
                                        Courses
                                    </a>
                                    <a href="{{ route('admin.programs.edit', $program) }}"
                                       class="text-blue-600 text-xs underline">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 text-xs underline"
                                                onclick="return confirm('Delete this program?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-gray-500">
                                    No programs yet. Create one above.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
