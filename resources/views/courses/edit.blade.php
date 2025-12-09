<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-xl mb-3">Edit Course</h2>

            <form action="{{ route('courses.update', $course) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="block mb-1">Course Code</label>
                    <input type="text" name="course_code" class="border w-full p-1" value="{{ old('course_code', $course->course_code) }}">
                    @error('course_code')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="block mb-1">Course Name</label>
                    <input type="text" name="course_name" class="border w-full p-1" value="{{ old('course_name', $course->course_name) }}">
                    @error('course_name')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="block mb-1">Semester</label>
                    <input type="text" name="semester" class="border w-full p-1" value="{{ old('semester', $course->semester) }}">
                    @error('semester')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="block mb-1">Instructor</label>
                    <select name="instructor_id" class="border w-full p-1">
                        @foreach($instructors as $inst)
                            <option value="{{ $inst->id }}" @if($course->instructor_id == $inst->id) selected @endif>
                                {{ $inst->name }} ({{ $inst->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('instructor_id')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="block mb-1">Description</label>
                    <textarea name="description" class="border w-full p-1" rows="3">{{ old('description', $course->description) }}</textarea>
                </div>

                <button type="submit" class="px-4 py-1 bg-blue-600 text-white rounded">
                    Update
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
