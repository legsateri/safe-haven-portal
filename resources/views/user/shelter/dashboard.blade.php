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
                        <th scope="col">Type</th>
                        <th scope="col">Breed</th>
                        <th scope="col">Created at</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($data['applications'] as $application)
                    <tr>
                        <th scope="row">{{ $counter }}</th>
                        
                        <td> 
                        @foreach($data['pets'][$application->id] as $pet)
                        {{ $pet->name }}
                        @endforeach
                        </td>
                        
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
                        <i class="fa fa-pie-chart"></i> Chart of resolutions - released pets
                    </div>
                    <div class="card-body">
                        @if ($data['total_released_pets']!=0)
                            <canvas id="myPieChart" width="200px%" height="100"></canvas>
                        @else 
                            There are no released pets yet.
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
    
    @if ($data['total_released_pets']!=0)
    <script>
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif', Chart.defaults.global.defaultFontColor = "#292b2c";
        ctx = document.getElementById("myPieChart"),
            myPieChart = new Chart(ctx, {
                type: "pie",
                data: {
                    labels: ["Pets returned to owners", "Pets released to adoption pool", "Pets not served", "Pets not admitted"],
                    datasets: [{
                        data: [ {{ round (($data['pets_returned_to_owner']*100 / $data['total_released_pets']),2) }},
                                {{ round (($data['pet_released_to_adoption']*100 /  $data['total_released_pets']),2) }}, 
                                {{ round (($data['pet_not_served']*100 / $data['total_released_pets']),2) }}, 
                                {{ round (($data['pet_not_admitted']*100 / $data['total_released_pets']),2) }}],
                        backgroundColor: ["#007bff", "#dc3545", "#ffc107", "#28a745"]
                    }]
                }
            });
    </script>
    @endif
    
@endsection