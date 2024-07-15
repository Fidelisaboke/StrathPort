<!-- Transport request filter -->
<div class="flex flex-col mb-4 ml-2">
    <label for="status" class="block mb-2 text-sm font-bold text-gray-700">Filter by status:</label>
    <div class="flex items-center space-x-4">
        <select name="status" id="status" class="px-8 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring focus:ring-fuchsia-100 focus:border-fuchsia-300">
            <option value="All" @if(request('status') == 'All' || empty(request('status'))) selected @endif>All</option>
            <option value="In Progress" @if(request('status') == 'In Progress') selected @endif>In Progress</option>
            <option value="Completed" @if(request('status') == 'Completed') selected @endif>Completed</option>
            <option value="Cancelled" @if(request('status') == 'Cancelled') selected @endif>Cancelled</option>
        </select>
        <button type="submit" class="flex items-center justify-center px-3 py-2 font-bold bg-gray-300 rounded hover:bg-gray-400">
            <svg class="w-6 h-6" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M21 6H19M21 12H16M21 18H16M7 20V13.5612C7 13.3532 7 13.2492 6.97958 13.1497C6.96147 13.0615 6.93151 12.9761 6.89052 12.8958C6.84431 12.8054 6.77934 12.7242 6.64939 12.5617L3.35061 8.43826C3.22066 8.27583 3.15569 8.19461 3.10948 8.10417C3.06849 8.02393 3.03853 7.93852 3.02042 7.85026C3 7.75078 3 7.64677 3 7.43875V5.6C3 5.03995 3 4.75992 3.10899 4.54601C3.20487 4.35785 3.35785 4.20487 3.54601 4.10899C3.75992 4 4.03995 4 4.6 4H13.4C13.9601 4 14.2401 4 14.454 4.10899C14.6422 4.20487 14.7951 4.35785 14.891 4.54601C15 4.75992 15 5.03995 15 5.6V7.43875C15 7.64677 15 7.75078 14.9796 7.85026C14.9615 7.93852 14.9315 8.02393 14.8905 8.10417C14.8443 8.19461 14.7793 8.27583 14.6494 8.43826L11.3506 12.5617C11.2207 12.7242 11.1557 12.8054 11.1095 12.8958C11.0685 12.9761 11.0385 13.0615 11.0204 13.1497C11 13.2492 11 13.3532 11 13.5612V17L7 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </div>
</div>
