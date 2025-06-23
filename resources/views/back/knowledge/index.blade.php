@extends('back.layout.template')

@section('title', 'Knowledge List')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Knowledge</h1>
        </div>

        <div class="mt-3">
            <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalCreateKnowledge">Create</button>

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
                        <th>Content</th>
                        <th>Created At</th>
                        <th>Function</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($knowledges as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->content }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <div class="text-center">
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdateKnowledge{{ $item->id }}" title="Edit">
                                        ✏️
                                    </button>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDeleteKnowledge{{ $item->id }}" title="Delete">
                                        🗑️
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modal Create -->
        @include('back.knowledge.create-modal')

        <!-- Modal Update -->
        @include('back.knowledge.update-modal')

        <!-- Modal Delete -->
        @include('back.knowledge.delete-modal')
    </main>
@endsection