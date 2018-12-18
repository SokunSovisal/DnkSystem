@extends('layouts.app')

@section('css')
	<style type="text/css">

	</style>
@endsection

@section('content')
	
	<section class="bg-white">

		<!-- Add Button & Error Message -->
		@component('comps.btnAdd')
			@slot('btnAdd')
				{{route('users.create')}}
			@endslot
		@endcomponent
		
		<br/>
		<br/>
		<table class="table table-striped table-hover" id="dataTable">
			<thead>
				<tr>
					<th width="5%">N&deg;</th>
					<th>ឈ្មោះ</th>
					<th>លេខទូរស័ព្ទ</th>
					<th>តួនាទី</th>
					<th>រូបភាព</th>
					<th width="108px">ប្ដូរពាក្យសម្ងាត់</th>
					<th width="100px">ដំណើរការ</th>
					<th width="10%">សកម្មភាព</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $i => $user)
				<tr>
					<td>{{ $i+1 }}</td>
					<td>{{ $user->name}}</td>
					<td>{{ $user->phone }}</td>
					<td>{{ $user->position }}</td>
					<td><a href="{{ route('users.image',$user->id) }}" title="Click to Change Image" class="img_column"><span class="img_icon fa fa-pencil-alt"></span><span class="img" style="background: url('/images/user/{{$user->image}}') center center no-repeat; background-size: cover;" /></span></a></td>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('users.password',$user->id) }}" title="Click to Change Password" class="btn btn-info"><i class="fa fa-key"></i></a></td>
					<td>
						{{Form::open(['url'=>route('users.status',$user->id)])}}
							{{Form::hidden('_method','PUT')}}
							<input type="hidden" name="status" value="{{(($user->status==1)?'0':'1')}}"/>
							<button type="button" style="margin-left: 8px;" class="status btn btn-{{(($user->status==1)?'success':'danger')}}" title="ចុចដើម្បី {{(($user->status==1)?'បិទ':'បើក')}}គណនី" data-text="តើអ្នកចង់{{(($user->status==1)?'បិទ':'បើក')}}គណនីអ្នកប្រើប្រាស់មួយនេះមែនទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="គណនីនេះត្រូវបាន{{(($user->status==1)?'បិទ':'បើក')}}."><i class="fa fa-{{(($user->status==1)?'check-circle':'ban')}}"></i></button>
							<button type="submit" class="sub_delete sr-only"></button>
						{{Form::close()}}</td>
					<td class="action">
						<a href="{{route('users.edit',$user->id)}}" title="Edit Information" class="edit text-info"><i class="fa fa-pencil-alt"></i></a>
						/
						{{Form::open(['url'=>route('users.destroy',$user->id)])}}
							{{Form::hidden('_method','DELETE')}}
							<button type="button" title="លុបអ្នកប្រើប្រាស់" class="delete text-danger" data-text="តើអ្នកចង់លុបអ្នកប្រើប្រាស់នេះមែទេ?" data-type="warning" data-rstitle="ជោគជ័យ" data-rstext="អ្នកប្រើប្រាស់ត្រូវបានលុប."><i class="fa fa-trash-alt"></i>
							</button>
							<button type="submit" class="sub_delete sr-only"></button>
						{{Form::close()}}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</section>
@endsection

@section('js')
	<script type="text/javascript">
		// Alert Status
		$("button.status").click(alertYesNo);
		// Alert Delete
		$("button.delete").click(alertYesNo);
	</script>
@endsection
