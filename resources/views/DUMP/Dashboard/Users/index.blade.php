@extends('Dashboard.Layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Daftar Users</h1>
</div>

@if (session()->has('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="table-responsive col-lg-9">
    {{-- Buat User Baru --}}
    <a href="/dashboard/users/create" class="btn btn-primary mb-3"><span data-feather="plus-circle"></span> Tambah User Baru</a>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Is Admin?</th>
                <th scope="col">Email</th>
                <th scope="col">Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>               
                    <th> {{ $loop->iteration }} </th>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->username }} </td>
                    <td> 
                        @if ($user->is_admin == true)
                            Yes
                        @else
                            No
                        @endif
                    </td>
                    <td> {{ $user->email }} </td>
                    <td> 
                        {{-- View
                        <a href="/dashboard/users/{{ $user->id }}" class="badge bg-info"><span data-feather="eye"></span></a> --}}
                        {{--Edit --}}
                        <a href="/dashboard/users/{{ $user->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                        {{-- Menghapus detail Post --}}
                        <form action="/dashboard/users/{{ $user->id }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are You Sure?')"><span data-feather="x-circle"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
