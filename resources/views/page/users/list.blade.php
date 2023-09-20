@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">

                    <section class="content">
                        <div class="container-fluid">
                            <!-- SELECT2 EXAMPLE -->


                            <div class="card row card-default">
                                <div class="card-header">
                                    <div class="row">
                                        <a href="{{ route('users.create') }}" class="btn bg-gradient-success  btn-sm">Add User</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">@include('layouts.flash-message')</div>
                                    </div>
                                    <table class="table table-bordered table-hover dataTable" id="optutility_list">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th >Pemission</th>
                                           <th></th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->level }}</td>
                                                 <td><a href="{{ route('users.edit', $user->id) }}" class="btn-xs bg-gradient-warning">Edit</a></td>
                                                     <td>
                                                        <a href="{{ route('users.destroy', $user->id) }}" class="btn-xs bg-gradient-danger" data-toggle="modal" data-target="#konfirmasiHapus">Hapus</a>

                                                        {{-- <a href="{{ route('users.destroy', $user->id) }}" class="btn-xs bg-gradient-danger">Delete </a> --}}
                                                    </td>


                                            </tr>

                                        @endforeach
                                    </table>
                                </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Popup Konfirmasi Hapus -->
<div class="modal fade" id="konfirmasiHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pengguna ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

    <script>
        $(document).ready(function(){

            // $('#optutility_list').dataTable();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });


        });


    </script>
@endsection

