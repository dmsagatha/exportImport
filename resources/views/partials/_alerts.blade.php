@if (Session('success'))
  <div class="row">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>{{ session('success') }}</strong>
    </div>
  </div>
@endif

@if (Session()->has('danger'))
  <div class="row">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="true">&times;</button>
      <strong>{{ Session('danger') }}</strong>
    </div>
  </div>
@endif

@if (Session('info'))
  <div class="row">
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>{{ session('info') }}</strong>
    </div>
  </div>
@endif

@if (Session('warning'))
  <div class="row">
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong>{{ session('warning') }}</strong>
    </div>
  </div>
@endif