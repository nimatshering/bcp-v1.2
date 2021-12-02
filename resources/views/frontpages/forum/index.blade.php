
<x-guest-layout>
  @push('scripts')
  <div id="fb-root"></div>
  <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="iiKSZ6R7"></script>
@endpush
  <!-- Header Section-->
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

    <!-- Content -->
    <section class="relative pb-20 flex content-center items-center justify-center  mt-10">
      <div class="container mx-auto px-4">
        <h2 class="flex md:text-2xl font-extrabold leading-8 tracking-tight justify-center pb-6 uppercase">Discussion Forum</h2>
        <div class="overflow-x-hidden">
            <div class="flex flex-wrap justify-between container mx-auto">
              <div class="w-full lg:w-8/12">
                <div class="flex items-center justify-between">
                  <h1 class="text-xl font-bold text-gray-700 md:text-2xl">Discussion Topic</h1>
                </div>
                @foreach ($forumposts as $item)
                  <div class="mt-4 px-4 lg:px-10 py-6 bg-white rounded shadow border">
                    <div class="flex flex-wrap justify-between items-center">
                      <span class="font-light text-gray-600">{{ $item->created_at}}</span>
                      <h1 class="px-2 py-1 bg-green-600 text-gray-100 font-bold rounded hover:bg-gray-500">
                        {{ $item->category->name }}
                      </h1>
                    </div>
                    <div class="my-2">
                      <a href="{{ route('showforum', $item->id ) }}" class="text-2xl text-gray-700 font-bold hover:underline"> 
                        {{ $item->topic }}
                      </a>
                      <div class="py-2">
                          {!! $item->summary !!}
                      </div>
                    </div>
                    <div class="flex justify-between items-center mt-4">
                      <div class="flex items-center">
                          <div class="text-gray-700 text-lg">
                            <i class="fa fa-comment-alt"></i> <span class="text-xs">{!! $item->comments->count() !!}</span>
                            <div class="fb-like" data-href="{{ route('showforum', $item->id)}}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                            {{-- <i class="fa fa-eye"></i>10 --}}
                          </div>
                      </div>
                      <div class="flex items-center">
                          <h1 class="text-gray-700 text-xs hover:underline">{{ App\Models\User::findOrFail($item->user_id)->name }}</h1>
                      </div>
                    </div>
                  </div>
                  @endforeach
              </div>
              <div class="w-full lg:-mx-8 lg:w-4/12">
                <div class="mt-10 px-8">
                  <div class="flex flex-col bg-white px-8 py-6 max-w-sm mx-auto rounded shadow border">
                    <h1 class="mb-4 text-xl font-bold text-gray-700">Recent Post</h1>
                    @foreach ($recentpost as $item)
                      <div class="mt-4"><a href="#" class="text-lg text-gray-700 font-medium hover:underline">
                        {{ $item->topic  }}</a>
                      </div>
                    @endforeach              
                  </div>
                </div>
              </div>
            </div>
        </div>

      </div>
    </section>
</x-guest-layout>
