@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{$loop -> index + 1}}</th>
                        <td>{{$user -> name}}</td>
                        <td>{{$user -> email}}</td>
                        <td>{{$user -> getRoleNames() -> first()}}</td>
                        @can('manageUsers')
                            <td>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#updateUserModal{{$user->id}}">
                                    Edit
                                </button>
                                <!-- The Modal -->
                                <div class="modal fade" id="updateUserModal{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update User</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal">&times;
                                                </button>
                                            </div>

                                            <!-- Modal Body with Form -->
                                            <div class="modal-body">
                                                <form action="/users/{{$user -> id}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="user-name">Name:</label>
                                                        <input type="text" class="form-control" id="user-name"
                                                               name="name" value="{{$user->name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="user-email">Email:</label>
                                                        <input type="email" class="form-control" id="user-email"
                                                               name="email" value="{{$user->email}}">
                                                    </div>
                                                    <!-- Modal Footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Update</button>
                                                        <button type="button" class="btn btn-danger"
                                                                data-bs-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="/users/{{ $user->id }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
            @can('manageUsers')
                <div>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                        Add
                    </button>

                    <!-- The Modal -->
                    <div class="modal fade" id="addUserModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add User</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal Body with Form -->
                                <div class="modal-body">
                                    <form action="/users" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="user-name">Name:</label>
                                            <input type="text" class="form-control" id="user-name" name="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="user-email">Email:</label>
                                            <input type="email" class="form-control" id="user-email" name="email">
                                        </div>

                                        <!-- Modal Footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Add</button>
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close
                                            </button>
                                        </div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
