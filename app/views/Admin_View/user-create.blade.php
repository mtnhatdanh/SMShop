@extends('admin_theme')

@section('title')
SMShop - Create User
@endsection
@section('content')

<div class="container">
	<div class="page-header">
		<h1>Create new user</h1>
	</div>
	@include('notification')
</div>

<div  id="content">
	{{Former::open()->action(asset('admin/create-user'))->id('form-register')}}
		<div class="container">
			<div class="row form-group">
				<div class="col-sm-3">
					{{Former::text('username')->class('form-control')->placeholder('Enter your username..')}}
				</div>
				<div class="col-sm-3">
					{{Former::password('password')->class('form-control')->placeholder('Enter your password')}}
				</div>
				<div class="col-sm-3">
					{{Former::password('password_confirmation')->class('form-control')->placeholder('Re-enter your password')}}
				</div>
			</div>
			<br/>
			<div class="row form-group">
				<div class="col-sm-2">
					<button type="submit" class="btn btn-primary btn-block">Create user</button>
				</div>
				<div class="col-sm-2">
					<a href="{{Asset('user/manage-user')}}"><button type="button" class="btn btn-default btn-block">Back</button></a>
				</div>
			</div>
		</div>
	{{Former::close()}}
</div>

<script type="text/javascript">
	$('#form-register').validate({
		rules:{
			username:{
				required:true,
				minlength:3,
				remote:{
					url:"{{Asset('check-username-exist')}}",
					type:"post"
				}
			},
			password:{
				required:true,
				minlength:6,
			},
			password_confirmation:{
				equalTo:"#password"
			}
		},
		messages:{
			username:{
				remote:"This username already exists.",
			}
		}
	});
</script>

@endsection