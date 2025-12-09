<x-app-layout>
    <div class="py-4">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-xl mb-3">Instructor Dashboard</h2>

            <h3 class="text-lg mb-2">My Courses</h3>
            <ul class="list-disc ml-6 mb-4">
                @foreach($courses as $course)
                    <li>
                        <a href="{{ route('courses.show', $course) }}">
                            {{ $course->course_code }} - {{ $course->course_name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>
