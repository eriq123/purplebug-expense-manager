@extends('layouts.index')
@section('content')
<section role="main" class="content-body">
	<header class="page-header">
		<h2>User Management > Roles</h2>
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
						id="add_role_btn"
						type="button">
						<span class="fas fa-plus">&nbsp;</span>{{$add_button_name}}
					</button>

					<hr>

					<div class="table-responsive">
						<table id="Table1" class="table table-hover table-striped" style="width:100%; border: solid 2px;">
							<thead>
								<tr>
									<th style="border-right: solid 2px;">Display Name</th>
									<th style="border-right: solid 2px;">Description</th>
									<th style="border-right: solid 2px;">Created at</th>
								</tr>
							</thead>
							<tbody>
								@foreach($roles as $role)
								<tr data-id="{{$role->id}}" data-name="{{$role->name}}" data-description="{{$role->description}}">
									<td style="border-right: solid 2px;">{{$role->name}}</td>
									<td style="border-right: solid 2px;">{{$role->description}}</td>
									<td style="border-right: solid 2px;">{{$role->created_at}}</td>
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

		// add role
			$('#add_role_btn').on('click', function(){
				$('#Modal1_h5').html("Add Role");
				$('div.modal-header').removeClass().addClass('modal-header bg-success');

				var footer = "<button type='button' class='btn' data-dismiss='modal'>Cancel</button>";
				footer += "<button type='submit' class='btn btn-success' name='submit' value='add'>Save</button>";

				$('.modal-footer').html(footer);

				$('#Form1')[0].reset();
				$('#Modal1').modal('show');
			});

		// update/delete role
			$('#Table1 tr[data-id]').on('click', function(){
				if ($(this).data('name') == "Administrator") {
					alert("Administrator Role cannot be Updated/Deleted.");
				}else{

					$('#Modal1_h5').html("Update Role");
					$('div.modal-header').removeClass().addClass('modal-header bg-primary');

					var footer = "<button type='button' class='btn' data-dismiss='modal'>Cancel</button>";
					footer += "<button type='submit' class='btn btn-primary' name='submit' value='update'>Update</button>";
					footer += "<button type='submit' class='btn btn-danger' name='submit' value='delete' style='float:left;'>Delete</button>";

					$('.modal-footer').html(footer);

					$('#Form1')[0].reset();
					$('#Modal1').modal('show');

					$('input#id').val($(this).data('id'));
					$('input#name').val($(this).data('name'));
					$('input#description').val($(this).data('description'));
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
				<form action="{{ route('roles.action') }}" method="post" class="form-horizontal" id="Form1">
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
								<label class=" form-control-label">Display Name</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="text" id="name" name="name" class="form-control">
							</div>
						</div>

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Description</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="text" id="description" name="description" class="form-control">
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

