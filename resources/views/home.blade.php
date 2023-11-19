@extends('layouts.app')

@section('content')
<div class="container">
        <div class="text-center">
            <h2>
                Welcome to Laravel CRM
            </h2>
        </div>
            <div class="d-flex justify-content-center ">
                <div class="card" style="width: 18rem;">
                    <div class="card-header bg-secondary text-center" style="font-size: 1.3rem; font-weight: bold">
                        Admin Panel
                    </div>
                <ul class="list-group list-group-flush">
                    <a href="/companies" style="font-size: 1.2rem"><li class="list-group-item">Companies</li></a>
                    <a href="/clients" style="font-size: 1.2rem"><li class="list-group-item">Clients</li></a>
                    @can('manageUsers')
                    <a href="/users" style="font-size: 1.2rem"><li class="list-group-item">Users</li></a>
                    @endcan
                </ul>
            </div>
        </div>
</div>
@endsection
