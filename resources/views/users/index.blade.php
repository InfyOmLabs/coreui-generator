@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Users</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Users
                            <a class="btn btn-primary pull-right" style="margin-top: 0px;margin-bottom: 5px"
                               href="{!! route('users.create') !!}">Add New</a>
                        </div>
                        <div class="card-body">
                            @include('users.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script>
      let userUrl = '{{url('users')}}/'
    </script>
    <script src="{{ asset('js/users/user.js') }}"></script>
@endsection

