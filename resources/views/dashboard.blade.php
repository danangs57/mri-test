<x-app-layout>
    <style>
        <style>
		.animated {
			-webkit-animation-duration: 1s;
			animation-duration: 1s;
			-webkit-animation-fill-mode: both;
			animation-fill-mode: both;
		}

		.animated.faster {
			-webkit-animation-duration: 500ms;
			animation-duration: 500ms;
		}

		.fadeIn {
			-webkit-animation-name: fadeIn;
			animation-name: fadeIn;
		}

		.fadeOut {
			-webkit-animation-name: fadeOut;
			animation-name: fadeOut;
		}

		@keyframes fadeIn {
			from {
				opacity: 0;
			}

			to {
				opacity: 1;
			}
		}

		@keyframes fadeOut {
			from {
				opacity: 1;
			}

			to {
				opacity: 0;
			}
		}
	</style>
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{Auth::user()->role->name ?? ''}}
        </h2>
       
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between">
                <div>

                    <h2>Books</h2>
                </div>
                <div>
                    @if (Auth::user()->role->name == 'Admin')
                        <button  onclick="openModal()"  class="bg-blue-300 text-black font-bold py-2 px-4 border-b-4 border-blue-dark rounded-full">
                            Create +
                        </button>
                      @endif
               
                </div>
             
            </div>
            {{-- //modal. --}}
            <div class="main-modal fixed w-full h-100 inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster"
                style="background: rgba(0,0,0,.7);">
                <div
                    class="border border-teal-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                        <!--Title-->
                        <div class="flex justify-between items-center pb-3">

                            
                            <p class="text-2xl font-bold">Create Book</p>
                            <div class="modal-close cursor-pointer z-50">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 18 18">
                                    <path
                                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <!--Body-->
                        <div class="my-5">
                            <form action="{{route('book.store')}}" method="POST" id="add_caretaker_form"  class="w-full">
                                @csrf
                                <div class="">
                                    <div class="">
                                        <label for="title" class="text-md text-gray-600">Title</label>
                                        <input type="text" id="title" autocomplete="off" name="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Book's Title" required>
                                    </div>
                                    <div class="">
                                        <label for="author" class="text-md text-gray-600">Author</label>
                                        {{-- <select name="author_id" id="author" class="h-3 p-6 w-full border-2 border-gray-300 mb-5 rounded-md" required>
                                                @foreach ($authors as $author)
                                                    <option value="{{$author->id}}">{{$author->name}}</option>
                                                @endforeach
                                        </select> --}}
                                        <select name="author_id" required class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            @foreach ($authors as $author)
                                            <option value="{{$author->id}}">{{$author->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                   
                                </div>
                                <!--Footer-->
                                <div class="flex justify-end pt-2">
                                    <button
                                        class="focus:outline-none modal-close px-4 bg-gray-400 p-3 rounded-md text-black hover:bg-gray-300">Cancel</button>
                                    <button type="submit"
                                        class="focus:outline-none px-4 bg-green-400 p-3 ml-3 rounded-md text-black hover:bg-teal-400">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                      <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                          <th class="px-4 py-3">#</th>
                          <th class="px-4 py-3">Name</th>
                          <th class="px-4 py-3">Published</th>
                          <th class="px-4 py-3">Action</th>
                        </tr>
                      </thead>
                      <tbody class="bg-white">
                          
                          @foreach ($books as $index => $book)
                          <tr class="text-gray-700">
                            <td class="px-4 py-3 border text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> {{$index+1}} </span>
                              </td>
                          <td class="px-4 py-3 border">
                            <div class="flex items-center text-sm">
                              <div class="relative w-8 h-8 mr-3 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                  </svg>
                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                              </div>
                              <div>
                                <p class="font-semibold capitalize tracking-widest">{{$book->title}}</p>
                                <p class="text-xs text-gray-600"> By <span class="font-bold italic"> {{$book->author->name}}</span></p>
                              </div>
                            </div>
                          </td>
                          <td class="px-4 py-3 border text-md font-semibold">{{$book->created_at->format('d/m/y')}}</td>
                         
                          <td class="px-4 py-3 border text-sm">

                            @if (Auth::user()->role->name == 'Admin')
                            <a href="{{route('book.edit',$book->id)}}" class="bg-yellow-300 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded-t-lg">Edit</a>

                            <form class="inline" method="post" action="{{route('book.delete',$book->id)}}">
                                @csrf @method('delete')

                                <button type="submit" class="bg-red-300 hover:bg-red-700 text-white font-bold py-1 px-2 rounded-t-lg">Delete</button>
                            </form>
                          @endif
                            
                          </td>
                        </tr>
                          @endforeach
                    
                      </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
    <script>
		const modal = document.querySelector('.main-modal');
		const closeButton = document.querySelectorAll('.modal-close');

		const modalClose = () => {
			modal.classList.remove('fadeIn');
			modal.classList.add('fadeOut');
			setTimeout(() => {
				modal.style.display = 'none';
			}, 500);
		}

		const openModal = () => {
			modal.classList.remove('fadeOut');
			modal.classList.add('fadeIn');
			modal.style.display = 'flex';
		}

		for (let i = 0; i < closeButton.length; i++) {

			const elements = closeButton[i];

			elements.onclick = (e) => modalClose();

			modal.style.display = 'none';

			window.onclick = function (event) {
				if (event.target == modal) modalClose();
			}
		}
	</script>
</x-app-layout>
