<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Users' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-lg-right">
                        <a name="" id="" class="btn btn-primary" href="{{url('/user/add')}}" role="button">Add User</a>
                    </div>
                    <br>
                    <table class="table table-border">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Created AT</th>
                            <th scope="col">Updated AT</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            @foreach ($user_list as $item )
                            <tr>
                                <th scope="row">{{$i++;}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->role}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <a name="" id="" class="btn btn-primary" href="/user/edit/{{$item->id}}" role="button">Edit</a>
                                    <a name="" id="" class="btn btn-danger" href="/user/delete/{{$item->id}}" role="button">Delete</a>
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
