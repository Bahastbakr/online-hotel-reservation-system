<x-guest-layout>


    <section class="mt-36 mx-auto container">

        <h1 class="text-center mb-20 text-5xl font-medium"> Rooms</h1>

        <div class="grid grid-cols-3">

            <div
                class="p-6 bg-white border max-w-sm  h-fit   border-gray-200  rounded-lg shadow-xl dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <h5 class="mb-10 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Check Room
                        availability
                    </h5>
                </a>

                <form class="grid" method="GET" action="{{ route('room.guest.index') }}">

                    <div class="mb-6">
                        <label for="checkin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Check-In</label>
                        <input name="checkin" min="{{ now()->addDays(1)->format('Y-m-d') }}" type="date"
                            id="checkin"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@flowbite.com" required>
                    </div>

                    <div class="mb-6">
                        <label for="checkout" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Check-Out</label>
                        <input name="checkout" min="{{ now()->addDays(1)->format('Y-m-d') }}" type="date"
                            id="checkout"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@flowbite.com" required>
                    </div>

                    <div class="mb-6">


                        <label for="adults"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adults</label>
                        <select name="adults" id="adults"
                            class="bg-gray-50 border wi- border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose adults number</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                    </div>
                    <div class="mb-6">


                        <label for="children"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Children</label>
                        <select name="children" id="children"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>Choose child number</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>

                    </div>

                    <div class="flex">

                        <h4>${{ $room->price }}/Per night</h4>
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

                    </div>


                </form>
            </div>

            <div class="col-span-2">
                <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-1">
                    @forelse ($rooms as $room)
                        <div class="rounded-lg shadow grid grid-cols-3 dark:bg-gray-800 dark:border-gray-700">
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

                                <button type="button"
                                    class="focus:outline-none self-end justify-self-end text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Book
                                    Now</button>


                            </div>
                        </div>
                    @empty
                        <h4 class="text-3xl text-center">No Rooms to Show!</h4>
                    @endforelse



                </div>
            </div>




        </div>
    </section>


</x-guest-layout>
