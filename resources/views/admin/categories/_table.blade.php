<table id="dtBasic" class="table table-bordered table-hover" cellspacing="0" width="100%">
  <thead class="black white-text">
    <tr class="text-center align-middle">
      <th>No.</th>
      <th>NOMBRE</th>
      <th>URL</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($categories as $category)
      <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->url }}</td>
      </tr>
    @endforeach
  </tbody>
</table>