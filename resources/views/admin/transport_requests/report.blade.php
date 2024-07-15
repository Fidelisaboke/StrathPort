<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Requests Report</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-100 ">
    <div class="container p-6 mx-auto">
        <h1 class="mb-6 text-4xl font-bold text-center">Transport Requests Report</h1>
        <p class="mb-8 text-sm text-center text-gray-600">Generated on: {{ date('Y-m-d') }}</p>

        <div class="flex justify-between mb-6">
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.transport_requests.index') }}"
                    class="px-4 py-2 text-sm font-semibold text-white rounded-md bg-fuchsia-600 hover:bg-fuchsia-700">Back
                    to List</a>
            </div>
        </div>


        <div class="flex flex-col items-center p-6 mx-auto mb-10 bg-white rounded-lg shadow max-w-max">
            <h2 class="mb-4 text-3xl font-semibold">Summary</h2>
            <div class="grid grid-cols-2 gap-16">
                <div class="flex flex-col items-center">
                    <p class="p-2 mb-2 text-lg font-semibold">Requests and Users:</p>
                    <ul class="pl-4 text-lg text-gray-700 list-disc list-inside">
                        <li>Total Requests: {{ $totalRequests }}</li>
                        <li>Unique Users: {{ $uniqueUsers }}</li>
                    </ul>
                </div>
                <div>
                    <p class="p-2 mb-2 text-lg font-semibold">Status Breakdown:</p>
                    <ul class="pl-4 text-lg text-gray-700 list-disc list-inside">
                        @foreach ($statusCounts as $status => $count)
                            <li>{{ $status }}: {{ $count }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div>
            <h2 class="mb-6 text-3xl font-semibold">Detailed Report</h2>
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full border border-collapse border-gray-200 rounded-md">
                    <thead class="bg-fuchsia-100">
                        <tr>
                            <th class="px-6 py-3 font-medium text-left text-gray-700 border-b">ID</th>
                            <th class="px-6 py-3 font-medium text-left text-gray-700 border-b">User</th>
                            <th class="px-6 py-3 font-medium text-left text-gray-700 border-b">Title</th>
                            <th class="px-6 py-3 font-medium text-left text-gray-700 border-b">Event Date</th>
                            <th class="px-6 py-3 font-medium text-left text-gray-700 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transportRequests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 border-b">{{ $request->id }}</td>
                                <td class="px-6 py-4 border-b">{{ $request->user->name }}</td>
                                <td class="px-6 py-4 border-b">{{ $request->title }}</td>
                                <td class="px-6 py-4 border-b">{{ $request->event_date }}</td>
                                <td class="px-6 py-4 border-b">
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-semibold rounded-full uppercase
                                        @if ($request->status == 'Pending') bg-yellow-500/20 text-yellow-600
                                        @elseif ($request->status == 'Approved')
                                            bg-green-500/20 text-green-600
                                        @elseif ($request->status == 'Declined')
                                            bg-red-500/20 text-red-600
                                        @else
                                            bg-gray-500/20 text-gray-600 @endif">
                                        {{ $request->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
