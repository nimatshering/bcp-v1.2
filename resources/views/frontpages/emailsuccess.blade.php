<x-guest-layout>
<x-front.top-header />
  <section class="relative min-h-screen">
    <div class="container mx-auto w-8/12 h-screen mt-20">
      <div class="flex justify-center p-5">
        @if (Session::has('success'))
        <div class="flex w-full max-w-xl mx-auto overflow-hidden bg-gray-50 rounded-lg shadow-md dark:bg-gray-800">
          <div class="flex items-center justify-center w-12 bg-green-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
            </svg>
          </div>
            
          <div class="px-4 py-2">
            <div class="mx-3">
              <span class="font-semibold text-green-500 dark:text-green-400">Success</span>
              <p class="text-sm text-gray-600 dark:text-gray-200"> {{ Session::get('success') }}</p>
              @php Session::forget('success');@endphp
            </div>
          </div>
        </div>
        @endif

        @if (count($errors) > 0)
          <div class="flex w-full max-w-sm mx-auto overflow-hidden bg-gray-50 rounded-lg shadow-md dark:bg-gray-800">
            <div class="flex items-center justify-center w-12 bg-red-500">
              <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
              </svg>
            </div>
            
            <div class="px-4 py-2 -mx-3">
              <div class="mx-3">
                <span class="font-semibold text-red-500">Errors:</span>
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>
</x-guest-layout>
