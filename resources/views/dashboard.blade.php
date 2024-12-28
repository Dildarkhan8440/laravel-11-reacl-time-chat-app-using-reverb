<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">

                <div class="avatar text-center"></div>
                <div class="card-deck col-md-12 row ">
                    @foreach ($user_list as $item )
                    <div class="border m-3">
                        <img src="images.jpg" class="img-thumbnail" alt="..." style="border-radius: 100%;">
                        <p class='text-center'>{{$item->name}} :  <a href='/chatbox/{{$item->id}}' class="btn btn-success">Message</a></p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
