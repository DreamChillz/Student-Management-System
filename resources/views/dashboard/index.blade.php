@extends('app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard">
    <h1>Welcome, Tan!</h1>

    <div class="stats my-4 d-flex justify-content-between">
        <!-- Example Stats Cards -->
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Total Students</h5>
                <p class="card-text">11</p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Total Courses</h5>
                <p class="card-text">11</p>
            </div>
        </div>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Top Scoring Course</h5>
                <p class="card-text">UI/UX Design</p>
            </div>
        </div>
    </div>

    <!-- Reports Section -->
    <h2>Reports</h2>
    <div class="row">
        <div class="col-md-6">
            <h3>Average Marks per Student</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Total Courses</th>
                        <th>Average Mark</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data, you will eventually loop through your report data -->
                    <tr>
                        <td>1</td>
                        <td>Estelle Bright</td>
                        <td>3</td>
                        <td>60.7</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h3>Average Marks per Course</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Total Students</th>
                        <th>Average Mark</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample data -->
                    <tr>
                        <td>1</td>
                        <td>Course Example</td>
                        <td>3</td>
                        <td>70.3</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection