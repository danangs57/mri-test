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

                    <h2>Daftar Karyawan</h2>
                </div>
                <div>
                 
               
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
                       
                    </div>
                </div>
            </div>
          
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
               
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto overflow-y-auto">
                    <table class="w-full">
                      <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                          <th class="px-4 py-3">Name</th>
                          <th class="px-4 py-3">Position</th>
                          <th class="px-4 py-3">Base Salary</th>
                          <th class="px-4 py-3">PPH21/Tahun</th>
                          <th class="px-4 py-3">Neto/Bulan</th>

                          @if (in_array(auth()->user()->role->name, ['Admin','Finance']))
                          
                          <th class="px-4 py-3">Action</th>
                          @else
                          <th></th>
                          @endif
                        </tr>
                      </thead>
                      <tbody class="bg-white">
                          
                          @foreach ($users as $index => $user)
                          <tr class="text-gray-700">
                            <td class="px-4 py-3 border text-xs">
                                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-sm"> {{$user->name}} </span>
                              </td>
                       
                          <td class="px-4 py-3 border text-md font-semibold">{{$user->position->name ?? '-'}}</td>
                          <td class="px-4 py-3 border text-md font-semibold">Rp.{{number_format($user->salary->gaji) ?? '-'}}</td>
                          <td class="px-4 py-3 border text-md font-semibold">{{$user->salary->pajak ?? '-'}}%</td>
                          <td class="px-4 py-3 border text-md font-semibold">Rp.{{ number_format($user->salary->gaji - ( $user->salary->gaji * ($user->salary->pajak/12) / 100  ))}}</td>

                          @if (in_array(auth()->user()->role->name, ['Admin','Finance']))
                          
                          <td class="px-4 py-3 border text-md font-semibold ">
                            <a href="{{route('user.edit',$user->id)}}" class="bg-transparent hover:bg-yellow-500 text-yellow-700 font-semibold hover:text-white py-2 px-2 border border-yellow-500 hover:border-transparent rounded">Edit</a>
                          </td>
                          @else
                          <td></td>
                          @endif
                         
  
                        </tr>
                          @endforeach
                    
                      </tbody>
                    </table>
                  </div>
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
