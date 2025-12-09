<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto space-y-6">
            <div>
                <h2 class="text-2xl font-semibold">Courses in {{ $program->name }}</h2>
                <p class="text-gray-600 text-sm">Assign instructors to courses within this program.</p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-3 py-2 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Add new course to this program --}}
            <div class="bg-white shadow rounded-xl p-4">
                <h3 class="text-sm font-semibold mb-2">Add Course</h3>

                <form action="{{ route('admin.programs.courses.store', $program) }}" method="POST" class="grid md:grid-cols-4 gap-3 text-sm">
                    @csrf

                    <div>
                        <label class="block mb-1">Code</label>
                        <input type="text" name="course_code" class="border rounded w-full px-2 py-1"
                               value="{{ old('course_code') }}">
                    </div>

                    <div>
                        <label class="block mb-1">Name</label>
                        <input type="text" name="course_name" class="border rounded w-full px-2 py-1"
                               value="{{ old('course_name') }}">
                    </div>

                    <div>
                        <label class="block mb-1">Semester</label>
                        <input type="text" name="semester" class="border rounded w-full px-2 py-1"
                               value="{{ old('semester') }}" placeholder="F25">
                    </div>

                    <div>
                        <label class="block mb-1">Instructor</label>
                        <select name="instructor_id" class="border rounded w-full px-2 py-1">
                            @foreach($instructors as $inst)
                                <option value="{{ $inst->id }}">{{ $inst->name }} ({{ $inst->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-4">
                        <label class="block mb-1">Description</label>
                        <textarea name="description" rows="2"
                                  class="border rounded w-full px-2 py-1">{{ old('description') }}</textarea>
                    </div>

                    <div class="md:col-span-4">
                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
                            Add Course
                        </button>
                    </div>
                </form>
            </div>

            {{-- Existing courses --}}
            <div class="bg-white shadow rounded-xl overflow-hidden">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left">Code</th>
                            <th class="px-3 py-2 text-left">Name</th>
                            <th class="px-3 py-2 text-left">Semester</th>
                            <th class="px-3 py-2 text-left">Instructor</th>
                            <th class="px-3 py-2 text-left">Active</th>
                            <th class="px-3 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $course)
                            <tr class="border-t">
                                <td class="px-3 py-2">{{ $course->course_code }}</td>
                                <td class="px-3 py-2">{{ $course->course_name }}</td>
                                <td class="px-3 py-2">{{ $course->semester }}</td>
                                <td class="px-3 py-2">{{ optional($course->instructor)->name }}</td>
                                <td class="px-3 py-2">
                                    @if($course->is_active)
                                        <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">Active</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    <form action="{{ route('admin.programs.courses.update', [$program, $course]) }}" method="POST" class="inline-flex items-center space-x-1">
                                        @csrf
                                        @method('PUT')

                                        <select name="instructor_id" class="border rounded px-1 py-0.5 text-xs">
                                            @foreach($instructors as $inst)
                                                <option value="{{ $inst->id }}" @if($course->instructor_id == $inst->id) selected @endif>
                                                    {{ $inst->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <select name="is_active" class="border rounded px-1 py-0.5 text-xs">
                                            <option value="1" @if($course->is_active) selected @endif>Active</option>
                                            <option value="0" @if(!$course->is_active) selected @endif>Inactive</option>
                                        </select>

                                        <input type="hidden" name="course_code" value="{{ $course->course_code }}">
                                        <input type="hidden" name="course_name" value="{{ $course->course_name }}">
                                        <input type="hidden" name="semester" value="{{ $course->semester }}">
                                        <input type="hidden" name="description" value="{{ $course->description }}">

                                        <button class="px-2 py-1 bg-blue-600 text-white text-xs rounded">
                                            Save
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
</x-app-layout>
