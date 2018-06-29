<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Panoptik, la solution pour vous retrouver">
    <meta name="author" content="@maxgfr">

    <title>Panoptik</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}" />

    <!-- Custom fonts for this template -->
    <link href="{{ asset('landing/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('landing/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="{{ asset('landing/css/landing-page.min.css') }}" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light static-top">
      <div class="container">
        <a class="navbar-brand" href="/">Panoptik</a>
        @guest
            <a class="btn btn-primary" href="/login">Sign In</a>
        @else
            <a class="btn btn-primary" href="/login">Dashboard</a>
        @endguest
      </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead text-white text-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">Panoptik, a way of thinking through sensors</h1>
            @guest
                <div class="form-row">
                  <a href="/register" class="btn btn-block btn-lg btn-primary">Sign up!</a>
                </div>
            @endguest
          </div>
        </div>
      </div>
    </header>

    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-screen-desktop m-auto text-primary"></i>
              </div>
              <h3>Fully Responsive</h3>
              <p class="lead mb-0">This application will look great on any device, no matter the size!</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-layers m-auto text-primary"></i>
              </div>
              <h3>Ready to use</h3>
              <p class="lead mb-0">Just sign up and try it!</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="features-icons-item mx-auto mb-0 mb-lg-3">
              <div class="features-icons-icon d-flex">
                <i class="icon-check m-auto text-primary"></i>
              </div>
              <h3>Easy to Use</h3>
              <p class="lead mb-0">Import your sensor and... That's all :p </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Image Showcases -->
    <section class="showcase">
      <div class="container-fluid p-0">
          <div class="row no-gutters">
            <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('img/image3.png') }}');"></div>
            <div class="col-lg-6 order-lg-1 my-auto showcase-text">
              <h2>The easiest way to track your container </h2>
              <p class="lead mb-0">Know where your product is all the time.</p>
            </div>
          </div>

        <div class="row no-gutters">
          <div class="col-lg-6 text-white showcase-img" style="background-image: url('{{ asset('img/image2.png') }}');"></div>
          <div class="col-lg-6 my-auto showcase-text">
            <h2>Add places</h2>
            <p class="lead mb-0">You can add "spot" and calculate what is the fastest way to go there.</p>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{{ asset('img/container.jpg') }}');"></div>
          <div class="col-lg-6 order-lg-1 my-auto showcase-text">
            <h2>95% of accuracy</h2>
            <p class="lead mb-0">We use an algorithm to detect precisely the container.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials text-center bg-light">
      <div class="container">
        <h2 class="mb-5">What people are saying...</h2>
        <div class="row">
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="{{ asset('img/adrien.jpeg') }}" alt="">
              <h5>Adrien T.</h5>
              <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="{{ asset('img/maxime.jpeg') }}" alt="">
              <h5>Maxime G.</h5>
              <p class="font-weight-light mb-0">"Panoptik is amazing. I've been using it to locate all of my countainers."</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="testimonial-item mx-auto mb-5 mb-lg-0">
              <img class="img-fluid rounded-circle mb-3" src="{{ asset('img/esther.jpeg') }}" alt="">
              <h5>Esther D.</h5>
              <p class="font-weight-light mb-0">"Thanks so much for making these software!"</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Call to Action -->
    <section class="call-to-action text-white text-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h2 class="mb-4">Ready to get started? Sign up now!</h2>
            <div class="form-row">
              <a href="/register" class="btn btn-block btn-lg btn-primary">Click here</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
            <ul class="list-inline mb-2">
              <li class="list-inline-item">
                <a href="#">About</a>
              </li>
              <li class="list-inline-item">&sdot;</li>
              <li class="list-inline-item">
                <a href="#">Contact</a>
              </li>
              <li class="list-inline-item">&sdot;</li>
              <li class="list-inline-item">
                <a href="#">Terms of Use</a>
              </li>
              <li class="list-inline-item">&sdot;</li>
              <li class="list-inline-item">
                <a href="#">Privacy Policy</a>
              </li>
            </ul>
            <p class="text-muted small mb-4 mb-lg-0">&copy; Panoptik. All Rights Reserved.</p>
          </div>
          <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item mr-3">
                <a href="#">
                  <i class="fa fa-facebook fa-2x fa-fw"></i>
                </a>
              </li>
              <li class="list-inline-item mr-3">
                <a href="#">
                  <i class="fa fa-twitter fa-2x fa-fw"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-instagram fa-2x fa-fw"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('landing/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  </body>

</html>
