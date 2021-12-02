   <header class="relative py-4 content-center">
        <div class="absolute top-0 w-full h-full bg-center bg-cover"
        style='background-image: url("/assets/img/bg.jpg");'>
        <span id="blackOverlay" class="w-full h-full absolute opacity-60 bg-black"></span>
      </div>
      <div class="container relative py-4">
          <div class="flex w-full justify-center lg:text-center text-white">
            <div class="lg:pl-24 text-center lg:text-left">
              <h1 class="font-bold md:font-extrabold uppercase lg:text-2xl">
                Bhutan Climate Platform
              </h1>
              <p class="hidden lg:block">
                A knowledge base for climate change initatives in Bhutan.
              </p>
            </div>
          </div>
          <div>
        </div>
      </div>
 
        <!-- navigation menu -->
          <div class="w-full px-4 ml-auto mr-auto text-center">
             <div class="flex flex-row justify-center gap-4">
                <div class=" shrink">
                  <a href="{{ route('landing')}}">
                    <h2
                      class="items-center px-6 py-2 font-light text-sm text-gray-700 bg-yellow-400 hover:bg-yellow-200 hover:text-gray-700 rounded-full">
                      <i class="fa fa-long-arrow-alt-left pr-4"></i> Home
                    </h2>
                  </a>
                </div>

                <div class="card shrink">
                  <div class="bg-transparent flex items-center justify-center w-20">
                     <svg width="44" height="44" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                  </div>
                  <div class="card-body w-40">
                    <a href="{{ route('posts','proposals') }}">
                      <h2 class="font-bold text-sm">Call for proposals</h2>
                      <p class="text-xs text-gray-600">
                        Proposals
                      </p>
                    </a>
                  </div>
                </div>

                <div class="card shrink">
                  <div class="bg-transparent flex items-center justify-center w-20">
                     <svg width="44" height="44" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                  </div>
                  <div class="card-body w-40">
                  <a href="{{ route('post.events') }}">
                        <h2 class="font-bold text-sm">Events</h2>
                        <p class="text-xs text-gray-600">
                          Events
                        </p>
                      </a>
                  </div>
                </div>

                <div class="card shrink">
                  <div class="bg-transparent flex items-center justify-center w-20">
                     <svg width="44" height="44" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                  </div>
                  <div class="card-body w-40">
                    <a href="{{ route('posts','trainings') }}">
                      <h2 class="font-bold text-sm">Training Opportunities</h2>
                      <p class="text-xs text-gray-600">
                        Training Opportunities
                      </p>
                    </a>
                  </div>
                </div>
            </div>
          </div>
  </header>