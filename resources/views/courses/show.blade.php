<x-app-layout>
    <div class="py-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-xl mb-2">
                {{ $course->course_code }} - {{ $course->course_name }}
            </h2>
            <p>Semester: {{ $course->semester }}</p>
            <p>Instructor: {{ $course->instructor->name }}</p>
            <p class="mt-2">{{ $course->description }}</p>

            <div class="mt-4">
                <h3 class="text-lg mb-2">Materials</h3>

                @if(session('success'))
                    <div class="bg-green-100 border p-2 mb-2">{{ session('success') }}</div>
                @endif

                @if((auth()->user()->role === 'instructor' && auth()->id() === $course->instructor_id) || auth()->user()->role === 'admin')
                    <a href="{{ route('materials.create', $course) }}" class="underline">Upload New Material</a>
                    |
                    <a href="{{ route('enrollments.manage', $course) }}" class="underline">Manage Enrollments</a>
                @endif

                <table class="table-auto w-full mt-3 border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-2 py-1">Title</th>
                            <th class="border px-2 py-1">Category</th>
                            <th class="border px-2 py-1">Uploaded By</th>
                            <th class="border px-2 py-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($course->materials as $m)
                            <tr>
                                <td class="border px-2 py-1">{{ $m->title }}</td>
                                <td class="border px-2 py-1">{{ $m->category }}</td>
                                <td class="border px-2 py-1">{{ $m->uploader->name }}</td>
                                <td class="border px-2 py-1">
                                    <a href="{{ route('materials.download', $m) }}" class="underline">Download</a>
                                    @if((auth()->user()->role === 'instructor' && auth()->id() === $course->instructor_id) || auth()->user()->role === 'admin')
                                        <form action="{{ route('materials.destroy', $m) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="underline text-red-600"
                                                onclick="return confirm('Delete this material?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-app-layout>
