@extends('layout.master')

@section('content')
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h2>Daftar Motor</h2>
            <a href="/motor/create" class="btn btn-success ">Tambah Motor</a>
        </div>
    </div>
<div class="card">
    <table class="table table-striped-columns">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>John</td>
      <td>Doe</td>
      <td>@social</td>
    </tr>
  </tbody>
</table>
</div>
@endsection