@extends('admin.layout.main')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> Admin Users</div>
        <div class="card-body">
            

            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $admins as $admin )
                            <tr>
                                <th scope="row">1</th>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td><a href="{{ route('admin.settings.admin-user.single', ['id' => $admin->id]) }}">edit user</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>




        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
@endsection