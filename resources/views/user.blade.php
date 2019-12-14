@extends('layouts.index')
@section('content')
<section role="main" class="content-body">
	<header class="page-header">
		<h2>User Management > Users</h2>
	</header>

	<div class="row">
		<div class="col-md-12">

			<section class="panel panel-featured">
				<header class="panel-heading">
					<h2 class="panel-title">{{$panel_title}}</h2>
				</header>
				<div class="panel-body" style="display: block;">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif

					@if(session('success'))
					<div class="alert alert-success">
						{{session('success')}}
					</div>
					@endif
					
					<button class="btn btn-success"
						id="add_user_btn"
						type="button">
						<span class="fas fa-plus">&nbsp;</span>{{$add_button_name}}
					</button>

					<hr>

					<div class="table-responsive">
						<table id="Table1" class="table table-hover table-striped" style="width:100%; border: solid 2px;">
							<thead>
								<tr>
									<th style="border-right: solid 2px;">Name</th>
									<th style="border-right: solid 2px;">Email Address</th>
									<th style="border-right: solid 2px;">Role</th>
									<th style="border-right: solid 2px;">Created at</th>
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								<tr 
									data-id="{{$user->id}}" 
									data-role = "{{$user->role->name}}"
									data-first_name = "{{$user->first_name}}"
									data-last_name  = "{{$user->last_name}}"
								>
									<td style="border-right: solid 2px;">{{$user->full_name}}</td>
									<td style="border-right: solid 2px;">{{$user->email}}</td>
									<td style="border-right: solid 2px;">{{$user->role->name}}</td>
									<td style="border-right: solid 2px;">{{$user->created_at}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>

				</div>
			</section>

		</div>
	</div>		
</section>
@endsection
@section('css')

@endsection
@section('js')
<script>
	$(document).ready(function(){

		// add user
			$('#add_user_btn').on('click', function(){
				$('#Modal1_h5').html("Add User");
				$('div.modal-header').removeClass().addClass('modal-header bg-success');

				var footer = "<button type='button' class='btn' data-dismiss='modal'>Cancel</button>";
				footer += "<button type='submit' class='btn btn-success' name='submit' value='add'>Save</button>";

				$('.modal-footer').html(footer);

				$('#Form1')[0].reset();
				$('#Modal1').modal('show');
			});

		// update/delete user
			$('#Table1 tr[data-id]').on('click', function(){
				if ($(this).data('role') == "Administrator") {
					alert("Administrator Role cannot be Updated/Deleted.");
				}else{
					$.ajax({
						type: 'POST',
						url: "{{route('users.CheckRole')}}",
						data:{
							id: $(this).data('id'),
						},
						success: function (data){

							$('#Modal1_h5').html("Update Role");
							$('div.modal-header').removeClass().addClass('modal-header bg-primary');

							var footer = "<button type='button' class='btn' data-dismiss='modal'>Cancel</button>";
							footer += "<button type='submit' class='btn btn-primary' name='submit' value='update'>Update</button>";
							footer += "<button type='submit' class='btn btn-danger' name='submit' value='delete' style='float:left;'>Delete</button>";

							$('.modal-footer').html(footer);

							$('#Form1')[0].reset();
							$('#Modal1').modal('show');

							$('input#id').val(data.user.id);
							$('input#first_name').val(data.user.first_name);
							$('input#last_name').val(data.user.last_name);
							$('input#email').val(data.user.email);


							var role = "<select class='form-control' name='role' id='role'>";
							
							$.each(data.role, function( k, v ) {
								if (v.id == data.user.role_id) {
									role += "<option value='"+v.id+"' selected>"+v.name+"</option>";
								}else{
									role += "<option value='"+v.id+"'>"+v.name+"</option>";
								}
							});

							role += "</select>";

							$('select#role').html(role);

						},
					});
				}
			});

	});
</script>
@endsection
@section('modals')

<!-- Modal1 -->
	<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="{{ route('users.action') }}" method="post" class="form-horizontal" id="Form1">
					@csrf
					<input type="hidden" name="id" id="id">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
						</button>
						<h5 class="modal-title" id="Modal1_h5"></h5>
					</div>
					<div class="modal-body">

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">First Name</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="text" id="first_name" name="first_name" class="form-control">
							</div>
						</div>

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Last Name</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="text" id="last_name" name="last_name" class="form-control">
							</div>
						</div>

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Email Address</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="email" id="email" name="email" class="form-control">
							</div>
						</div>

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Password</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="password" id="password" name="password" class="form-control">
							</div>
						</div>

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Confirm Password</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
							</div>
						</div>

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Role</label>
							</div>
							<div class="col-12 col-md-9">
								<select class="form-control" name="role" id="role">
									@foreach($roles as $role)
										<option value="{{$role->id}}">{{$role->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<br>
					</div>

					<div class="modal-footer"></div>

				</form>
			</div>
		</div>
	</div>

@endsection

