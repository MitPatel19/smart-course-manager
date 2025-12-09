<x-app-layout>
    <div class="py-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-xl mb-3">Courses</h2>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 p-2 mb-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(in_array($user->role, ['admin', 'instructor']))
                <a href="{{ route('courses.create') }}" class="underline">Create Course</a>
            @endif

            <table class="table-auto w-full mt-3 border">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border px-2 py-1">Code</th>
                        <th class="border px-2 py-1">Name</th>
                        <th class="border px-2 py-1">Semester</th>
                        <th class="border px-2 py-1">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td class="border px-2 py-1">{{ $course->course_code }}</td>
                            <td class="border px-2 py-1">{{ $course->course_name }}</td>
                            <td class="border px-2 py-1">{{ $course->semester }}</td>
                            <td class="border px-2 py-1">
                                <a href="{{ route('courses.show', $course) }}" class="underline">View</a>
                                @if(in_array($user->role, ['admin', 'instructor']))
                                    | <a href="{{ route('courses.edit', $course) }}" class="underline">Edit</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</x-app-layout>
