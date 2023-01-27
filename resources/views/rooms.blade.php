<x-guest-layout>


    <section class="mt-36 mx-auto container">

        @if (session('message'))
            <div class="flex p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                role="alert">
                <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Success!</span> {{ session('message') }}
                </div>
            </div>
        @endif

        <h1 class="text-center mb-20 text-5xl font-medium"> Rooms</h1>

        <div class="p-4 mb-4 text-sm text-yellow-700 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
            role="alert">
            <span class="font-medium">Warning alert!</span> You can't book any rooms until you fill the form!
        </div>
        <div class="grid grid-cols-3">


            <div
                class="p-6 bg-white border max-w-sm  h-fit   border-gray-200  rounded-lg shadow-xl dark:bg-gray-800 dark:border-gray-700">
                <div href="#">
                    <h5 class="mb-10 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Check Room
                        availability
                    </h5>
                </div>

                <form class="grid" method="GET" action="{{ route('room.guest.index') }}">

                    <div class="mb-6">
                        <label for="checkin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Check-In</label>

                        <input
                            @if ($request->checkin) value="{{ Carbon\Carbon::parse($request->checkin)->format('Y-m-d') }}" @endif
                            name="checkin" min="{{ now()->addDays(1)->format('Y-m-d') }}" type="date" id="checkin"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-6">
                        <label for="checkout" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Check-Out</label>
                        <input
                            @if ($request->checkout) value="{{ Carbon\Carbon::parse($request->checkout)->format('Y-m-d') }}" @endif
                            value="" name="checkout" min="{{ now()->addDays(1)->format('Y-m-d') }}" type="date"
                            id="checkout"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <div class="mb-6">


                        <label for="adults"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adults</label>
                        <select required name="adults" id="adults"
                            class="bg-gray-50 border wi- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Choose adults number</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option @if ($request->filled('checkin') && $request->adults == $i) selected @endif value="{{ $i }}">
                                    {{ $i }}</option>
                            @endfor
                        </select>

                    </div>
                    <div class="mb-6">


                        <label for="children"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Children</label>
                        <select required name="children" id="children"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" selected>Choose child number</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option @if ($request->filled('children') && $request->children == $i) selected @endif value="{{ $i }}">
                                    {{ $i }}</option>
                            @endfor
                        </select>

                    </div>

                    <div class="flex">

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                    </div>


                </form>
            </div>

            <div class="col-span-2">


                <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-1">
                    @forelse ($rooms as $room)
                        <form method="GET" action="{{ route('booking.view.payment', $room->id) }}"
                            class="rounded-lg shadow grid grid-cols-3 dark:bg-gray-800 dark:border-gray-700">


                            <div class="hidden">
                                <input
                                    @if ($request->checkin) value="{{ Carbon\Carbon::parse($request->checkin)->format('Y-m-d') }}" @endif
                                    name="checkin" min="{{ now()->addDays(1)->format('Y-m-d') }}" type="date"
                                    id="checkin"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>

                                <input
                                    @if ($request->checkout) value="{{ Carbon\Carbon::parse($request->checkout)->format('Y-m-d') }}" @endif
                                    value="" name="checkout" min="{{ now()->addDays(1)->format('Y-m-d') }}"
                                    type="date" id="checkout"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required>


                                <select name="adults" id="adults"
                                    class="bg-gray-50 border wi- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose adults number</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option @if ($request->filled('checkin') && $request->adults == $i) selected @endif
                                            value="{{ $i }}">
                                            {{ $i }}</option>
                                    @endfor
                                </select>

                                <select name="children" id="children"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected>Choose child number</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option @if ($request->filled('children') && $request->children == $i) selected @endif
                                            value="{{ $i }}">
                                            {{ $i }}</option>
                                    @endfor
                                </select>


                            </div>



                            <a href="#">
                                <img class="object-cover  rounded-lg sm:rounded-none sm:rounded-l-lg"
                                    src="/storage/rooms/{{ $room->image }}" alt="Bonnie Avatar">
                            </a>
                            <div class="p-5 col-span-2 flex flex-col justify-between ">

                                <div>


                                    <h3 class="text-3xl font-bold tracking-tight mb-2 text-gray-900 dark:text-white">
                                        <a href="#">{{ $room->name }}</a>
                                    </h3>
                                    <div class="mb-5">
                                        <h4>Features</h4>


                                        @foreach ($room->features as $feature)
                                            <span
                                                class="bg-purple-100 text-purple-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">{{ $feature }}</span>
                                        @endforeach
                                    </div>

                                    <div class="mb-5">
                                        <h4>Facilities</h4>


                                        @foreach ($room->facilities as $facility)
                                            <span
                                                class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">{{ $facility }}</span>
                                        @endforeach
                                    </div>


                                    <div class="mb-5">
                                        <h4>Guests</h4>

                                        <span
                                            class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">{{ $room->max_adults }}
                                            Adults</span>
                                        <span
                                            class="bg-pink-100 text-pink-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full dark:bg-pink-900 dark:text-pink-300">{{ $room->max_children }}
                                            Children</span>

                                    </div>


                                </div>

                                <div class="flex items-center justify-between">
                                    <h4 class="text-2xl">${{ $room->price }}/Per night</h4>

                                    @auth

                                        @if ($request->adults)
                                            <button type="submit" href="{{ route('booking.view.payment', $room->id) }}"
                                                class="focus:outline-none self-end justify-self-end text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Book
                                                Now</button>
                                        @endif
                                    @endauth
                                </div>

                            </div>
                        </form>
                    @empty
                        <h4 class="text-3xl text-center">No Rooms to Show!</h4>
                    @endforelse



                </div>
            </div>




        </div>
    </section>


</x-guest-layout>
