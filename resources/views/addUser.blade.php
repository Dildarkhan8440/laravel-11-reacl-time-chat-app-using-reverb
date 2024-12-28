<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{'Add user' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{url('/user/add')}}">
                        @csrf
                        <div class="row">
                          <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter Name">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter Email">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="Enter Password">
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="col-md-6">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm" class="form-control" value="{{ old('confirm') }}" placeholder="Enter Confirm Password">
                            @error('confirm')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="col-md-6">
                            <label>Select Role</label>
                            <select class="form-control" name="role" value="{{ old('role') }}">
                                <option value=''>Select Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? "selected":"" }}>Admin</option>
                                <option value="user" {{ old('role') == 'user' ? "selected":"" }}>User</option>
                            </select>
                            @error('role')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                          </div>

                        </div>
                        <div class="text-lg-right">
                            <button class="btn btn-primary " type="submit">Submit</button>
                        </div>
                        <br>
                        @isset($success)
                        <div class="alert alert-success" role="alert">
                            {{$success}}
                          </div>
                          @endisset
                        
                      </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
