@extends('back.layout.template')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.bootstrap5.css">
@endpush

@section('title', 'List Articles - Admin')

@section('content')
    {{-- main --}}
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Article</h1>
        </div>

        <div class="mt-3">
            <a href="{{ url('article/create') }}" class="btn btn-primary mb-2">Create</a>
 
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

            {{-- Success Alert --}}
            <div class="swal" data-swal="{{ session('success') }}"></div>
            
            <table id="dataTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Views</th>
                        <th>Status</th>
                        <th>Publish Date</th>
                        <th>Function</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </main>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    

    {{-- ALert --}}
    <script>
        const swal = $('.swal').data('swal');

        if (swal) {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: swal,
                showConfirmButton: false,
                timer: 1500
            });
        }
        
        function deleteArticle(e){
            let id = e.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "DELETE",
                        url: '/article/' + id,
                        dataType: "json",
                        success: function(response) {
                            Swal.fire(
                                title = 'Deleted!',
                                text = response.message,
                                icon = 'success',
                            ).then(() => {
                                window.location.href = '/article';
                            });
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            })
        }
    </script>
    {{-- DataTable --}}
    <script>
        new DataTable('#dataTable', {
            processing: true,
            serverside: true,
            ajax: '{{ url()->current() }}',
            columns: [
            {   
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
            },
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'category_id',
                name: 'category_id'
            },
            {
                data: 'views',
                name: 'views'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'publish_date',
                name: 'publish_date'
            },
            {
                 data: 'button',
                 name: 'button'
            },
            ]
        });
    </script>
@endpush