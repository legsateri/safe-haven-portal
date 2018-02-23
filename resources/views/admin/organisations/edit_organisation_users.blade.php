@extends('admin.layout.main')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card mb-3">
@include('admin.organisations.edit_organisation_header')
@include('admin.organisations.edit_organisation_submenu_partial')

<div class="card-body">



    <div class="row">
        <div class="form-group col-md-8 offset-md-2">   
            <h4>Organisation Users</h4>
            <hr> 
        </div>
    </div>

    <div class="row">

        <div class="form-group col-md-8 offset-md-2"> 
            @if( count($users) > 0 )
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Verified</th>
                            <th scope="col">Banned</th>
                            <th scope="col">Org. Admin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $user )
                            <tr>
                                <th scope="row">{{ $counter }}</th>
                                <td><a href="{{ route('admin.user.edit.general.page', ['id' => $user->id, 'slug' =>  $user->slug ]) }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if( $user->verified == 1 )
                                        <span style="color:green">Yes</span>
                                    @else
                                        <span style="color:red">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $user->banned == 1 )
                                        <span style="color:red">Yes</span>
                                    @else
                                        <span style="color:green">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if( $user->admin != null )
                                        <span style="color:green">Yes</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#removeModal_{{ $user->id }}">
                                        <span style="color:#ffffff;">x</span>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="removeModal_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="removeModal_{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Remove user from organization?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure that you want to remove <b>{{ $user->first_name }} {{ $user->last_name }}</b> from <b>{{ $organisation->name }}</b>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('admin.organisation.edit.submit.remove.user', ['id' => $organisation->id, 'slug' => $organisation->slug]) }}" method="post">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Remove</button>
                                                    </form>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php $counter++; ?>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>There are no users that belongs to this organization.</p>
            @endif

        </div>

        <nav>
            {{ $users->links() }}
        </nav>

    </div>





</div>
@endsection