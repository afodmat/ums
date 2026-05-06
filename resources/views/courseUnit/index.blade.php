<x-app-layout>
    <x-slot name="header">
        Manage Course Units
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-semibold">All Course Units</h2>
            <a href="{{ route('courseUnit.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
                + Create Course Unit
            </a>
        </div>

        <table class="w-full border border-gray-200 rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Course Code</th>
                    <th class="p-3 text-left">Course Unit Name</th>
                    <th class="p-3 text-left">Program</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courseUnits as $courseUnit)
                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>
                        <td class="p-3">
                            <span class="font-mono text-sm bg-gray-100 px-2 py-1 rounded">{{ $courseUnit->code }}</span>
                        </td>
                        <td class="p-3">{{ $courseUnit->name }}</td>
                        <td class="p-3">{{ $courseUnit->program->program_name ?? 'No Program Assigned' }}</td>
                        <td class="p-3">{{ Str::limit($courseUnit->description, 50) }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('courseUnit.show', $courseUnit->id) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded text-sm">
                                View
                            </a>
                            <a href="{{ route('courseUnit.edit', $courseUnit->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded text-sm">
                                Edit
                            </a>
                            <form action="{{ route('courseUnit.destroy', $courseUnit->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded text-sm" 
                                        onclick="return confirm('Are you sure?')">
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