<!DOCTYPE html>
<html>
   <head>
      <title>Admin Event Mangement</title>
      <!-- Bootstrap CSS CDN -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
      <!-- Our Custom CSS -->
      <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&family=Mulish:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
   </head>
   <body style="background-color: #D6EFFF !important;">
      <div class="wrapper d-flex">
      <!-- Sidebar -->
      <nav class="navbar flex-column p-3" style="background-color: #42ADFF; font-family: 'Fredoka'; width: 250px; height: 100vh; position: fixed; left: 0; top: 0;">
         <h2 class="mb-2 mt-2 text-white text-center">SIRFU</h2>
         <ul class="nav navbar-nav w-100"
            style="color: white; font-family: 'Gabarito', sans-serif; font-size: 16px; font-weight: 600; margin-top: 0;">
            <li class="nav-item mb-2" style="border-bottom: 1px solid #fff;">
               <a class="nav-link text-white" href="{{ url('/') }}">Beranda</a>
            </li>
            <li class="nav-item mb-2" style="border-bottom: 1px solid #fff;">
               <a class="nav-link text-white" href="{{ route('events.index') }}">Reservasi</a>
            </li>
            <li class="nav-item mb-2" style="border-bottom: 1px solid #fff;">
               <a class="nav-link text-white" href="#">Laporan</a>
            </li>
            <li class="nav-item mb-2">
               <a class="nav-link text-danger fw-bold" href="{{ route('signout') }}">Logout</a>
            </li>
         </ul>
      </nav>


      <!-- Page Content -->
      <div id="content" class="flex-grow-1 p-4" style="background-color: #D6EFFF !important; margin-left: 250px;">
         <div class="container-fluid">
            <span class="navbar-text mb-4" style="font: Gabarito; font-size: 20px; font-weight: 600; font-color: white;">Selamat Datang, Admin!</span>
         </div>
         @yield('content')
      </div>
   </div>

      <!-- jQuery CDN - Slim version (=without AJAX) -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <!-- Popper.JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
      <!-- Bootstrap JS -->
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
      <script type="text/javascript">
         $('.date').datepicker({  
         format: 'yyyy-mm-dd'
         });  
      </script> 
   </body>
</html>