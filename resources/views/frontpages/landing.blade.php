<x-guest-layout>
   <x-front.top-header />
    <!-- Navigation -->
    <section class="relative py-2 bg-white">
      <div class="container mx-auto flex flex-col md:flex-row w-full sm:w-10/12 justify-between items-center p-4 md:p-0">
        <figure class="image-card shrink">
          <img src="assets/img/nav/climate-science.jpg" alt="climate science-research" />
          <figcaption>
            <div class="square">
              <div></div>
            </div>
            <h2 class="p-2"><span>Climate Science & Research</span></h2>
            <p>Research Papers and Publications</p>
          </figcaption>
          <a href="{{ route('climatescience.category') }}"></a>
        </figure>

        <figure class="image-card shrink">
          <img src="assets/img/nav/climate-data.jpg" alt="climate science-research" />
          <figcaption>
            <div class="square">
              <div></div>
            </div>
            <h2><span> Data</span></h2>
            <p>Data on Climate, Water and Disaster</p>
          </figcaption>
          <a href="{{ route('analysed.data') }}"></a>
        </figure>

        <figure class="image-card shrink">
          <img src="assets/img/nav/legislation-policy.jpg" alt="Guidance Document" />
          <figcaption>
            <div class="square">
              <div></div>
            </div>
            <h2><span>Guidance Documents</span></h2>
            <p>Policy and Legislation Documents</p>
          </figcaption>
          <a href="{{ route('guidance.category') }}"></a>
        </figure>

         <figure class="image-card shrink">
          <img src="assets/img/nav/climate-science.jpg" alt="climate science-research" />
          <figcaption>
            <div class="square">
              <div></div>
            </div>
            <h2><span>Projects & Programs</span></h2>
            <p>Research Papers and Publications</p>
          </figcaption>
          <a href="{{ route('projectprograms') }}"></a>
        </figure>

        <figure class="image-card shrink">
          <img src="assets/img/nav/training-events.jpg" alt="training-events" />
          <figcaption>
            <div class="square">
              <div></div>
            </div>
            <h2><span>Training & Events</span></h2>
            <p>Training Opportunities and Events.</p>
          </figcaption>
          <a href="{{ route('trainingevents') }}"></a>
        </figure>

      </div>
    </section>

    <!-- Stats -->
    <section class="relative py-10 bg-gray-100">
      <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-1">
          <div class="p-2"> 
            <figure class="highcharts-figure">
                <div id="container-disaster"></div>
            </figure>
          </div>
          <div class="p-2"> 
            <figure class="highcharts-figure">
                <div id="container-temp"></div>
            </figure>
          </div>
          
          <div class="p-2"> 
            <figure class="highcharts-figure">
                <div id="container-ghg"></div>
            </figure>
          </div>
      </div>
    </section>

 
    <!-- Media Gallery -->
    <section class="container mx-auto py-10 bg-white">
      <h2 class="flex md:text-2xl font-extrabold leading-8 tracking-tight justify-center py-10 uppercase">Media Gallery</h2>
        <div class="flex flex-wrap space-x-4 justify-evenly">
          <div class="flex md:w-8/12 space-x-4">
            @foreach ($medias as $item)
              <div class="w-full">
                <div class="video-container" data-aos="zoom-in">
                  <iframe class="video" src="{{ $item->videolink }}" allowfullscreen></iframe>
                </div>
              </div>
               @endforeach
            </div>

          <div class="w-full md:w-3/12">
            <!-- Slideshow container -->
            <div class="slideshow-container" data-aos="zoom-in">
              <div class="gallerySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="assets/img/photo-gallery/1.jpg" style="width:100%">
              </div>
            
              <div class="gallerySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="assets/img/photo-gallery/2.jpg" style="width:100%">
              </div>
            
              <div class="gallerySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="assets/img/photo-gallery/3.jpg" style="width:100%">
              </div>
            </div>
          </div>
        </div>
        <div class="flex flex-wrap justify-evenly mt-6">
          <div class="flex w-9/12 justify-center">
            <a href="{{ route('mediagallery')}}" class="py-3 px-6 text-white uppercase text-xs rounded-lg bg-green-600 hover:bg-green-500 shadow-lg block md:inline-block">
              See More Videos <i class="fa fa-long-arrow-alt-right pl-4"></i>
            </a>
          </div>
          <div class="w-3/12 justify-center"></div>
        </div>
      </div>
    </section>

  @push('scripts')

  @include('frontpages._drawLandingGraphs')
    
  @endpush
</x-guest-layout>
