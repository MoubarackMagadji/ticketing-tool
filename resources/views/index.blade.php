
<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<meta name="HandheldFriendly" content="true" />
	<title></title>
<style type="text/css">
	*{
		box-sizing: border-box;
	}
	html{
		height: 100%;
	}
	body{
		height: 90%;
	}

	section{
		background-image: url('../images/fb.png');
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100%;
	}
	#content{
		padding:20px 10%;
		background-color: #ffffffe6;
		display:flex;
		justify-content: center;
		align-items: center;
		background-color: #000000c2;
		width: max-content;
	}
	#loginlogo{
		height: 150px;
	}
	section form{
		width:400px;
		padding:30px 3%;
		box-sizing: border-box;
		position: relative;
		color:white;
	}
	label{
		display:block;
		font-weight: bold;
		margin-bottom: 5px;
	}
	section input{
		width:100%;
		padding: 10px;
		font-weight: bold;
		border:0px;
	}
	#hideshow{
		display:block;
		text-align: right;
		margin: 10px;
		font-size: 18px;
	}
	#hideshow label{
		display:unset;
	}
	#hideshow input{
		width: unset;
	}
	section input[type=submit]{
		width:50%;
		margin:30px auto;
		display: block;
		background-color: white;
		border:0;
		transition: .3s;
		cursor:pointer;
	}
	section input[type=submit]:hover{
		border:1px solid #02b3e4;
	}
	#accountP{
		text-align: center; 
		position: absolute;
		width: 100%;
		bottom: 10px;
		font-size: 17px;
	}
	#accountP a {
		color:white;
		text-decoration: none;
		border-bottom: 5px solid #02b3e4;
		transition:.3s;
		display:inline-block;
	}
	#accountP a:hover{
		transform: scale(1.15);
	}
	.error{
		background-color:#C83939;
	}
	.error, .success{
		background-color:#C83939;
		padding:2% 4px;
		border-radius:5px;
		text-align: center;
		color:white;
	}
	.message{
		font-weight: bold;
	}
@media all and (max-width:500px){
	#content{
		padding:5%;
	}
	section form{
		width:unset;
	}
}
</style>
</head>
<body>

    <section>
        <div id='content'>
        <img id='loginlogo' src='images/logo.png'>	

        {{ Cookie::get('error')}}

        @if (Cookie::get('lock'))
            <p class="error">
                <span>Your attempts are exceded.</span>
                <span style='display: block'> You must wait for 3 mins</span>
            </p>
        @endif
    
        <form method='post' action=' {{ route('authenticate') }}'>
            @csrf
        
            <label>Username </label><input type="text" name="username" placeholder=""   {{ Cookie::get('lock') ? 'disabled':'' }} required><br/><br/>
            <label>Password </label><input type="password" name="password" placeholder="" id='password' {{ Cookie::get('lock') ? 'disabled':'' }}  required> 
            
            {{-- <span id='hideshow'> <input type="checkbox" id="showPassword"> <label for='showPassword'>Show</label> </span> --}}
            
            <input type="submit" value='Log in'>
        </form>
    
        
    </div>
    </section>
