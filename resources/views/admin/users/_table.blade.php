<table class="table table-bordered table-hover user_table" id="dtBasic">
  <thead class="black white-text">
    <tr class="text-center align-middle">
      <th>No.</th>
      <th>NOMBRE DE USUARIO</th>
      <th>NOMBRE</th>
      <th>CORREO ELECTRONICO</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
      </tr>
    @endforeach
  </tbody>
</table>