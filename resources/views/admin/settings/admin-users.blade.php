<?php
/**
 * page for displaying list of admin users
 */
?>
@extends('admin.layout.main')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <i class="fa fa-area-chart"></i> Admin Users
                </div>
                <div class="col-lg-6 col-md-6">
                    <a  href="{{ route('admin.settings.admin-user.add') }}"
                        class="btn_add_new_admin_user btn btn-primary"
                        style="float:right"
                        >Add new admin user</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            

            
            <?php
                // defines row counter for results in table
                $counter = 1;
                if (  isset($_GET['page']))
                {
                    if ( is_numeric($_GET['page']) && (int)$_GET['page'] > 0 )
                    {
                        $pageNo = (int)$_GET['page'];
                        $counter = ($pageNo - 1) * 10 + 1; 
                    }
                }
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $admins as $admin )
                            <tr>
                                <th scope="row">{{ $counter }}</th>
                                <td><a href="{{ route('admin.settings.admin-user.single', ['id' => $admin->id]) }}">{{ $admin->name }}</a></td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    @if( $admin->active == 1 )
                                        <span style="color:green">Yes</span>
                                    @else
                                        <span style="color:red">No</span>
                                    @endif
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <nav>
                {{ $admins->links() }}
            </nav>

        </div>
    </div>
@endsection