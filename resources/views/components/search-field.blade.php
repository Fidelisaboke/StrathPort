<div class="relative w-full max-w-xl mx-auto mb-4 bg-white rounded-full">
    <input placeholder="Search..." class="w-full h-16 py-2 pl-8 pr-32 bg-transparent border-2 border-gray-100 rounded-full shadow-md outline-none hover:outline-none focus:ring-fuchsia-200 focus:border-fuchsia-200" type="text" name="search" id="search" value="{{ request('search')}}"">
    <button type="submit" class="absolute inline-flex items-center h-10 px-4 py-2 text-sm text-white transition duration-150 ease-in-out rounded-full outline-none bg-fuchsia-600 right-3 top-3 sm:px-6 sm:text-base sm:font-medium hover:bg-fuchsia-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-fuchsia-500">
      <svg class="-ml-0.5 sm:-ml-1 mr-2 w-4 h-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
      </svg>
      Search
    </button>
</div>
