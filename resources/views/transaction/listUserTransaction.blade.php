<!-- 檔案目錄：resources/views/transaction/listUserTransaction.blade.php -->

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
					<th>{{ trans('shop.transaction.fields.name') }}</th>
					<th>{{ trans('shop.transaction.fields.photo') }}</th>
					<th>{{ trans('shop.transaction.fields.price') }}</th>
					<th>{{ trans('shop.transaction.fields.count') }}</th>
					<th>{{ trans('shop.transaction.fields.total-count') }}</th>
					<th>{{ trans('shop.transaction.fields.buy-time') }}</th>
				</tr>
				@foreach($TransactionPaginate as $Transaction)
					<tr>
						<td>
							<a href="/merchandise/{{ $Transaction->Merchandise->id }}">
									{{ $Transaction->Merchandise->name }}
							</a>
						</td>
						<td>
							<a href="/merchandise/{{ $Transaction->Merchandise->id }}">
									@if (!is_null($Transaction->Merchandise->photo))
										<img src="{{ $Transaction->Merchandise->photo }}" />
									@else
										<img src="{{ '/assets/images/default-merchandise.png' }}" />
									@endif
							</a>
						</td>
						<td>{{ $Transaction->price }}</td>
						<td>{{ $Transaction->buy_count }}</td>
						<td>{{ $Transaction->total_price }}</td>
						<td>{{ $Transaction->created_at }}</td>
					</tr>
        @endforeach
				</table>

					{{-- 分頁頁數按鈕 --}}
					{{ $TransactionPaginate->links() }}
@endsection
