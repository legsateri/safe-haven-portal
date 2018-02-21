@extends('admin.layout.main')

@section('content')
<div class="card mb-3">
<div class="card-header">
    <i class="fa fa-area-chart"></i> 
    {{ $type->label }} Organizations
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
                    <th scope="col">Code</th>
                    <th scope="col">Tax ID</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $organisations as $organisation )
                    <tr>
                        <th scope="row">{{ $counter }}</th>
                        <td><a href="{{ route('admin.organisation.edit.general.page', ['id'=> $organisation->id, 'slug'=> $organisation->slug]) }}">{{ $organisation->name }}</a></td>
                        <td>{{ $organisation->email }}</td>
                        <td>{{ $organisation->code }}</td>
                        <td>{{ $organisation->tax_id }}</td>
                    </tr>
                    <?php $counter++; ?>
                @endforeach
            </tbody>
        </table>
    </div>

    <nav>
        {{ $organisations->links() }}
    </nav>

</div>
<!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
</div>
@endsection