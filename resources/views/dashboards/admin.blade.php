<x-app-layout>
    <div class="py-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-xl mb-3">Admin Dashboard</h2>

            <div class="grid grid-cols-3 gap-4">
                <div class="border p-3">
                    <h3 class="font-semibold">Users</h3>
                    <p class="text-2xl">{{ $usersCount }}</p>
                </div>
                <div class="border p-3">
                    <h3 class="font-semibold">Courses</h3>
                    <p class="text-2xl">{{ $coursesCount }}</p>
                </div>
                <div class="border p-3">
                    <h3 class="font-semibold">Materials</h3>
                    <p class="text-2xl">{{ $materialsCount }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
