@extends('layouts.app')
@section('title')
    Users
@endsection
@section('content')
    <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="{!! route('users.index') !!}">User</a>
          </li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    <div class="container-fluid">
         <div class="animated fadeIn">
             @include('coreui-templates::common.errors')
             <div class="row">
                 <div class="col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <i class="fa fa-edit fa-lg"></i>
                              <strong>Edit User</strong>
                          </div>
                          <div class="card-body">
                              {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch','files'=>true]) !!}

                              @include('users.edit_fields')

                              {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
         </div>
    </div>
@endsection