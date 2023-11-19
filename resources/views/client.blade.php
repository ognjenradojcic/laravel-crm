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
                    <th scope="col">Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Industry</th>
                    <th scope="col">Company</th>
                </tr>
                </thead>
                <tbody>
                @foreach($clients as $client)
                    <tr>
                        <th scope="row">{{$loop -> index + 1}}</th>
                        <td>{{$client -> name}}</td>
                        <td>{{$client -> email}}</td>
                        <td>{{$client -> number}}</td>
                        <td>{{$client -> address}}</td>
                        <td>{{$client -> industry}}</td>
                        <td>{{$client -> company -> name}}</td>
                        @can('manageClients')
                            <td>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#updateClientModal{{$client->id}}">
                                    Edit
                                </button>
                                <!-- The Modal -->
                                <div class="modal fade" id="updateClientModal{{$client->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Client</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal">&times;
                                                </button>
                                            </div>

                                            <!-- Modal Body with Form -->
                                            <div class="modal-body">
                                                <form action="/clients/{{$client -> id}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="client-name">Name:</label>
                                                        <input type="text" class="form-control" id="client-name"
                                                               name="name" value="{{$client->name}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="client-email">Email:</label>
                                                        <input type="email" class="form-control" id="client-email"
                                                               name="email" value="{{$client->email}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="client-number">Number:</label>
                                                        <input type="text" class="form-control" id="client-number"
                                                               name="number" value="{{$client->number}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="client-address">Address:</label>
                                                        <input type="text" class="form-control" id="client-address"
                                                               name="address" value="{{$client->address}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="client-industry">Industry:</label>
                                                        <input type="text" class="form-control" id="client-industry"
                                                               name="industry" value="{{$client->industry}}" required >
                                                    </div>

                                                    <div class="form-group">
                                                        <label>
                                                            Company:
                                                        </label>
                                                        @foreach($companies as $company)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                       name="company_id" id="company_id"
                                                                       value="{{$company -> id}}"
                                                                @if($client -> company -> id == $company -> id)
                                                                    checked
                                                                @endif>
                                                                <label class="form-check-label" for="company_id">
                                                                    {{$company -> name}}
                                                                </label>
                                                            </div>
                                                        @endforeach
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

                                <form action="/clients/{{ $client->id }}" method="POST" style="display: inline-block">
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
            @can('manageClients')
                <div>
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#addClientModal">
                        Add
                    </button>

                    <!-- The Modal -->
                    <div class="modal fade" id="addClientModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Client</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal Body with Form -->
                                <div class="modal-body">
                                    <form action="/clients" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="client-name">Name:</label>
                                            <input type="text" class="form-control" id="client-name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="client-email">Email:</label>
                                            <input type="email" class="form-control" id="client-email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="client-number">Number:</label>
                                            <input type="text" class="form-control" id="client-number" name="number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="client-address">Address:</label>
                                            <input type="text" class="form-control" id="client-address" name="address" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="client-industry">Industry:</label>
                                            <input type="text" class="form-control" id="client-industry"
                                                   name="industry" required>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                Company:
                                            </label>
                                            @foreach($companies as $company)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="company_id"
                                                           id="company_id"
                                                           value="{{$company -> id}}">
                                                    <label class="form-check-label" for="company_id">
                                                        {{$company -> name}}
                                                    </label>
                                                </div>
                                            @endforeach
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
