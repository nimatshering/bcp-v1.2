@push('scripts')
        <script src='https://www.google.com/recaptcha/api.js' async defer></script>
@endpush
<x-guest-layout>
  <!-- Header Section-->
     <x-front.top-header />

      <!-- heading-->
    <div class="container mx-auto my-6">
      <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
            <h2 class="p-3 w-full text-blue font-bold uppercase text-center"> Contact us</h2>
      </div>
    </div>

       @if (Session::has('success'))
        <div class="flex w-full max-w-xl mx-auto overflow-hidden bg-gray-50 rounded-lg shadow">
          <div class="flex items-center justify-center w-12 bg-green-500">
            <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
              <path d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM16.6667 28.3333L8.33337 20L10.6834 17.65L16.6667 23.6166L29.3167 10.9666L31.6667 13.3333L16.6667 28.3333Z"/>
            </svg>
          </div>
            
          <div class="px-4 py-2">
            <div class="mx-3">
              <span class="font-semibold text-green-500">Success</span>
              <p class="text-sm text-gray-600 dark:text-gray-200"> {{ Session::get('success') }}</p>
              @php Session::forget('success');@endphp
            </div>
          </div>
        </div>
        @endif

    <!-- Content -->
    <section class="container mx-auto">
          <p class="m-2 text-center text-gray-600">For any support, please email us using the form below.</p>
      <div class="flex flex-wrap">
        <div class="w-full md:w-3/12 my-4 md:pr-4 mx-4 md:mx-0">
            <div class="grid grid-cols-1 gap-4">
                <div class="flex items-center p-3 text-gray-800 text-center rounded-md bg-gray-100 shadow">
                    <i class="fa fa-map-marker pr-2"></i> Thimphu, Bhutan
                </div>

                <div class="flex items-center p-3 text-gray-800 text-center rounded-md bg-gray-100 shadow">
                    <i class="fa fa-phone pr-2"></i> +975-2-323384/324323/326993
                </div>

                <div class="flex items-center p-3 text-gray-800 text-center rounded-md bg-gray-100 shadow">
                    <i class="fa fa-envelope pr-2"></i> support@nec.gov.bt
                </div>
            </div>
        </div> 
        
        <div class="w-full md:w-9/12 my-4">
          <div class="p-4 rounded-md shadow">
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

                      <div class="mt-2">
                          <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                          @if ($errors->has('g-recaptcha-response'))
                              <span class="invalid-feedback" style="display: block;">
                                  <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                              </span>
                          @endif
                      </div>

                      <div class="flex justify-center ">
                      <button type="submit" class="bg-green-500 px-4 py-2 mt-2 rounded text-white hover:bg-green-600"> Send Message</button>
                      </div>
                  </form>
            
          </div>
        </div>
       </div>  
    </section>
</x-guest-layout>
