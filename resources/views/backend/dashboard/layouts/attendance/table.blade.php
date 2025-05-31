@extends('backend.dashboard.app')

@section('content')
<div class="container">
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif



    <h1>Attendance List</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Date</th>
                <th scope="col">Day</th>
                <th scope="col">Check-In Time</th>
                <th scope="col">Check-Out Time</th>
                <th scope="col">Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->date }}</td>
                    <td>{{ $attendance->day }}</td>
                    <td>{{ $attendance->check_in_time }}</td>
                    <td>{{ $attendance->check_out_time }}</td>
                    <td>{{ $attendance->duration }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
