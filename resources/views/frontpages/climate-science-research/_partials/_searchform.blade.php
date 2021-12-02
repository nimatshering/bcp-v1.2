<form action="{{ route('search.climatescience.document') }}" method="POST">
    @csrf
    <div class="p-4 flex flex-wrap justify-between gap-2 bg-gray-50 shadow border rounded-lg">
      <div class="w-full md:w-4/12">
        <select name ="searchby" class="w-full form-control text-gray-500">
          <option value=""> Search by  </option>
          <option value="author">Author</option>
          <option value="title">Title</option>
        </select>
      </div>
      <div class="w-full md:w-7/12">
        <div class="flex gap-2">
          <input type="text" name = "searchkey" placeholder=" Keyword ..." class="w-8/12 form-control"/>
            <input type="hidden" name="category" value="{{ $category->id }}">
            <input type="hidden" name="subcategory" value="{{ $subcategory->id }}">

          <button type ="submit" class="m-1 px-4 text-left flex items-center rounded-md bg-green-500 text-white text-xs font-bold uppercase ">
            <i class="fa fa-search mr-1"></i> Search  
          </button>
        </div>
      </div>
  </div>
</form>