<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href=" {{ asset('css/bootstrap-5.3.1.css')}}"> 
	<meta charset='utf-8'>
	<title>Staffs</title>
<style>
	
</style>

</head>
<body>
    <header>
        <div id='head'>
            <span><i id='shrink' style='font-size: 23px;margin-right:10px;' class='fa fa-bars'></i><a id='hIndex' href='dashboard.php'>Ticketing Tool - Employee </a></span> 
                <div>
                    <span id='a'></span>:
                    <span id='b'></span>:
                    <span id='c'></span>
                </div>
            <div id="headProf">
                <img id='headPic' src="../images/Person.png">
                
                <span>
                    {{ Auth::user()->name }} 
                </span>

                <span id='editSpan'><a href='profile.php'><i class='fa fa-gear fa-spin'></i> Edit</a></span>
            </div>
        </div>
        <nav>
            {{-- <a href='dashboard.php'><i class='fa fa-home'></i><span> Dashboard</span></a>
            <a href='outTickets.php'><i class='fa fa-ticket'></i> Out <span>  Tickets</span></a>
            <a href='inTickets.php'><i class='fa fa-ticket'></i> In <span>  Tickets</span></a>
            <a href='profile.php'><i class='fa fa-user-circle'></i><span>  Profile</span></a> --}}
            

            <a href='dashboard.php'><i class='fa fa-home'></i><span> Dashboard</span></a>
            <a href='{{ route('users')}}'><i class='fa fa-ticket'></i> Users</span></a>
            <a href='{{ route('depts')}}'><i class='fa fa-ticket'></i> Depts</span></a>
            <a href='{{ route('status')}}'><i class='fa fa-ticket'></i> Status</span></a>
            <a href='{{ route('priorities')}}'><i class='fa fa-ticket'></i> Priorities</span></a>

            <form method="post" action='/staffs/logout'>
                @csrf
                <input type="submit" class='btn btn-danger text-start w-100'  value='Logout'>
            </form>
            {{-- <a href='postfolder/logout.php'><i class='fa fa-sign-out'></i><span>  Log out</span></a> --}}
        </nav>
    </header>

<section>
    <div id='content'>
        
        @if (session()->has('success'))
            <p class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </p>
        @endif

        @if (session()->has('error'))
            <p class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }} 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </p>
        @endif

        @yield('content')
    </div>
</section>
	
<?php /* include('footer.php'); */ ?>
	<!-- <script src='../js/canvasjs.min.js'></script> -->
    <script src=' {{ asset('js/bootstrap-5.3.1.js') }}'> </script>
	<script>
		
	</script>
</body>
</html>