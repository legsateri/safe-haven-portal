@extends('layouts.user-main')

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fa fa-area-chart"></i> My Account</div>
        
        <div class="card-body">
            <!-- Update user's info -->
            <form method="post" action="{{ route('user.account.update.info') }}" style="margin: 5px 30px">
                {{ csrf_field() }}
    
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="first-name">First name</label>
                        <input  type="text" class="form-control"
                                id="first-name" name="first_name"
                                placeholder="Enter first name" value="{{ $currentUser->first_name }}"
                                required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="last-name">Last name</label>
                        <input  type="text" class="form-control"
                                id="last-name" name="last_name"
                                placeholder="Enter last name" value="{{ $currentUser->last_name }}"
                                required>
                    </div>
                </div>
                    
                <div class="form-row">

                    <div class="col-md-6 mb-3">
                        <label for="email">Email address</label>
                        <input  type="email" class="form-control"
                                id="email" name="email"
                                placeholder="email@example.com" value="{{ $currentUser->email }}">
                    </div>
                        
                    <div class="col-md-6 mb-3">
                        <label for="phone">State</label>
                            <input type="text" class="form-control"
                            id="phone" name="phone"
                            placeholder="XXXXXXXXXX"
                            required>
                    </div>
                        
                    <div class="col-md-3 mb-3">
                        <label for="validationDefault05">Zip</label>
                            <input type="text" class="form-control" id="validationDefault05" placeholder="Zip" required>
                    </div>
                </div>
                    
                <button class="btn btn-primary" type="submit">Submit form</button>
            </form>
    
        </div>
        
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
    </div>

    <div class="row">
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
    </div>
@endsection