 <nav class="bg-gray-100 py-3 w-full mt-2 rounded shadow">
    <ol class="list-reset flex text-sm pl-2">
      <li><a href="{{ route('guidance.category')}}" class="text-blue font-bold">Guidance Documents</a></li>
      <li><span class="mx-2">/</span></li>
      <li><a href="{{ route('guidance.subcategory', $category->slug)}}" class="text-blue font-bold">{{ $category->name }}</a></li>
      <li><span class="mx-2">/</span></li>
      <li>{{ $subcategory->name}}</li>
    </ol>
  </nav>