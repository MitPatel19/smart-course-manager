<x-app-layout>
    <div class="py-8">
        <div class="max-w-6xl mx-auto space-y-6">

            <div>
                <h2 class="text-2xl font-semibold mb-2">Admin Dashboard</h2>
                <p class="text-gray-600">Manage programs, courses, instructors, and student access.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white shadow rounded-xl p-4">
                    <h3 class="text-sm text-gray-500 uppercase">Users</h3>
                    <p class="text-3xl font-bold mt-1">{{ $usersCount }}</p>
                    <p class="text-xs text-gray-500 mt-1">Admins, instructors, and students.</p>
                </div>
                <div class="bg-white shadow rounded-xl p-4">
                    <h3 class="text-sm text-gray-500 uppercase">Courses</h3>
                    <p class="text-3xl font-bold mt-1">{{ $coursesCount }}</p>
                    <p class="text-xs text-gray-500 mt-1">Active and assigned to programs.</p>
                </div>
                <div class="bg-white shadow rounded-xl p-4">
                    <h3 class="text-sm text-gray-500 uppercase">Materials</h3>
                    <p class="text-3xl font-bold mt-1">{{ $materialsCount }}</p>
                    <p class="text-xs text-gray-500 mt-1">Uploaded by instructors.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.programs.index') }}"
                   class="bg-indigo-50 hover:bg-indigo-100 border border-indigo-100 rounded-xl p-4 flex flex-col">
                    <span class="text-sm font-semibold text-indigo-700">Programs & Courses</span>
                    <span class="text-xs text-gray-600 mt-1">
                        Create programs, add courses, and assign instructors.
                    </span>
                </a>

                <a href="{{ route('admin.user_status.index') }}"
                   class="bg-pink-50 hover:bg-pink-100 border border-pink-100 rounded-xl p-4 flex flex-col">
                    <span class="text-sm font-semibold text-pink-700">User Status</span>
                    <span class="text-xs text-gray-600 mt-1">
                        Activate or deactivate instructor and student accounts.
                    </span>
                </a>

                <a href="{{ route('courses.index') }}"
                   class="bg-emerald-50 hover:bg-emerald-100 border border-emerald-100 rounded-xl p-4 flex flex-col">
                    <span class="text-sm font-semibold text-emerald-700">All Courses</span>
                    <span class="text-xs text-gray-600 mt-1">
                        View courses list and enrolled students.
                    </span>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>