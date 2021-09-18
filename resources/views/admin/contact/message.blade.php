@extends('admin.admin_master')
@section('admin')
           
<div class="row">
    <div class="col-12">
      <!-- Show all brand -->
      <div class="card pagination">
        <div class="card-header">All Message</div>
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">E-mail</th>
                <th scope="col">Subject</th>
                <th scope="col">Message</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <!-- @php($i=1) -->
              @foreach($messages as $message)
              <tr>
                <th scope="row">{{ $i++ }}</th>
                <td>{{ $message->name }}</td>
                <td>{{ $message->email }}</td>
                <td>{{ $message->subject }}</td>
                <td>{{ $message->message }}</td>
                <td>
                  <a href="{{ url('message/delete/'.$message->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete?')">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <nav aria-label="Page navigation example">
          <ul class="pagination">
          </ul>
        </nav>      
        </div>
      </div>
</div>

@endsection