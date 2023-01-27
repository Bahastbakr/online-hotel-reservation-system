<x-guest-layout>


    <div class="items-center mt-10 min-h-screen flex justify-center">

        <form action="{{ route('booking.store') }}" method="post"
            class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">

            @csrf

            <input type="hidden" name="from_time" value="{{ $request->checkin }}">
            <input type="hidden" name="to_time" value="{{ $request->checkout }}">
            <input type="hidden" name="total" value="{{ $room->price }}">
            <input type="hidden" name="room_id" value="{{ $room->id }}">

            <h5 class="mb-4 text-xl font-medium text-gray-500 dark:text-gray-400">{{ $room->name }}</h5>
            <div class="flex items-baseline text-gray-900 dark:text-white">
                <span class="text-3xl font-semibold">$</span>
                <span class="text-5xl font-extrabold tracking-tight">{{ $room->price }}</span>
                <span class="ml-1 text-xl font-normal text-gray-500 dark:text-gray-400">/per Night</span>
            </div>
            <!-- List -->
            <ul role="list" class="space-y-5 my-7">
                <h5 class="text-2xl font-bold">Features</h5>
                <hr>
                @foreach ($room->features as $feature)
                    <li class="flex space-x-3">
                        <!-- Icon -->
                        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Check icon</title>
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span
                            class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $feature }}</span>
                    </li>
                @endforeach

            </ul>

            <ul role="list" class="space-y-5 my-7">
                <h5 class="text-2xl font-bold">Facilities</h5>
                <hr>
                @foreach ($room->facilities as $facility)
                    <li class="flex space-x-3">
                        <!-- Icon -->
                        <svg aria-hidden="true" class="flex-shrink-0 w-5 h-5 text-blue-600 dark:text-blue-500"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Check icon</title>
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span
                            class="text-base font-normal leading-tight text-gray-500 dark:text-gray-400">{{ $facility }}</span>
                    </li>
                @endforeach

            </ul>
            <hr>

            <div class="space-y-2 my-7">
                <h5 class="text-2xl font-bold">Date</h5>
                <h4><strong>Check In :</strong> {{ $request->checkin }}</h4>
                <h4><strong>Check Out :</strong> {{ $request->checkout }}</h4>



            </div>

            <hr class="mb-10">
            <button type="submit"
                class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-200 dark:focus:ring-blue-900 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex justify-center w-full text-center">Book</button>
        </form>

        @if ($errors->any())
            @foreach ($errors as $error)
                {{ $error->message }}
            @endforeach
        @endif

    </div>

</x-guest-layout>
