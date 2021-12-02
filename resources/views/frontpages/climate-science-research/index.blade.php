<x-guest-layout>
  <!-- Header Section-->
   <x-front.top-header />

   <!-- breadcrumbs-->
   <div class="container mx-auto my-4">
    <div class="mx-4 md:mx-0 bg-gray-100 rounded shadow">
      <h2 class="p-3 w-full text-blue font-bold uppercase text-center">Climate Science and Research</h2>
    </div>
  </div>

 <!-- Guidance Document-->
    <section class="relative py-6 flex content-center justify-center bg-white min-h-screen">
      <div class="container mx-auto px-4 md:px-0">
        <div class="flex flex-wrap">
          <div class="md:w-3/12 w-full">
            @foreach ($categories as $item)
              <div class="mb-2 shrink">
                <div class="flex max-w-sm w-full bg-gray-50 shadow rounded overflow-hidden mx-auto">
                  <div class="w-4 bg-green-600"></div>
                  <div class="w-full">
                      <a href="{{ route('climatescience.subcategory',$item->slug)}}">
                        <h2 class="flex text-md p-4"><span class="pr-2">{!! $item->icon !!}</span> {{ $item->name }} </h2>
                      </a>
                  </div>
                </div>
            </div>
              @endforeach
          </div>

          <div class="w-full md:w-9/12 px-4 mr-auto ml-auto" data-aos="fade-up">
            <p class="text-justify">
              Earth's climate has changed throughout history. Just in the last 650,000 years there have been seven cycles of
              glacial
              advance and retreat, with the abrupt end of the last ice age about 11,700 years ago marking the beginning of
              the modern
              climate era — and of human civilization. Most of these climate changes are attributed to very small variations
              in
              Earth’s orbit that change the amount of solar energy our planet receives.
            </p>
    
            <p class="text-justify">
              The current warming trend is of particular significance because most of it is extremely likely (greater than
              95%
              probability) to be the result of human activity since the mid-20th century and proceeding at a rate that is
              unprecedented over decades to millennia.1
            </p>
            <p class="text-justify">
              Earth-orbiting satellites and other technological advances have enabled scientists to see the big picture,
              collecting
              many different types of information about our planet and its climate on a global scale. This body of data,
              collected
              over many years, reveals the signals of a changing climate.
            </p>
            <p class="text-justify">
              The heat-trapping nature of carbon dioxide and other gases was demonstrated in the mid-19th century.2 Their
              ability to
              affect the transfer of infrared energy through the atmosphere is the scientific basis of many instruments
              flown by NASA.
              There is no question that increased levels of greenhouse gases must cause Earth to warm in response.
            </p>
            <p class="text-justify">
              Ice cores drawn from Greenland, Antarctica, and tropical mountain glaciers show that Earth’s climate responds
              to changes
              in greenhouse gas levels. Ancient evidence can also be found in tree rings, ocean sediments, coral reefs, and
              layers of
              sedimentary rocks. This ancient, or paleoclimate, evidence reveals that current warming is occurring roughly
              ten times
              faster than the average rate of ice-age-recovery warming. Carbon dioxide from human activity is increasing
              more than 250
              times faster than it did from natural sources after the last Ice Age.3
            </p>
          </div>
        </div>
      </div>
    </section>
</x-guest-layout>
