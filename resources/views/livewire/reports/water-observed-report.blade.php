  <div class="grid grid-cols-1 md:grid-cols-2 gap-2 p-2">
    <select wire:model="selectedStatistic" class="form-control" id="statistic" >
        <option value="" selected>Choose Statistic</option>
        @foreach($statistics as $stat)
          <option value="{{ $stat->type }}">{{ $stat->name }}</option>
        @endforeach
  </select>
    @if ($selectedMonth)
      <select id="month" class="form-control" >
          <option>Choose Month</option>
          option value="Jan">January</option>
          <option value="Feb">February</option>
          <option value="Mar">March</option>
          <option value="Apr">April</option>
          <option value="May">May</option>
          <option value="Jun">June</option>
          <option value="Jul">July</option>
          <option value="Aug">August</option>
          <option value="Sep">September</option>
          <option value="Oct">October</option>
          <option value="Nov">November</option>
          <option value="Dec">December</option>
    </select>
  @endif
</div>