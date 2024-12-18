<nav
class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-nowrap md:justify-start flex items-center p-4 md:bg-pink-600"
>
<div
  class="w-full mx-autp items-center flex justify-end md:flex-nowrap flex-wrap md:px-10 px-4"
>
  {{-- <a
    class="text-white text-sm uppercase hidden lg:inline-block font-semibold"
    href="./index.html"
    >Dashboard</a
  > --}}
  {{-- <form
    class="md:flex hidden flex-row flex-wrap items-center lg:ml-auto mr-3"
  >
    <div class="relative flex w-full flex-wrap items-stretch">
      <span
        class="z-10 h-full leading-snug font-normal absolute text-center text-blueGray-300 absolute bg-transparent rounded text-base items-center justify-center w-8 pl-3 py-3"
        ><i class="fas fa-search"></i
      ></span>
      <input
        type="text"
        placeholder="Search here..."
        class="border-0 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded text-sm shadow outline-none focus:outline-none focus:ring w-full pl-10"
      />
    </div>
  </form> --}}
  <ul
    class="flex-col md:flex-row list-none items-center hidden md:flex"
  >
    <a
      class="text-blueGray-500 block cursor-pointer"
      onclick="openDropdown(event,'user-dropdown')"
    >
      <div class="items-center flex">
        <span
          class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
          >
          @if(auth()->user()->avatar && file_exists(public_path('storage/' . auth()->user()->avatar)))
              <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="User Avatar" class="w-10 h-10 rounded-full">
          @else 
              <img src="{{ auth()->user()->avatar }}" alt="Default Avatar" class="w-10 h-10 rounded-full border">
          @endif
        </span>
      </div>
    </a>
    <div
      class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
      id="user-dropdown"
    >
        @include('components.navbar-dashboard-list')
    </div>
  </ul>
</div>
</nav>