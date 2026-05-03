<x-app-layout>
    <x-slot name="header">
        Manage Users
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">

        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-semibold">All Users</h2>

            <a href="{{ route('admin.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
                + Create User
            </a>
        </div>

        <table class="w-full border border-gray-200 rounded">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">#</th>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">Role</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="p-3">{{ $loop->iteration }}</td>

                        <td class="p-3">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </td>

                        <td class="p-3">{{ $user->email }}</td>

                        <td class="p-3">
                            {{ $user->getRoleNames()->first() }}
                        </td>

                        <td class="p-3 flex gap-2">
                            <a href="{{ route('admin.show', $user->id) }}"
                               class="px-3 py-1 bg-blue-500 text-white rounded">
                                View
                            </a>

                            <a href="{{ route('admin.edit', $user->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded">
                                Edit
                            </a>

                            <form action="{{ route('admin.delete', $user->id) }}" method="POST">
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