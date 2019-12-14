@extends('layouts.index')
@section('content')
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Expense Management > Expenses</h2>
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
						id="add_expense_btn"
						type="button">
						<span class="fas fa-plus">&nbsp;</span>{{$add_button_name}}
					</button>

					<hr>

					<div class="table-responsive">
						<table id="Table1" class="table table-hover table-striped" style="width:100%; border: solid 2px;">
							<thead>
								<tr>
									<th style="border-right: solid 2px;">Expense Category</th>
									<th style="border-right: solid 2px;">Amount</th>
									<th style="border-right: solid 2px;">Entry Date</th>
									<th style="border-right: solid 2px;">Created at</th>
								</tr>
							</thead>
							<tbody>
								@foreach($expenses as $expense)
								<tr data-id="{{$expense->id}}">
									<td style="border-right: solid 2px;">{{$expense->category->name}}</td>
									<td style="border-right: solid 2px;">$ {{number_format($expense->amount , 2)}}</td>
									<td style="border-right: solid 2px;">{{$expense->entry_date}}</td>
									<td style="border-right: solid 2px;">{{$expense->created_at}}</td>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
	.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year {
		width: 50%;
	}
	#ui-datepicker-div{
		z-index: 1043!important;
	}

</style>
@endsection
@section('js')
<script src="{{asset('assets/javascripts/cleave.min.js')}}"></script>
<script src = "{{asset('assets/datepicker/jquery-ui.js')}}"></script>

<script>
	$(document).ready(function(){

		// format input
			var cleave = new Cleave('.input_format_1', {
				numeral: true,
				numeralThousandsGroupStyle: 'thousand'
			});

		// datepicker
			$(function() {
				$( "#entry_date" ).datepicker({
					showOn: "button",
					buttonImage: "{{asset('assets/images/calendar.gif')}}",
					buttonImageOnly: true,
					dateFormat: "yy-mm-d",
					changeMonth: true,
					changeYear: true,
				});
			});

		// add expense
			$('#add_expense_btn').on('click', function(){
				$('#Modal1_h5').html("Add Expense");
				$('div.modal-header').removeClass().addClass('modal-header bg-success');

				var footer = "<button type='button' class='btn' data-dismiss='modal'>Cancel</button>";
				footer += "<button type='submit' class='btn btn-success' name='submit' value='add'>Save</button>";

				$('.modal-footer').html(footer);

				$('#Form1')[0].reset();
				$('#Modal1').modal('show');

				$('img.ui-datepicker-trigger').detach().appendTo("#icon_here");

			});

		// update/delete expense
			$('#Table1 tr[data-id]').on('click', function(){
					$.ajax({
						type: 'POST',
						url: "{{route('expenses.UpdateModal')}}",
						data:{
							id: $(this).data('id'),
						},
						success: function (data){
							$('#Modal1_h5').html("Update Expense");
							$('div.modal-header').removeClass().addClass('modal-header bg-primary');

							var footer = "<button type='button' class='btn' data-dismiss='modal'>Cancel</button>";
							footer += "<button type='submit' class='btn btn-primary' name='submit' value='update'>Update</button>";
							footer += "<button type='submit' class='btn btn-danger' name='submit' value='delete' style='float:left;'>Delete</button>";

							$('.modal-footer').html(footer);

							$('#Form1')[0].reset();
							$('#Modal1').modal('show');
							$('img.ui-datepicker-trigger').detach().appendTo("#icon_here");

							var categories = "<select class='form-control' name='category' id='category'>";

							$.each(data.categories, function( k, v ) {
								if (v.id == data.expense.category_id) {
									categories += "<option value='"+v.id+"' selected>"+v.name+"</option>";
								}else{
									categories += "<option value='"+v.id+"'>"+v.name+"</option>";
								}
							});
							
							categories += "</select>";

							$('select#category').html(categories);

							$('input#id').val(data.expense.id);
							$('input#amount').val(data.expense.amount);
							$('input#entry_date').val(data.expense.entry_date);
						},
					});
			});

	});
</script>
@endsection
@section('modals')

<!-- Modal1 -->
	<div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form action="{{ route('expenses.action') }}" method="post" class="form-horizontal" id="Form1">
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
								<label class=" form-control-label">Expense Category</label>
							</div>
							<div class="col-12 col-md-9">
								<select class="form-control" name="category" id="category">
									@foreach($categories as $category)
										<option value="{{$category->id}}">{{$category->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Amount</label>
							</div>
							<div class="col-12 col-md-9">
								<input type="text" name="amount" id="amount" class = "form-control input_format_1" placeholder="00.00">
							</div>
						</div>

						<div class="row form-group">
							<div class="col col-md-3">
								<label class=" form-control-label">Entry Date</label>
							</div>
							<div class="col-12 col-md-9">
							<div class="input-group">
								<input type="text" class="form-control" id="entry_date" name="entry_date" autocomplete="off" placeholder="YYYY-mm-dd">
								<span class="input-group-btn" id="icon_here"></span>
							</div>
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

