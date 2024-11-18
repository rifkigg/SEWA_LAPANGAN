<nav
class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
>
<div
  class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
>
  <button
    class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
    type="button"
    onclick="toggleNavbar('example-collapse-sidebar')"
  >
    <i class="fas fa-bars"></i>
  </button>
  <a
    class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-md uppercase font-bold p-4 px-0"
    href="{{ route('home') }}"
  >
    LapanganKu
  </a>
  <ul class="md:hidden items-center flex flex-wrap list-none">
    <li class="inline-block relative">
      {{-- <a
        class="text-blueGray-500 block py-1 px-3"
        href="#pablo"
        onclick="openDropdown(event,'notification-dropdown')"
        ><i class="fas fa-bell"></i
      ></a> --}}
      <div
        class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
        id="notification-dropdown"
      >
        <x-navbar-dashboard-list/>
      </div>
    </li>
    <li class="inline-block relative">
      <a
        class="text-blueGray-500 block"
        href="#pablo"
        onclick="openDropdown(event,'user-responsive-dropdown')"
        ><div class="items-center flex">
          <span
            class="w-12 h-12 text-sm text-white bg-blueGray-200 inline-flex items-center justify-center rounded-full"
            >
            @if(auth()->user()->avatar && file_exists(public_path('storage/' . auth()->user()->avatar)))
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="User Avatar" class="w-10 h-10 rounded-full">
            @else 
                <img src="{{ auth()->user()->avatar }}" alt="Default Avatar" class="w-10 h-10 rounded-full">
            @endif
          </span></div
      ></a>
      <div
        class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
        id="user-responsive-dropdown"
      >
        <x-navbar-dashboard-list/>  
      </div>
    </li>
  </ul>
  <div
    class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:shadow-none bg-white px-5 md:px-0 shadow fixed top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-[100vh] items-center flex-1 rounded hidden"
    id="example-collapse-sidebar"
  >
    <div
      class="md:min-w-full md:hidden block py-4 mb-4 border-b border-solid border-blueGray-200"
    >
      <div class="flex flex-wrap items-center">
        <div class="w-6/12">
          <a
            class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-md uppercase font-bold p-4 px-0"
            href="routes('home')"
          >
            LapanganKu
          </a>
        </div>
        <div class="w-6/12 flex justify-end">
          <button
            type="button"
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            onclick="toggleNavbar('example-collapse-sidebar')"
          >
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
    </div>
    {{-- <form class="mt-6 mb-4 md:hidden">
      <div class="mb-3 pt-0">
        <input
          type="text"
          placeholder="Search"
          class="border-0 px-3 py-2 h-12 border border-solid border-blueGray-500 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-base leading-snug shadow-none outline-none focus:outline-none w-full font-normal"
        />
      </div>
    </form> --}}
    <!-- Divider -->
    <hr class="my-4 md:min-w-full hidden md:block" />
    {{-- <!-- Heading -->
    <h6
      class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
    >
      Admin Layout Pages
    </h6>
    <!-- Navigation --> --}}

    <ul class="md:flex-col md:min-w-full flex flex-col list-none">
      <li class="items-center">
        <a
          href="{{ route('dashboard') }}"
          class="text-xs uppercase py-3 font-bold block {{ Route::currentRouteName() == 'dashboard' ? 'text-pink-500 hover:text-pink-600' : 'text-blueGray-600 hover:text-blueGray-500' }}"
        >
          <i class="fas fa-table mr-2 text-sm"></i>
          Dashboard
        </a>
      </li>

      <li class="items-center">
        <a
          href="{{ route('field.index') }}"
          class="text-xs uppercase py-3 font-bold block {{ Route::currentRouteName() == 'field.index' ? 'text-pink-500 hover:text-pink-600' : 'text-blueGray-600 hover:text-blueGray-500' }}"
        >
          <i class="fas fa-table mr-2 text-sm"></i>
          Lapangan
        </a>
      </li>

      {{-- <li class="items-center">
        <a
          href="#"
          class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
        >
          <i class="fas fa-tools mr-2 text-sm text-blueGray-300"></i>
          Settings
        </a>
      </li>

      <li class="items-center">
        <a
          href="#"
          class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
        >
          <i class="fas fa-table mr-2 text-sm text-blueGray-300"></i>
          Tables
        </a>
      </li>

      <li class="items-center">
        <a
          href="#"
          class="text-xs uppercase py-3 font-bold block text-blueGray-700 hover:text-blueGray-500"
        >
          <i
            class="fas fa-map-marked mr-2 text-sm text-blueGray-300"
          ></i>
          Maps
        </a>
      </li> --}}
    </ul>

    {{-- <!-- Divider -->
    <hr class="my-4 md:min-w-full" />
    <!-- Heading -->
    <h6
      class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
    >
      Auth Layout Pages
    </h6>
    <!-- Navigation -->

    <ul
      class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
    >
      <li class="items-center">
        <a
          href="#"
          class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
        >
          <i
            class="fas fa-fingerprint text-blueGray-300 mr-2 text-sm"
          ></i>
          Login
        </a>
      </li>

      <li class="items-center">
        <a
          href="#"
          class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
        >
          <i
            class="fas fa-clipboard-list text-blueGray-300 mr-2 text-sm"
          ></i>
          Register
        </a>
      </li>
    </ul> --}}


  </div>
</div>
</nav>