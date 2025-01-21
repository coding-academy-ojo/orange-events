<!DOCTYPE html>
<html lang="en">

<head>

  @include("dashboard.partials.head")

</head>

<body>

  @include("dashboard.partials.header")

  @include("dashboard.partials.sidebar")

  <main id="main" class="main">


    @yield("content")

  </main>


  @include("dashboard.partials.footer")

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


  @include("dashboard.partials.scripts")
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
</body>

</html>