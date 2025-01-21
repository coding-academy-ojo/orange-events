<!DOCTYPE html>
<html lang="en">
<head>
  @include("dashboard.partials.head")
  
  <style>
    html {
      overflow: hidden;
    }
  </style>
  <title>Not Found Page</title>
</head>
<body>
  


  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>404</h1>
        <h2>The page you are looking for doesn't exist.</h2>
        <a class="btn btn-orange-main" href="{{ route('dashboard.index') }}">Back to home</a>
        <img src="{{ asset('assets/brand/orange-is-here-black.svg') }}" class="img-fluid py-5" alt="Page Not Found">
      </section>
    
    </div>
  </main>



</body>
</html>