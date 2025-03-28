@extends('layout')
@section('title', 'Add Student')
@section('content')
<h2>Add New Student</h2>
<form method="POST" action="{{ route('students.store') }}" class="mt-3">
    @csrf
    <form>

  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" name="name" id="form1Example1" class="form-control" />
    <label class="form-label" for="form1Example1">Name</label>
  </div>

 
  <div data-mdb-input-init class="form-outline mb-4">
    <input type="text" name="age" id="form1Example2" class="form-control" />
    <label class="form-label" for="form1Example2">Age</label>
  </div>

  <!-- Submit button -->
  <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">submit</button>
</form>
@endsection
