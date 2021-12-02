<x-app-layout>
  <div class="container mx-auto w-10/12 mt-10">
    <x-utilities.messages />
    <div class="my-4 text-right">
      @include('backend.admin.users.partials._add-modal-dialog')
    </div>

    <div class="flex flex-col">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200 table-auto">
            <thead class="bg-gray-100">
              <tr class="text-gray-800 text-xs font-semibold uppercase">
                <th scope="col" class="px-6 py-4 text-left tracking-wider">
                </th>
                <th scope="col" class="px-6 py-4 text-left tracking-wider">
                    User Name 
                </th>
                <th scope="col" class="px-6 py-4 text-left tracking-wider">
                    Roles
                </th>
                <th scope="col" class="px-6 py-4 text-right tracking-wider">
                    Actions
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($users as $user)
              <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        <label class="inline-flex items-center">
                          <input type="checkbox" class="form-checkbox text-gray-600">
                        </label>
                      </div>
                    </div>
                  </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ $user->name}}
                  </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    @foreach ($user->roles as $role)
                      <span class="bg-green-300 px-4 p-1 rounded-full uppercase text-xs">{{ $role->name }}</span> 
                    @endforeach
                  </div>
                </td>
                
                <td class="flex justify-end gap-2 p-2">
                  <div class="flex justify-center">
                      @include('backend.admin.users.partials._edit-modal-dialog')
                  </div>
                    @include('backend.admin.users.partials._delete-modal-dialog')
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="p-4">
              {{ $users->links() }}
          </div>
          </div>
          </div>
      </div>
    </div>
  </div>
</x-app-layout>