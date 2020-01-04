<table id="dtBasic" class="table table-bordered table-hover" cellspacing="0" width="100%">
  <thead class="black white-text">
    <tr class="text-center">
      <th rowspan="2" class="align-middle">No.</th>
      <th rowspan="2" class="align-middle">TITULO</th>
      <th rowspan="2" class="align-middle">URL</th>
      <th colspan="2">CATEGORIAS</th>
      <th rowspan="2" class="align-middle">DESCRIPCION</th>
    </tr>
    <tr>
      <th>NOMBRE</th>
      <th>URL</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $data)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $data->title }}</td>
        <td>{{ $data->url }}</td>
        <td>{{ $data->category->name }}</td>
        <td>{{ $data->category->url }}</td>
        <td>{{ $data->description }}</td>
      </tr>
    @endforeach
  </tbody>
</table>