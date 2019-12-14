@extends('layouts.index')
@section('content')
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Expense Management > Expense Categories</h2>
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
						data-role="{{Auth::user()->role->name}}"
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
								@foreach($categories as $category)
								<tr data-id="{{$category->id}}" data-name="{{$category->name}}" data-description="{{$category->description}}" data-role="{{Auth::user()->role->name}}">
									<td style="border-right: solid 2px;">{{$category->name}}</td>
									<td style="border-right: solid 2px;">{{$category->description}}</td>
									<td style="border-right: solid 2px;">{{$category->created_at}}</td>
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

		// add category
			$('#add_role_btn').on('click', function(){
				if ($(this).data('role') == "Administrator") {

					$('#Modal1_h5').html("Add Category");
					$('div.modal-header').removeClass().addClass('modal-header bg-success');

					var footer = "<button type='button' class='btn' data-dismiss='modal'>Cancel</button>";
					footer += "<button type='submit' class='btn btn-success' name='submit' value='add'>Save</button>";

					$('.modal-footer').html(footer);

					$('#Form1')[0].reset();
					$('#Modal1').modal('show');
					
				}else{
					alert("Only Administrator can access this functionality.");
				}
			});

		// update/delete category
			$('#Table1 tr[data-id]').on('click', function(){
				if ($(this).data('role') == "Administrator") {
					$('#Modal1_h5').html("Update Category");
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
				}else{
					alert("Only Administrator can access this functionality.");
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
				<form action="{{ route('categories.action') }}" method="post" class="form-horizontal" id="Form1">
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

