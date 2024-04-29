<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2/dist/css/bootstrap.min.css" crossorigin="anonymous">
  <title></title>
</head>
<body>


  <section class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
        <form method="POST" action="{{ route('login') }}">
          @csrf
          <!-- Email input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form1Example13">Correo</label>
            <input type="email" name="email" id="form1Example13" class="form-control form-control-lg" />
          </div>

          <!-- Password input -->
          <div data-mdb-input-init class="form-outline mb-4">
            <label class="form-label" for="form1Example23">Contraseña</label>
            <input type="password" id="form1Example23" name="password" class="form-control form-control-lg" />
          </div>

          
          <!-- Submit button -->
          <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Iniciar</button>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
          </div>
            <a href="{{ route('register') }}" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Registrate</a>

        </form>
      </div>
    </div>
  </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"></script>
</body>
</html>