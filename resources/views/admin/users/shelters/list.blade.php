@extends('admin.layout.main')

@section('content')
<div class="card mb-3">
<div class="card-header">
    <i class="fa fa-area-chart"></i> Shelter Users</div>
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
                    <th scope="col">Banned</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $user )
                    <tr>
                        <th scope="row">{{ $counter }}</th>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="">{{ $user->organisation_name }}</a></td>
                        <td>
                            @if ( $user->verified == 1 )
                                Yes 
                            @else
                                No 
                            @endif
                        </td>
                        <td>
                            @if ( $user->banned == 1 )
                                Yes 
                            @else
                                No 
                            @endif
                            </td>
                        <td><a href="{{ route('admin.user.edit.page', ['id'=> $user->id, 'slug'=> $user->slug]) }}">edit user</a></td>
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