@extends('admin.layout.main')

@section('content')
<div class="card mb-3">
<div class="card-header">
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <i class="fa fa-area-chart"></i> Advocate Users
        </div>
        <div class="col-lg-6 col-md-6">
            <a  href="{{ route('admin.users.user_add.list') }}"
                class="btn_add_new_user btn btn-primary"
                style="float:right;"
                >Add new user</a>
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
                    <th scope="col">Organization</th>
                    <th scope="col">Verified</th>
                    <th scope="col">Suspended</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $user )
                    <tr>
                        <th scope="row">{{ $counter }}</th>
                        <td><a href="{{ route('admin.user.edit.general.page', ['id'=> $user->id, 'slug'=> $user->slug]) }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
                        <td>{{ $user->email }}</td>
                        @if( $user->organisation_name != null )
                            <td><a href="{{ route('admin.organisation.edit.general.page', ['id' => $user->organisation_id, 'slug' => $user->organisation_slug]) }}">{{ $user->organisation_name }}</a></td>
                        @else
                            <td></td>
                        @endif
                        <td>
                            @if ( $user->verified == 1 )
                                <span style="color:green">Yes</span>
                            @else
                                <span style="color:red">No</span>
                            @endif
                        </td>
                        <td>
                            @if ( $user->banned == 1 )
                                <span style="color:red">Yes</span>
                            @else
                                <span style="color:green">No</span>
                            @endif
                        </td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
            </tbody>
        </table>
    </div>

    <nav>
        {{ $users->links() }}
    </nav>

</div>
<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
</div>
@endsection