<x-app-layout>
    <div class="py-4">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-xl mb-3">Upload Material for {{ $course->course_code }}</h2>

            <form action="{{ route('materials.store', $course) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="block mb-1">Title</label>
                    <input type="text" name="title" class="border w-full p-1" value="{{ old('title') }}">
                    @error('title')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="block mb-1">Category</label>
                    <select name="category" class="border w-full p-1">
                        <option value="Lecture">Lecture</option>
                        <option value="Assignment">Assignment</option>
                        <option value="Lab">Lab</option>
                        <option value="Exam">Exam</option>
                    </select>
                    @error('category')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="block mb-1">File</label>
                    <input type="file" name="file" class="border w-full p-1">
                    @error('file')<div class="text-red-500 text-sm">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="px-4 py-1 bg-blue-600 text-white rounded">
                    Upload
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
