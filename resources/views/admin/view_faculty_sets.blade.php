@extends('admin.layouts.admin')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">View Faculty Sets</h2>
                
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif

                <div class="panel panel-default">
                    <div class="panel-heading">Faculty Sets List</div>
                    <div class="panel-body">
                        <table id="faculty-sets-table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Faculty Name</th>
                                    <th>Subject</th>
                                    <th>Min Lectures</th>
                                    <th>Max Lectures</th>
                                    <th>Daily Lectures</th>
                                    <th>Total Lectures</th>
                                    <th>Room No</th>
                                    <th>Class Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facultySets as $set)
                                <tr>
                                    <td>{{ $set->faculty_name }}</td>
                                    <td>{{ $set->subject_name }}</td>
                                    <td>{{ $set->min_lec }}</td>
                                    <td>{{ $set->max_lec }}</td>
                                    <td>{{ $set->daily_lec }}</td>
                                    <td>{{ $set->total_lec }}</td>
                                    <td>{{ $set->roomno }}</td>
                                    <td>{{ $set->class_type }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $set->id }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('faculty.sets.delete', $set->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this set?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $set->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Faculty Set</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('faculty.sets.update', $set->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label>Min Lectures</label>
                                                        <input type="number" name="min_lec" class="form-control" value="{{ $set->min_lec }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Max Lectures</label>
                                                        <input type="number" name="max_lec" class="form-control" value="{{ $set->max_lec }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Daily Lectures</label>
                                                        <input type="number" name="daily_lec" class="form-control" value="{{ $set->daily_lec }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Total Lectures</label>
                                                        <input type="number" name="total_lec" class="form-control" value="{{ $set->total_lec }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Room No</label>
                                                        <input type="text" name="roomno" class="form-control" value="{{ $set->roomno }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Class Type</label>
                                                        <select name="class_type" class="form-control" required>
                                                            <option value="Theory" {{ $set->class_type == 'Theory' ? 'selected' : '' }}>Theory</option>
                                                            <option value="Lab" {{ $set->class_type == 'Lab' ? 'selected' : '' }}>Lab</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#faculty-sets-table').DataTable({
        "ordering": true,
        "info": true,
        "searching": true,
        "responsive": true
    });
});
</script>
@endsection 