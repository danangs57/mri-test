<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
          Edit Karyawan
      </h2>
  </x-slot>

  <div class="py-1">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{route('user.update',$user->id)}}" method="post">
                  @csrf @method('put')
                  <div class="md:flex items-center mt-12">
                      <div class="w-full md:w-1/2 flex flex-col">
                          <label class="font-semibold leading-none">Name</label>
                          <input name="name" type="text" value="{{$user->name}}" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" required/>
                      </div>
                      <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                          <label class="font-semibold leading-none">Email</label>
                          <input name="email" type="text" value="{{$user->email}}" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" required/>
                      </div>
                  </div>
                  <div class="md:flex items-center mt-12">
                    <div class="w-full md:w-1/2 flex flex-col">
                        <label class="font-semibold leading-none">Gaji</label>
                        <input name="gaji" type="text" value="{{$user->salary->gaji}}" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" required/>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col md:ml-6 md:mt-0 mt-4">
                        <label class="font-semibold leading-none">Pajak %</label>
                        <input name="pajak" type="text" value="{{$user->salary->pajak}}" class="leading-none text-gray-900 p-3 focus:outline-none focus:border-blue-700 mt-4 bg-gray-100 border rounded border-gray-200" required/>
                    </div>
                </div>
            
                  <div class="flex items-center justify-center w-full">
                      <button class="mt-9 font-semibold leading-none text-white py-4 px-10 bg-blue-700 rounded hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-700 focus:outline-none">
                          Save
                      </button>
                  </div>
              </form>
              </div>
          </div>
      </div>
  </div>
</x-app-layout>
