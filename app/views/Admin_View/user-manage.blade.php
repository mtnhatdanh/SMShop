@extends('admin_theme')

@section('title')
SMShop - Manage User
@endsection
@section('content')

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h1>Manage user</h1>
		</div>
	</div>
	@include('notification')
	<br/>
</div>

<div class="container" id="content">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered table-condensed table-responsive">
				<tr>
					<th>No</th>
					<th>Username</th>
					<th>Password</th>
					<th class="text-center">Action</th>
				</tr>
				<?php $no = 0;?>
				@foreach (User::all() as $user)
				<tr>
					<td>{{++$no}}</td>
					<td>{{$user->username}}</td>
					<td>{{$user->password}}</td>
					<td class="text-center">
						<button id="{{$user->id}}" class="btn btn-link delete_button" data-toggle="modal" href='#delete-modal'>Delete</button>
					</td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>

<!-- Modal for delete user -->
{{Former::open()->action(asset('admin/delete-user'))}}
	<div class="modal fade" id="delete-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Delete User</h4>
				</div>
				<div class="modal-body">
					<span>Are you sure to delete this user??</span>
					{{Former::hidden('user_id')->id('user_id')}}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Delete User</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
{{Former::close()}}

<script type="text/javascript">
	$('.delete_button').click(function(){
		user_id = $(this).attr('id');
		$('#user_id').val(user_id);
	});
</script>
@endsection