@extends('layouts.utama')

@section('content')

<div class="row">
  <div class="col-md-4">
    <!-- Categories -->
    <ul class="list-group">
      <li class="list-group-item active">Kategori</li>
      <li class="list-group-item">Kategori 1</li>
      <li class="list-group-item">Kategori 2</li>
      <li class="list-group-item">Kategori 3</li>
    </ul>
  </div>
  <div class="col-md-8">
    <!-- Search Results -->
    <div class="row">
      <div class="col-md-12">
        <h3>Search Results</h3>
        <hr>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card-deck">
          <!-- Search result items go here -->
        </div>
      </div>
    </div>
  </div>
</div>

@endsection