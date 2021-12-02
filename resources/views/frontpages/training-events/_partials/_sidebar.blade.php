<div class="w-full px-4 md:px-0 md:pr-4 ml-auto mr-auto text-center">
    <div class="flex flex-col gap-2">
      <div class="shrink">
          <div class="flex w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('training-and-events/post/proposals') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full">
                <a href="{{ route('posts','proposals') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-4 items-center w-full">
                      <i class="fa fa-envelope-open-text text-lg pr-2"></i> Call for proposals </span>
                  </h2>
                </a>
            </div>
          </div>
      </div>

       <div class="shrink">
          <div class="flex w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('training-and-events/events') ? 'bg-green-300' : 'bg-gray-100'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full">
                <a href="{{ route('events') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-4 items-center w-full">
                      <i class="fa fa-calendar-alt text-lg pr-2"></i> Events </span>
                  </h2>
                </a>
            </div>
          </div>
      </div>

        <div class="shrink">
          <div class="flex w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('training-and-events/post/trainings') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full">
                <a href="{{ route('posts','trainings') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-4 items-center w-full">
                      <i class="fa fa-chalkboard-teacher text-lg pr-2"></i> Training Opportunities </span>
                  </h2>
                </a>
            </div>
          </div>
      </div>

         <div class="shrink">
          <div class="flex w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('trainingmaterials') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full">
                <a href="{{ route('trainingmaterials') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-4 items-center w-full">
                      <i class="fa fa-chalkboard-teacher text-lg pr-2"></i> Training Materials </span>
                  </h2>
                </a>
            </div>
          </div>
      </div>

         <div class="shrink">
          <div class="flex w-full bg-gray-100 shadow rounded overflow-hidden mx-auto {{ request()->is('experts') ? 'bg-green-300' : 'bg-white'}}">
            <div class="w-4 bg-green-600"></div>
            <div class="w-full">
                <a href="{{ route('experts') }}">
                  <h2 class="flex font-semibold text-sm gap-2 p-4 items-center w-full">
                      <i class="fa fa-users text-lg pr-2"></i> Experts </span>
                  </h2>
                </a>
            </div>
          </div>
      </div>
       
  </div>
</div>