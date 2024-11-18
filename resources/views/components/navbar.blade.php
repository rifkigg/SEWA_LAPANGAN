<nav
class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 navbar-expand-lg bg-white shadow"
>
<div
  class="container px-4 mx-auto flex flex-wrap items-center justify-between"
>
  {{-- <div
    class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start"
  > --}}
    <a
      class="text-blueGray-700 text-sm font-bold leading-relaxed inline-block mr-4 py-2 whitespace-nowrap uppercase"
      href="#"
      >LapanganKu</a
    >
    {{-- <button
      class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
      type="button"
      onclick="toggleNavbar('example-collapse-navbar')"
    > --}}
    @if (Auth::check())
        
    <ul
      class="flex flex-col lg:flex-row list-none lg:ml-auto items-center"
    >
      <li class="inline-block relative">
        <a
          class="hover:text-blueGray-500 text-blueGray-700 px-3 flex items-center text-xs uppercase font-bold cursor-pointer"
          onclick="openDropdown(event,'demo-pages-dropdown')"
        >
        @if(auth()->user()->avatar && file_exists(public_path('storage/' . auth()->user()->avatar)))
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="User Avatar" class="w-10 h-10 rounded-full">
        @else 
            <img src="{{ auth()->user()->avatar }}" alt="Default Avatar" class="w-10 h-10 rounded-full">
        @endif
        </a>
        <div
          class="hidden bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48 navbar-popper"
          id="demo-pages-dropdown"
        >
          <a
            href="{{ route('dashboard') }}"
            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700{{ Auth::user()->role == 'admin' || Auth::user()->role == 'owner' ? '' : ' hidden' }}"
          >
            Dashboard
          </a>
          <a
            href="./pages/admin/settings.html"
            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
          >
            Settings
          </a>
          <a
            href="{{ route('profile.edit') }}"
            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700"
          >
            Profile
          </a>
          <div class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-blueGray-700">
            <x-change-theme-list />
          </div>
        </div>
      </li>
    </ul>
      @else
      <ul class="flex flex-col lg:flex-row list-none lg:ml-auto items-center">
        <li class="flex items-center">
          <a
          class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="{{ route('login') }}"
          target="_blank"
          >Login</a
          >
        </li>
      </ul>
    @endif
    {{-- </button> --}}
  </div>
  {{-- <div
    class="lg:flex flex-grow items-center bg-white lg:bg-opacity-0 lg:shadow-none hidden"
    id="example-collapse-navbar"
  > --}}
    {{-- <ul class="flex flex-col lg:flex-row list-none mr-auto">
      <li class="flex items-center">
        <a
          class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="https://www.creative-tim.com/learning-lab/tailwind/js/overview/notus?ref=njs-index"
          ><i
            class="text-blueGray-400 far fa-file-alt text-lg leading-lg mr-2"
          ></i>
          Docs</a
        >
      </li>
    </ul> --}}
   
      {{-- <li class="flex items-center">
        <a
          class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdemos.creative-tim.com%2Fnotus-js%2F"
          target="_blank"
          ><i
            class="text-blueGray-400 fab fa-facebook text-lg leading-lg"
          ></i
          ><span class="lg:hidden inline-block ml-2">Share</span></a
        >
      </li>
      <li class="flex items-center">
        <a
          class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fdemos.creative-tim.com%2Fnotus-js%2F&text=Start%20your%20development%20with%20a%20Free%20Tailwind%20CSS%20and%20JavaScript%20UI%20Kit%20and%20Admin.%20Let%20Notus%20JS%20amaze%20you%20with%20its%20cool%20features%20and%20build%20tools%20and%20get%20your%20project%20to%20a%20whole%20new%20level."
          target="_blank"
          ><i
            class="text-blueGray-400 fab fa-twitter text-lg leading-lg"
          ></i
          ><span class="lg:hidden inline-block ml-2">Tweet</span></a
        >
      </li>
      <li class="flex items-center">
        <a
          class="hover:text-blueGray-500 text-blueGray-700 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold"
          href="https://github.com/creativetimofficial/notus-js?ref=njs-index"
          target="_blank"
          ><i
            class="text-blueGray-400 fab fa-github text-lg leading-lg"
          ></i
          ><span class="lg:hidden inline-block ml-2">Star</span></a
        >
      </li>
      <li class="flex items-center">
        <button
          class="text-white bg-pink-500 active:bg-pink-600 text-xs font-bold uppercase px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none lg:mr-1 lg:mb-0 ml-3 mb-3 ease-linear transition-all duration-150"
          type="button"
        >
          <i class="fas fa-arrow-alt-circle-down"></i> Download
        </button>
      </li> --}}
 
  {{-- </div> --}}
{{-- </div> --}}
</nav>