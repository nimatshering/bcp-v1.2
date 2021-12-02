<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />

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

    <!-- Content -->
    <section class="container mx-auto flex md:flex-row w-full gap-4 min-h-screen">
      <div class="w-full md:w-4/12 px-6 py-4 mx-auto bg-gray-50 rounded-md shadow my-4">
          <h2 class="text-3xl font-semibold text-center text-gray-800 py-4">Contact Us</h2>
          <div class="grid grid-cols-1 gap-4">
              <a href="#" class="flex flex-col items-center px-4 py-3 text-gray-800 text-center rounded-md bg-gray-200 shadow hover:bg-green-400">
                  <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                  </svg>
                  <span class="mt-2">Thimphu, Bhutan</span>
              </a>

              <a href="#" class="flex flex-col items-center px-4 py-3 text-gray-800 text-center rounded-md bg-gray-200 shadow hover:bg-green-400">
                  <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                  </svg>

                  <span class="mt-2">+975-2-323384/324323/326993</span>
              </a>

              <a href="#" class="flex flex-col items-center px-4 py-3 text-gray-800 text-center rounded-md bg-gray-200 shadow hover:bg-green-400">
                  <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                      <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                  </svg>
                  <span class="mt-2">support@nec.gov.bt</span>
              </a>
          </div>
      </div> 
        
      <div class="w-full md:w-8/12  px-6 py-4 mx-auto bg-gray-50 rounded-md shadow my-4">
        <h2 class="text-3xl font-semibold text-center text-gray-800">How can we help?</h2>
        <p class="mt-3 text-center text-gray-600">For any support, please email us using the form below.
          </p>
        <div class="mt-6 ">
             <form action="{{ route('send.email')}}" method="POST">
                    @csrf
                    <div class="mt-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                        <div>{{ $errors->first('name') }}</div>
                    </div>

                    <div class="mt-2">
                        <label for="email">Your Email</label>
                        <input type="text" name="email" value="{{ old('email') }}" class="form-control" required>
                        <div>{{ $errors->first('email') }}</div>
                    </div>
                    
                    <div class="mt-2">
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" required>
                        <div>{{ $errors->first('subject') }}</div>
                    </div>

                    <div class="mt-2">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols = "30" rows ="10" 
                          class="form-control" required>{{ old('message') }} </textarea>
                        <div>{{ $errors->first('message') }}</div>
                    </div>

                    {{-- <div class="mt-2">
                            <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>

                            @if ($errors->has('g-recaptcha-response'))
                                <span class="invalid-feedback" style="display: block;">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                    </div> --}}

                  <button type="submit" class="bg-green-500 px-4 py-2 mt-2 rounded text-white hover:bg-green-600"> Send Message</button>
                </form>
           
        </div>
      </div>
    </section>
</x-guest-layout>
