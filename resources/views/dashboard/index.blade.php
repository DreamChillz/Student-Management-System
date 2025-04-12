@extends('app')

@section('title', 'Dashboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <h2 class="greeting">Hello, Tan Jun Eng</h2>
        <div class="container">
            <h2>Home</h2>
            <div class="summary-cards">
                <div class="card">
                    <span class="stat">11</span>
                    <span class="stat-label">Total Students</span>
                </div>
                <div class="card">
                    <span class="stat">11</span>
                    <span class="stat-label">Total Courses</span>
                </div>
                <div class="card">
                    <span class="stat">11</span>
                    <span class="stat-label">Top Scoring Course</span>
                </div>
            </div>
        </div>

        <div class="container">
            <h2>Reports</h2>
            <div class="report-cards">
                <div class="report">
                    <div class="report-header">
                        <span>Average Marks per Student</span>
                        <i class="fa-regular fa-clipboard"></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Total Courses</th>
                                <th>Average Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Estelle Bright</td>
                                <td>3</td>
                                <td>60.7</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Estelle Bright</td>
                                <td>3</td>
                                <td>60.7</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Estelle Bright</td>
                                <td>3</td>
                                <td>60.7</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Estelle Bright</td>
                                <td>3</td>
                                <td>60.7</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="report">
                    <div class="report-header">
                        <span>Average Marks per Course</span>
                        <i class="fa-regular fa-clipboard"></i>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Course ID</th>
                                <th>Name</th>
                                <th>Total Students</th>
                                <th>Average Mark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Estelle Bright</td>
                                <td>3</td>
                                <td>60.7</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Estelle Bright</td>
                                <td>3</td>
                                <td>60.7</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Estelle Bright</td>
                                <td>3</td>
                                <td>60.7</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>Estelle Bright</td>
                                <td>3</td>
                                <td>60.7</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
