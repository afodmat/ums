<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Semester Filter -->
                    <div class="mb-6">
                        <label class="text-gray-700">Filter by Semester:</label>
                        <select id="semester_filter" class="ml-2 rounded-md border-gray-300">
                            <option value="all">All Semesters</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                            <option value="3">Semester 3</option>
                            <option value="4">Semester 4</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($courses as $course)
                            <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                                <div class="bg-indigo-600 p-4">
                                    <h3 class="text-white font-bold text-lg">{{ $course->name }}</h3>
                                    <p class="text-indigo-200 text-sm">{{ $course->code }}</p>
                                </div>
                                <div class="p-4">
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600">
                                            <strong>Lecturer:</strong> {{ $course->lecturer->user->first_name ?? 'TBA' }} {{ $course