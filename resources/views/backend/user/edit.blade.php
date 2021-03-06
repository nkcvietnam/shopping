@extends('admin.master')

@section('content-header')
	<section class="content-header">
		<h1>
			Thêm người dùng
			<small>Control panel</small>
		</h1>
		<ul class="breadcrumb ">
			<li>
				<a href="{{ url('') }}"><i class="fa fa-dashboard"></i> Home</a>
			</li>
			<li class="active">Danh sách người dùng</li>
		</ul>
	</section>
@endsection
@section('content')
<div class="content">
	<style type="text/css">
		th{
			width:20%;
		}
		textarea{
			max-width:330px;
			max-height:120px;
		}
		.right{
			float:right;
		}
	</style>

	<div class="box box-default">
		<div class="box-header">
			<a href="{{ route('admin.user.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" method="post" >

				{{ csrf_field() }}
				<div class="form-group {{ !empty($errors->first('name')) ? 'has-error' : ''}}">
					<label class="control-label col-md-2" for="name">Tên đăng nhập:<small></small></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="name" id="name" value="{{{ $user->name }}}" placeholder="Nhập tên người dùng" disabled>
						<span class="error">{{ $errors->first('name') }}</span>
					</div>
				</div>
				<div class="form-group {{ !empty($errors->first('fullname')) ? 'has-error' : ''}}">
					<label class="control-label col-md-2" for="fullname">Tên người dùng:<small></small></label>
					<div class="col-md-4">
						<input type="text" class="form-control" name="fullname" value="{{{ $user->fullname }}}" id="fullname" placeholder="Nhập tên người dùng">
						<span class="error">{{ $errors->first('fullname') }}</span>
					</div>
				</div>
				<div class="form-group {{ !empty($errors->first('email')) ? 'has-error' : ''}}">
					<label class="control-label col-md-2" for="email">Email:</label>
					<div class="col-md-4">
						<input type="email" class="form-control" name="email" value="{{{ $user->email }}}" id="email" placeholder="Nhập Email">
						<span class="error">{{ $errors->first('email') }}</span>
					</div>
				</div>
				<hr>
				<div class="form-group {{ !empty($errors->first('birthday')) ? 'has-error' : ''}}">
					
					<label class="control-label col-md-2" for="birthday">Ngày sinh:</label>
					<div class="col-md-4"> 
						<input type="date" class="form-control" id="birthday" value="{{ !empty($errors->first('birthday')) ? date('m-d-Y',strtotime($errors->first('birthday'))) : '' }}" name="birthday">
						<span class="error">{{ $errors->first('birthday') }}</span>
					</div>
					
				</div>
				<div class="form-group {{ !empty($errors->first('phone')) ? 'has-error' : ''}}">
					<label class="control-label col-md-2" for="phone">Số điện thoại:</label>
					<div class="col-md-4"> 
						<input type="text" class="form-control" id="phone" value="{{ $user->phone }}" placeholder="Số điện thoại" name="phone">
						<span class="error">{{ $errors->first('phone') }}</span>
					</div>
				</div>
				<div class="form-group {{ !empty($errors->first('address')) ? 'has-error' : ''}}">
					<label class="control-label col-md-2" for="address">Địa chỉ:</label>
					<div class="col-md-4"> 
						<textarea rows="4" class="form-control" id="address"  name="address">{{{ $user->address }}}</textarea>
						<span class="error">{{ $errors->first('address') }}</span>
					</div>
				</div>
				<div class="form-group"> 	
					<div class="col-md-offset-2 col-md-4">
						<input type="submit" name="dangki" class="btn btn-warning btn-sm" value="Thay đổi">
						<input type="reset" name="reset" value="Nhập lại" class="btn btn-default btn-sm">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection