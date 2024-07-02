<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Transport Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="max-w-6xl py-10 mx-auto sm:px-6 lg:px-8">
                <div class="block mb-8">
                    <a href="{{ route('transport_requests.index') }}" class="px-4 py-2 font-bold text-black bg-gray-200 rounded hover:bg-gray-400">Back to list</a>
                </div>
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                                <table class="w-full min-w-full divide-y divide-gray-200">
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                                            ID
                                        </th>
                                        <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200 whitespace-nowrap">
                                            {{ $transportRequest->id }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                                            Title
                                        </th>
                                        <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200 whitespace-nowrap">
                                            {{ $transportRequest->title }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                                            Description
                                        </th>
                                        <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200 whitespace-nowrap">
                                            {{ $transportRequest->description }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                                            Date
                                        </th>
                                        <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200 whitespace-nowrap">
                                            {{ $transportRequest->event_date }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                                            Time
                                        </th>
                                        <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200 whitespace-nowrap">
                                            {{ $transportRequest->event_time }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                                            Location
                                        </th>
                                        <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200 whitespace-nowrap">
                                            {{ $transportRequest->event_location }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                                            No of People Expected
                                        </th>
                                        <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200 whitespace-nowrap">
                                            {{ $transportRequest->no_of_people }}
                                        </td>
                                    </tr>
                                    <tr class="border-b">
                                        <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase bg-gray-50">
                                            Status
                                        </th>
                                        <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200 whitespace-nowrap">
                                            {{ $transportRequest->status}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
