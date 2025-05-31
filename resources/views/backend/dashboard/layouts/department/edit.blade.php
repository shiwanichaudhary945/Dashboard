@extends("backend.dashboard.layouts.app")

@section("content")
<div class="container mt-5">
    @if(Session::has("success"))
        <div class="alert alert-success">
            {{ Session::get("success") }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #6c757d; color: #fff;">
                    <h3 class="mb-0">Edit Department</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('departments.update', $department->id) }}">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="department_id" value="{{ $department->id }}">

                        <div class="mb-3">
                            <label for="name" class="form-label">Department Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Department Name" required value="{{ $department->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="managerName" class="form-label">Manager Name</label>
                            <input type="text" class="form-control" id="managerName" name="managerName" placeholder="Enter Manager Name" required value="{{ $department->managerName }}">
                        </div>

{{--

                        <div class="mb-3">
                            <label for="branch_id" class="form-label">Branch</label>
                            <select class="form-control" id="branch_id" name="branch_id" required>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ $department->branch_id == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div> --}}

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-secondary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
