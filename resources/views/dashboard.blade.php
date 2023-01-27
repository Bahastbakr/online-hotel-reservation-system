<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="flex justify-around">

        @role('Admin')
            <a href="#"
                class="flex justify-between gap-x-10  max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Users</h5>
                <p class="font-normal text-gray-700 text-2xl dark:text-gray-400">{{ count($users) }}</p>
            </a>
        @endrole
        <a href="{{ route('booking.index') }}"
            class="flex justify-between gap-x-10  max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Bookings</h5>
            <p class="font-normal text-gray-700 text-2xl dark:text-gray-400">{{ count($bookings) }}</p>
        </a>
        @role('Admin')
            <a href="{{ route('room.index') }}"
                class="flex justify-between gap-x-10  max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Rooms</h5>
                <p class="font-normal text-gray-700 text-2xl dark:text-gray-400">{{ count($rooms) }}</p>
            </a>
        @endrole

    </div>

</x-app-layout>
