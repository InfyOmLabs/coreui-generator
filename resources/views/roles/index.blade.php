@extends('layouts.app')
@section('title')
    Roles
@endsection
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Roles</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            @include('flash::message')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>
                            Roles
                            <a class="btn btn-primary pull-right" style="margin-top: 0px;margin-bottom: 5px"
                               href="{!! route('roles.create') !!}">Add New</a>
                        </div>
                        <div class="card-body">
                            @include('roles.table')
                            <div class="pull-right mr-3">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
      $(function () {
        $('#role_table').DataTable({
          processing: true,
          serverSide: true,
          'order': [[0, 'desc']],
          ajax: {
            url: '{!! url(route('roles.index'))  !!}',
          },
          columnDefs: [
            {
              'targets': [2],
              'orderable': false,
              'className': 'text-center',
              'width': '5%',
            },
          ],
          columns: [
            {
              data: 'name',
              name: 'name',
            },
            {
              data: 'description',
              name: 'description',
            },
            {
              data: function (row) {
                return '<a title="Edit" class="btn action-btn btn-primary btn-sm edit-btn mr-1" href="{{url('/roles')}}/' +
                  row.id + '/edit" >' +
                  '<i class="fa fa-pencil" style="font-size:15px;color:white"></i>' + '</a>' +
                  '<a title="Delete" class="btn action-btn btn-danger btn-sm delete-btn" data-id="' +
                  row.id + '">' +
                  '<i class="fa fa-trash-o" style="font-size:15px;color:white"></i></a>'
              }, name: 'id',
            },
          ],
        })
      })

      // open delete confirmation model
      $(document).on('click', '.delete-btn', function (event) {
        let roleId = $(event.currentTarget).data('id')
        deleteItem('{{url('roles')}}/' + roleId, '#role_table', 'Role')
      })
    </script>
@endsection

