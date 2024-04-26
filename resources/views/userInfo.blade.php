@extends('layout')
@section('title', 'Login')
@section('content')
<form class="ms-auto me-auto mt-3" action="{{route('userInfo.post')}}" method="POST" style="width: 500px">
@csrf
  <div class="mb-3">
    <label for="l1" class="form-label">First name</label>
    <input type="text" class="form-control" id="l1" name="firstName">
  </div>
  <div class="mb-3">
    <label for="l2" class="form-label">Last name</label>
    <input type="text" class="form-control" id="l2" name="lastName">
  </div>
  <div class="mb-3">
    <label for="l3" class="form-label">Date of birth</label>
    <input type="date" class="form-control" id="l3" name="dateOfBirth">
  </div>
  <div class="mb-3">
    <label for="l4" class="form-label">Favourite car brand</label>
    <input type="text" class="form-control" id="l4" name="carBrand">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection