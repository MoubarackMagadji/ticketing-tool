<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<!-- <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css"> -->
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

            <form method="post" action='/staffs/logout'>
                @csrf
                <input type="submit" value='Logout'>
            </form>
            {{-- <a href='postfolder/logout.php'><i class='fa fa-sign-out'></i><span>  Log out</span></a> --}}
        </nav>
    </header>

<section>
    <div id='content'>
        @yield('content')
    </div>
</section>
	
<?php /* include('footer.php'); */ ?>
	<!-- <script src='../js/canvasjs.min.js'></script> -->
	<script>
		
	</script>
</body>
</html>