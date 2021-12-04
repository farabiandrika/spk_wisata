<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>SPK Wisata</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/carousel/">
    <!-- Bootstrap core CSS -->
<link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Favicons -->
<link rel="icon" href="{{ asset('images/logoku.png') }}">
<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
  </head>
  <body>
    
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logoku.png') }}" style="width: 50px;" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
        @if (Auth::check())    
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/home') }}">Dashboard</a>
          </li>
          @endif
        </ul>
        <div class="text-right">
          @if (Auth::check())
            <a href="{{ url('/logout') }}" class="btn btn-primary btn-sm">Logout</a>
          @else
            <a href="{{ url('/login') }}" class="btn btn-primary btn-sm">Login</a>
            <a href="{{ url('/register') }}" class="btn btn-secondary btn-sm">Register</a>
          @endif
        </div>
        
      </div>
    </div>
  </nav>
</header>

<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      @foreach ($wisatas as $key => $wisata)
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : '' }}" aria-label="Slide {{ $key+1 }}"></button>
      @endforeach
    </div>
    <div class="carousel-inner">
      @foreach ($wisatas as $key => $wisata)
      <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
        <img src="{{ asset('upload/images/'.$wisata->gambar) }}" alt="" style="width: 1500px; height: 600px;">
        {{-- <svg class="bd-placeholder-img" width="100%" height="50%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
          <rect x="0" y="0" width="100%" height="100%"/>
          <image xlink:href="{{ asset('upload/images/'.$wisata->gambar) }}" x="0" y="0" height="100%" width="100%"/>
        </svg> --}}
        <div class="container">
          <div class="carousel-caption">
            <h1>{{ $wisata->nama }}</h1>
            {{-- <p>Some representative placeholder content for the first slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p> --}}
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing mt-5">


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">Wisata Gunung Sitoli.</h2>
        <p class="lead">Gunung Sitoli merupakan kota tertua dan terbesar di Kepulauan Nias. Kota ini merupakan pemekaran dari Kabupaten Nias. Dulunya kota ini adalah sebuah kecamatan di Nias, baru pada tahun 2008 diresmikan menjadi kota otonom.
          <br>
          <br>
          Nama Gunung Sitoli merupakan pemberian dari nenek moyang zaman dahulu yang menetap di tempat ini pertama kali. Gunung berarti daratan tinggi dan Sitoli diambil dari nama orang yang berdiam di bukit.
          <br>
          <br>
          Sebagian wilayah Gunung Sitoli adalah perbukitan. Bagi Anda yang belum pernah mengunjungi kota ini, Gunung Sitoli adalah tempat yang sangat cocok untuk dijadikan destinasi liburan Anda. Di kota ini Anda akan dimanjakan dengan keindahan alamnya yang beragam. Selain itu, kota ini juga terdapat beberapa tempat bersejarah dan warisan-warisan budaya yang wajib untuk disambangi.</p>
          <br>
          <br>
          <span>WA : 082160304436</span>
          <br>
          <span>email : ardiliusb@gmail.com</span>
      </div>
      <div class="col-md-5">
        <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#eee"/><image xlink:href="{{ asset('images/gunung-sitoli.jpeg') }}" x="0" y="0" height="100%" width="100%"/></svg>

      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">Back to top</a></p>
    <p>&copy; 2017–2021 SPK Wisata, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
  </footer>
</main>


    <script src="https://getbootstrap.com/docs/5.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

      
  </body>
</html>