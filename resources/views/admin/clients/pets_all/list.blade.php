@extends('admin.layout.main')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> All Pets</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <caption>List of pets</caption>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Weight</th>
                        <th scope="col">Breed</th>
                        <th scope="col">Age</th>
                        <th scope="col">Spayed</th>
                        <th scope="col">Full Record</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Dog</td>
                        <td>Barks a lot</td>
                        <td>10</td>
                        <td>Terrier</td>
                        <td>7</td>
                        <td>No</td>
                        <td><a href="#">More info</a></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Cat</td>
                        <td>Likes to cuddle</td>
                        <td>6</td>
                        <td>Persian</td>
                        <td>5</td>
                        <td>Yes</td>
                        <td><a href="#">More info</a></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>Parrot</td>
                        <td>Likes to talk</td>
                        <td>3</td>
                        <td>German Shepard</td>
                        <td>3</td>
                        <td>No</td>
                        <td><a href="#">More info</a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>
    {{--<div class="row">
        <div class="col-lg-8">
            <!-- Example Bar Chart Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-bar-chart"></i> Bar Chart Example</div>
                <div class="card-body">
                    <canvas id="myBarChart" width="100" height="50"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- Example Pie Chart Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-pie-chart"></i> Pie Chart Example</div>
                <div class="card-body">
                    <canvas id="myPieChart" width="100%" height="100"></canvas>
                </div>
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div>
        </div>
    </div>--}}
@endsection