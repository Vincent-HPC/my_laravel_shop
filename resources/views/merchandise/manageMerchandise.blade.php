<!-- 檔案目錄：resources/views/merchandise/manageMerchandise.blade.php -->

<!-- 指定繼承 layout.master 母模板 -->
@extends('layout.master')

<!-- 傳送資料到母模板，並指定變數為 title -->
@section('title', $title)


<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content')
	<div class="container">
		<h1>{{ $title }}</h1>
		
			{{-- 錯誤訊息模板元件 --}}
			@include('components.validationErrorMessage')

			<table class="table">
				<tr>
					<th>{{ trans('shop.merchandise.fields.id') }}</th>
					<th>{{ trans('shop.merchandise.fields.name') }}</th>
					<th>{{ trans('shop.merchandise.fields.photo') }}</th>
					<th>{{ trans('shop.merchandise.fields.status-name') }}</th>
					<th>{{ trans('shop.merchandise.fields.price') }}</th>
					<th>{{ trans('shop.merchandise.fields.remain-count') }}</th>
					<th>{{ trans('shop.merchandise.edit') }}</th>			
				</tr>
				@foreach($MerchandisePaginate as $Merchandise)
					<tr>
						<td> {{ $Merchandise->id }}</td>
						<td> {{ $Merchandise->name }}</td>
						<td>
							@if (!is_null($Merchandise->photo))
								<img src="{{ $Merchandise->photo }}" />
							@else
								<img src="{{ '/assets/images/default-merchandise.png' }}" />
							@endif
						</td>
						<td>
							@if($Merchandise->status == 'C')
								{{ trans('shop.merchandise.fields.status.create') }}
							@else
								{{ trans('shop.merchandise.fields.status.sell') }}
							@endif
						</td>
						<td> {{ $Merchandise->price }}</td>
						<td> {{ $Merchandise->remain_count }}</td>
						<td>
							<a href="/merchandise/{{ $Merchandise->id }}/edit">
								{{ trans('shop.merchandise.edit') }}
							</a>
						</td>
					
					</tr>
				@endforeach
			</table>

			{{-- 分頁頁數按鈕 --}}
			{{ $MerchandisePaginate->links() }}
	
	</div>
@endsection
