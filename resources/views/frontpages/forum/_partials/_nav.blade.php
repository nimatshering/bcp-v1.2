 <header class="relative py-6 flex content-center justify-center">
      <div class="absolute top-0 w-full h-48 bg-center bg-cover" style='background-image: url("/assets/img/bg.jpg");'>
        <span id="blackOverlay" class="w-full h-full absolute opacity-60 bg-black"></span>
      </div>
      <div class="container relative pb-4">
        <div class="flex flex-wrap">
          <div class="container w-full lg:w-6/12 lg:text-center text-white">
            <div class="flex flex-row">
              <div class="hidden md:block">
                <a href="{{ route('landing') }}">
                  <img alt="..." src="{{ asset('assets/img/logo.png')}}" class=" max-w-full h-20" />
                </a>
              </div>
              <div class="px-4 text-center md:text-left">
                <h1 class="font-bold md:font-extrabold uppercase lg:text-2xl">
                  National Environment Commission
                </h1>
                <p class="font-dzongkha mt-2 text-white lg:text-2xl">
                  རྒྱལ་ཡོངས་མཐའ་འཁོར་གནས་སྟངས་ལྷན་ཚོགས།
                </p>
              </div>
            </div>
          </div>

          <!-- navigation menu -->
          <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
            <div class="flex flex-col gap-2">
              <div class="lg:pl-24 lg:text-left text-white">
                <h1 class="font-bold md:font-extrabold uppercase lg:text-4xl text-center">
                  Bhutan Climate Platform
                </h1>
                <p class="hidden lg:block mt-2 text-center">
                  A knowledge base for climate change initatives in Bhutan.
                </p>
              </div>

              <div class="flex justify-center pt-4 gap-4">
                <a href="{{ route('landing') }}">
                  <h2
                    class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-yellow-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                    <i class="fa fa-long-arrow-alt-left lg:pr-4"></i> Home</h2>
                </a>
                @if (Auth::check())
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                    <h2
                      class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-blue-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                      Logout</h2>
                  </button>
                  </form>
                @else 
                  <a href="{{ route('register') }}">
                    <h2
                      class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-green-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                      Register</h2>
                  </a>

                  <a href="{{ route('login') }}">
                    <h2
                      class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-blue-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                      Login</h2>
                  </a>
                @endif
                
              </div>
            </div>
          </div>
        </div>
      </div>
  </header>