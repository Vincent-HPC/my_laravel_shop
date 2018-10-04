<!-- 檔案目錄：resources/views/merchandise/showMerchandise.blade.php -->

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

			<table>
				<tr>
						<th>{{ trans('shop.merchandise.fields.name') }}</th>
						<td>{{ $Merchandise->name }}</td>
				</tr>
				<tr>
						<th>{{ trans('shop.merchandise.fields.photo') }}</th>
						<td>
							@if (!is_null($Merchandise->photo))
								<img src="{{ $Merchandise->photo }}" />
							@else
								<img src="{{ '/assets/images/default-merchandise.png' }}" />
							@endif
						</td>
				</tr>
				<tr>
						<th>{{ trans('shop.merchandise.fields.price') }}</th>
						<td>
								{{ $Merchandise->price }}
						</td>
				</tr>
				<tr>
						<th>{{ trans('shop.merchandise.fields.remain-count') }}</th>
						<td>
								{{ $Merchandise->remain_count }}
						</td>
				</tr>
				<tr>
						<th>{{ trans('shop.merchandise.fields.introduction') }}</th>
						<td>
								{{ $Merchandise->introduction }}
						</td>
				</tr>
				<tr>
						<td colspan="2">
								<form action="/merchandise/{{ $Merchandise->id }}/buy"
											method="post"
								>
										{{ trans('shop.transaction.fields.buy-count') }}
										<select name="buy_count">
												@for($count = 0; $count <= $Merchandise->remain_count; $count++)
														<option value="{{ $count }}">{{ $count }}</option>
												@endfor
										</select>
										<button type="submit" >
												{{ trans('shop.transaction.buy') }}
										</button>
										{{ csrf_field() }}
								</form>
						</td>
				</tr>
			</table>
	</div>
@endsection
