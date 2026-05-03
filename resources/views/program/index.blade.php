<x-app-layout>
    <x-slot name="header">
        Manage programs
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-semibold">All Programs</h2>

            <a href="{{ route('program.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
                + Create Program
            </a>
        </div>

        <table class="w-full border border-gray-200 rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Program Name</th>
                    <th class="p-3 text-left">duration in years</th>
                    <th class="p-3 text-left">duration in semesters</th>
                    <th class="p-3 text-left">fees</th>
                    <th class="p-3 text-left">degree type</th>
                    <th class="p-3 text-left">status</th>
                    <th class="p-3 text-left">entry requirements</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($programs as $user)
                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>

                        <td class="p-3">
                            {{ $user->program_name }} 
                        </td>

                        <td class="p-3">{{ $program->duration_years }}</td>

                        <td class="p-3">{{ $program->duration_semesters }}</td>

                        <td class="p-3">{{ $program->fees }}</td>

                        <td class="p-3">{{ $program->degree_type }}</td>

                        <td class="p-3">{{ $program->status }}</td>

                        <td class="p-3">{{ $program->entry_requirements }}</td>

                        <!-- <td class="p-3">
                            {{ $user->getRoleNames()->first() }}
                        </td> -->

                        <td class="p-3 flex gap-2">
                            <a href="{{ route('program.show', $user->id) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded">
                                View
                            </a>

                            <a href="{{ route('program.edit', $user->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded">
                                Edit
                            </a>

                            <form action="{{ route('program.delete', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="px-3 py-1 bg-red-500 text-white rounded">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</x-app-layout>