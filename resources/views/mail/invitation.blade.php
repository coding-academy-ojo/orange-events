<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>

  <link href="https://cdn.jsdelivr.net" rel="preconnect" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/boosted@5.3.3/dist/css/boosted.min.css" rel="stylesheet"
    integrity="sha384-laZ3JUZ5Ln2YqhfBvadDpNyBo7w5qmWaRnnXuRwNhJeTEFuSdGbzl4ZGHAEnTozR" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/style.css') }}">

  <style>

    .container {
      min-width: 90%;
      /* box-shadow: #ff990059 0px 62px 28px -25px inset; */
    }

    .orange {
      color: #ff6a00;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-dark" style="min-height: 80px">
    <div class="container-md">
      <div>
        <a class="" href="#">
          <img
            src="{{ $message->embed(public_path().'/assets/brand/orange-is-here-white.png') }}"
            alt="orange logo"
            loading="lazy"
            style="width: 80px; height: 110px"
          />
        </a>
      </div>
    </div>
  </nav>



  <div class="container d-flex flex-column justify-content-center  py-1 mt-4">

    <div class="d-flex justify-content-between">
      <div>
      </div>
    </div>

    <div class="d-grid gap-2 mx-auto" style="width: 70%;">

      <h1 class="display-1 orange text-center">{{ $event->title }}</h1>

      <p class="my-2">
        {{ $event->short_description }}
      </p>


      <p class="my-2">
        We are thrilled to invite you to <span class="fw-bold orange">{{ $event->title }}</span> on
        <span class="fw-bold orange">{{ Carbon\Carbon::parse($event->start_date_time)->format('d-M-Y l') }}</span>.
        To confirm your attendance, please click the button below. We would be honored to have you join us.
      </p>


      <a class="btn btn-primary" href="{{ route('event.invitation', $token) }}">Invitation</a>


      <div style="font-size: 14px; margin-top: 150px;" class="text-center">
        <div>
          Corporate Communication & Sustainability Unit department
        </div>
        <div>
          <img src="{{ $message->embed(public_path().'/assets/brand/orange-is-here-black.svg') }}" alt="orange-logo" class="img-fluid"
          style="width: 10%">
        </div>
      </div>
    </div>




  </div>



</body>

</html>