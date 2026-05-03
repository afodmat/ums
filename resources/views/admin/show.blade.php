<x-app-layout>
    <x-slot name="header">
        User Details
    </x-slot>

    <div class="bg-white shadow rounded-lg p-6">

        <h2 class="text-xl font-semibold mb-4">
            {{ $user->first_name }} {{ $user->last_name }}
        </h2>

        <div class="space-y-3">
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ $user->getRoleNames()->first() }}</p>
            <p><strong>User Number:</strong> {{ $user->user_number }}</p>
        </div>

        @if($user->admin)
            <div class="mt-6 border-t pt-4">
                <h3 class="font-semibold mb-2">Admin Profile</h3>

                <p><strong>Phone:</strong> {{ $user->admin->phone }}</p>

                @if($user->admin->photo)
                    <img src="{{ asset('storage/'.$user->admin->photo) }}"
                         class="w-32 mt-2 rounded">
                @endif
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('admin.index') }}"
               class="px-4 py-2 bg-gray-600 text-white rounded">
                Back
            </a>
        </div>

    </div>
</x-app-layout>