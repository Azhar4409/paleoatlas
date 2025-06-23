@extends('back.layout.template')

@section('title', 'List Users - Admin')

@section('content')
    {{-- main --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users</h1>
        </div>

        <div class="mt-3">
            <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalCreate">Register</button>
 
            @if ($errors->any())
                <div class="my-3">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @if (session('success'))
                <div class="my-3">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
                
            @endif
            
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created At</th>
                        <th>Role</th>
                        <th>Function</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if ($item->role === 1)
                                    <span class="badge bg-danger">Admin</span>
                                @elseif ($item->role === 0)
                                    <span class="badge bg-primary">Member</span>
                                @else
                                    <span class="badge bg-secondary">Unknown</span>
                                @endif
                            </td>
                            <td>
                                <div class="text-center">
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalUpdate{{ $item->id }}">Edit</button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{ $item->id }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Modal Create -->
        @include('back.user.create-modal')

        <!-- Modal Update -->
        @include('back.user.update-modal')
        
        <!-- Modal Delete -->
        @include('back.user.delete-modal')
    </main>
@endsection