<x-app-layout>
    <div class="py-8">
        <div class="max-w-5xl mx-auto space-y-6">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h2 class="text-2xl font-semibold">User Status</h2>
                    <p class="text-gray-600 text-sm">
                        Activate or deactivate instructor and student accounts.
                    </p>
                </div>
                <a href="{{ route('admin.user_status.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg shadow">
                    + Add New User
                </a>
            </div>


            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-3 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-800 px-3 py-2 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6">
                {{-- Instructors --}}
                <div class="bg-white shadow rounded-xl p-4">
                    <h3 class="font-semibold mb-2">Instructors</h3>

                    <table class="w-full text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-2 py-1 text-left">Name</th>
                                <th class="px-2 py-1 text-left">Email</th>
                                <th class="px-2 py-1 text-left">Status</th>
                                <th class="px-2 py-1 text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instructors as $inst)
                                <tr class="border-t">
                                    <td class="px-2 py-1">{{ $inst->name }}</td>
                                    <td class="px-2 py-1 text-xs">{{ $inst->email }}</td>
                                    <td class="px-2 py-1">
                                        @if($inst->is_active)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Active</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-2 py-1">
                                        @if(auth()->id() !== $inst->id)
                                            <form action="{{ route('admin.user_status.toggle', $inst) }}" method="POST">
                                                @csrf
                                                <button class="px-3 py-1 text-xs rounded
                                                    {{ $inst->is_active ? 'bg-red-600 text-white' : 'bg-green-600 text-white' }}">
                                                    {{ $inst->is_active ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-400">(You)</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Students --}}
                <div class="bg-white shadow rounded-xl p-4">
                    <h3 class="font-semibold mb-2">Students</h3>

                    <table class="w-full text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-2 py-1 text-left">Name</th>
                                <th class="px-2 py-1 text-left">Email</th>
                                <th class="px-2 py-1 text-left">Status</th>
                                <th class="px-2 py-1 text-left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $stu)
                                <tr class="border-t">
                                    <td class="px-2 py-1">{{ $stu->name }}</td>
                                    <td class="px-2 py-1 text-xs">{{ $stu->email }}</td>
                                    <td class="px-2 py-1">
                                        @if($stu->is_active)
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Active</span>
                                        @else
                                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-2 py-1">
                                        <form action="{{ route('admin.user_status.toggle', $stu) }}" method="POST">
                                            @csrf
                                            <button class="px-3 py-1 text-xs rounded
                                                {{ $stu->is_active ? 'bg-red-600 text-white' : 'bg-green-600 text-white' }}">
                                                {{ $stu->is_active ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
