@extends('Admin.Layouts.main')

@section('container')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Daftar Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/dashboard" style="color: #262D31" >Dashboard</a></li>
                <li class="breadcrumb-item active">Daftar Users</li>
                </ol>
            </div>
        </div>
    </div>
</section>
    
<!-- Main content -->
<section class="content">
{{-- TABELLLLLL --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                        @if (session()->has('success'))
                            <div class="card-body">
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif  
                        </div>
                        
                        <div class="card-body">
                            <a href="/dashboard/users/create" class="btn btn-primary mb-3"><span data-feather="plus-circle"></span> Tambah User Baru</a>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Is Admin?</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>
                                            @if ($user->is_admin == true)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <center>
                                            {{--Edit --}}
                                            <a href="/dashboard/users/{{ $user->id }}/edit" class="btn btn-sm bg-warning" style="text-decoration:none">Edit</a>
                                            {{-- Menghapus detail Post --}}
                                            <form action="/dashboard/users/{{ $user->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-sm bg-danger border-0" onclick="return confirm('Are You Sure?')">Delete</button>
                                            </form>
                                            </center>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection