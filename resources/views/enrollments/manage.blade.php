<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-xl mb-3">Manage Enrollments for {{ $course->course_code }}</h2>

            <form action="{{ route('enrollments.update', $course) }}" method="POST">
                @csrf

                <table class="table-auto w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-2 py-1">Enroll</th>
                            <th class="border px-2 py-1">Name</th>
                            <th class="border px-2 py-1">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $s)
                            <tr>
                                <td class="border px-2 py-1 text-center">
                                    <input type="checkbox" name="students[]" value="{{ $s->id }}"
                                        @if(in_array($s->id, $enrolledIds)) checked @endif>
                                </td>
                                <td class="border px-2 py-1">{{ $s->name }}</td>
                                <td class="border px-2 py-1">{{ $s->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <button type="submit" class="mt-3 px-4 py-1 bg-blue-600 text-white rounded">
                    Save Enrollments
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
