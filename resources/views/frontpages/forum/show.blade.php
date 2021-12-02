<x-guest-layout>
  <!-- Header Section-->
  @include('frontpages.forum._partials._nav')

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
                  <div class="mt-4 px-4 lg:px-10 py-6 bg-white rounded shadow border">
                    <div class="flex flex-wrap justify-between items-center">
                      <span class="font-light text-gray-600">{{ $post->created_at}}</span>
                      <h1 class="px-2 py-1 bg-green-600 text-gray-100 font-bold rounded hover:bg-gray-500">
                        {{ $post->category->name }}
                      </h1>
                    </div>
                    <div class="my-2"><h1 class="text-2xl text-gray-700 font-bold hover:underline"> {{ $post->topic }}</h1>
                    {!! $post->content !!}
                    </div>
                     <div class="my-2 text-lg font-semibold">Comments</div>

                        <!-- Comment -->
                    <div class="my-2 px-10">
                      <form action="{{ route('post.comment',$post->id)}}" method="POST">
                        @csrf
                        <div class="my-2">
                            <label for="username">Name</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>

                         <div class="my-2">
                            <label for="comment">Comment</label>
                            <textarea name="comment" rows="5" cols="33" class="form-control shadow"></textarea>
                        </div>

                        <div class="text-right mt-2">
                          <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded"> Post</button>
                        </div>
                      </form>
                    </div>

                     <div class="mt-4 px-10">
                      @foreach ($post->comments as $item)
                      <div class="my-2 border p-2 bg-gray-100 rounded">
                        <div class="text-gray-500 pb-2 text-sm"> {!! $item->username !!} | {!! $item->created_at->format('d-M-Y') !!} </div>
                        <div> {!! $item->comment !!}</div>
                      </div>
                      @endforeach
                    </div>
                  </div>
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
