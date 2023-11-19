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
                    <th scope="col">EID</th>
                    <th scope="col">Clients</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <th scope="row">{{$loop -> index + 1}}</th>
                        <td>{{$company -> name}}</td>
                        <td>{{$company -> email}}</td>
                        <td>{{$company -> number}}</td>
                        <td>{{$company -> address}}</td>
                        <td>{{$company -> industry}}</td>
                        <td>{{$company -> eid}}</td>
                        <td>
                            @foreach($company -> clients as $client)
                            {{$client -> name}}
                            @endforeach
                        </td>

                        @can('manageClients')
                            <td>
                                <!-- Button to Open the Modal -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#updateCompanyModal{{$company->id}}">
                                    Edit
                                </button>
                                <!-- The Modal -->
                                <div class="modal fade" id="updateCompanyModal{{$company->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Update Company</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal">&times;
                                                </button>
                                            </div>

                                            <!-- Modal Body with Form -->
                                            <div class="modal-body">
                                                <form action="/companies/{{$company -> id}}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="company-name">Name:</label>
                                                        <input type="text" class="form-control" id="company-name"
                                                               name="name" value="{{$company->name}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-email">Email:</label>
                                                        <input type="email" class="form-control" id="company-email"
                                                               name="email" value="{{$company->email}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-number">Number:</label>
                                                        <input type="text" class="form-control" id="company-number"
                                                               name="number" value="{{$company->number}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-address">Address:</label>
                                                        <input type="text" class="form-control" id="company-address"
                                                               name="address" value="{{$company->address}}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-industry">Industry:</label>
                                                        <input type="text" class="form-control" id="company-industry"
                                                               name="industry" value="{{$company->industry}}" required >
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="company-eid">EID:</label>
                                                        <input type="text" class="form-control" id="company-eid"
                                                               name="eid" value="{{$company->eid}}" required >
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

                                <form action="/companies/{{ $company->id }}" method="POST" style="display: inline-block">
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
                            data-bs-target="#addCompanyModal">
                        Add
                    </button>

                    <!-- The Modal -->
                    <div class="modal fade" id="addCompanyModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add Company</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal Body with Form -->
                                <div class="modal-body">
                                    <form action="/companies" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="company-name">Name:</label>
                                            <input type="text" class="form-control" id="company-name" name="name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-email">Email:</label>
                                            <input type="email" class="form-control" id="company-email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-number">Number:</label>
                                            <input type="text" class="form-control" id="company-number" name="number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-address">Address:</label>
                                            <input type="text" class="form-control" id="company-address" name="address" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-industry">Industry:</label>
                                            <input type="text" class="form-control" id="company-industry"
                                                   name="industry" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="company-eid">EID:</label>
                                            <input type="text" class="form-control" id="company-eid"
                                                   name="eid"  required>
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
