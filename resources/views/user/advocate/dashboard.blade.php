@extends('layouts.user-main')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-fw fa-dashboard"></i> Dashboard</div>
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
                            <th scope="col">Organisation</th>
                            <th scope="col">Created at</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($data['applications'] as $application)
                        <tr>
                            <th scope="row">{{ $counter }}</th>
                            <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                            <td>{{ $application->email }}</td>
                            <td>{{ $application->org_name }}</td>
                            <td>{{ $application->created_at }}</td>
                            <td></td>
                        </tr>
                            <?php $counter++; ?>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <!--Pie Chart Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-pie-chart"></i> Chart of resolutions - released pets </div>
                        <div class="card-body">
                            @if ($data['total_released_client']!=0) 
                                <canvas id="myPieChart" width="200px%" height="100"></canvas>
                            @else 
                                There are no released clients yet.
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

@endsection

@section('pageJS')
    <script src="{{url('/')}}/js/Chart.min.js"></script>

    @if ($data['total_released_client']!=0)
    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif', Chart.defaults.global.defaultFontColor = "#292b2c";
        ctx = document.getElementById("myPieChart"),
            myPieChart = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: ["Clients completed", "Client Chose Not to Proceed", "Service no longer needed"],
                    datasets: [{
                        data: [ {{ round (($data['completed']*100 / $data['total_released_client']),2) }},
                                {{ round (($data['not_provided']*100 /  $data['total_released_client']),2) }},
                                {{ round (($data['no_longer_needed']*100 / $data['total_released_client']),2) }}],
                        backgroundColor: ["#007bff", "#dc3545", "#ffc107"]
                    }]
                }
            });
        console.log('completed = ' +{{ $data['completed']}});
        console.log('not_provided = ' + {{$data['not_provided']}});
        console.log('no_longer_needed = ' + {{$data['no_longer_needed']}});
        console.log('total = ' + {{$data['total_released_client']}});
    </script>
    @endif
    
@endsection