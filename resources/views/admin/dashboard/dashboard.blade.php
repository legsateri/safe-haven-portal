@extends('admin.layout.main')

@section('content')
<div class="card mb-3">
    <div class="card-header">
        <i class="fa fa-fw fa-dashboard"></i> Dashboard</div>
    <div class="card-body">
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i>Unread applications
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
                                <th scope="col">Created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applications as $application)
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
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <!--Pie Chart Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-pie-chart"></i> Chart of resolutions - released pets </div>
                    <div class="card-body">
                        @if ($total_released_pets!=0)
                            <canvas id="myPieChart" width="200px%" height="100"></canvas>
                        @else
                            There are no released pets yet.
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <!--Pie Chart Card-->
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fa fa-pie-chart"></i> Chart of resolutions - released clients</div>
                    <div class="card-body">
                        @if ($total_released_client!=0)
                            <canvas id="myPieChartClient" width="200px%" height="100"></canvas>
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
    
    @if ($total_released_pets!=0)
    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif', Chart.defaults.global.defaultFontColor = "#292b2c";
        ctx = document.getElementById("myPieChart"),
            myPieChart = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: [" Pets returned to owners", "Pets released to adoption pool", "Client Chose Not to Proceed", "Pets not admitted"],
                    datasets: [{
                        data: [ {{ round (($pets_returned_to_owner*100 / $total_released_pets),2) }}, 
                                {{ round (($pet_released_to_adoption*100 /  $total_released_pets),2) }},
                                {{ round (($pet_not_served*100 / $total_released_pets),2) }},
                                {{ round (($pet_not_admitted*100 / $total_released_pets),2) }}],
                        backgroundColor: ["#007bff", "#dc3545", "#ffc107", "#28a745"]
                    }]
                }
            });
    </script>
    @endif

    @if ($total_released_client!=0)
    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif', Chart.defaults.global.defaultFontColor = "#292b2c";
        ctx = document.getElementById("myPieChartClient"),
            myPieChartClient = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: ["Clients completed", "Client Chose Not To Proceed", "Service no longer needed"],
                    datasets: [{
                        data: [ {{ round (($completed*100 / $total_released_client),2) }},
                                {{ round (($not_provided*100 /  $total_released_client),2) }},
                                {{ round (($no_longer_needed*100 / $total_released_client),2) }}],
                        backgroundColor: ["#007bff", "#dc3545", "#ffc107"]
                    }]
                }
            });
    </script>
    @endif
    
@endsection