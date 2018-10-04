<!-- 檔案目錄：resources/views/merchandise/editMerchandise.blade.php -->

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

		<form action="/merchandise/{{ $Merchandise->id }}" 
					method="post" 
					enctype="multipart/form-data"
					>
		
			{{-- 隱藏方法欄位 --}}
      {{ method_field('PUT') }}

			<label >
				{{ trans('shop.merchandise.fields.status-name') }}：
				<select name="status">
					<option value="C"
						@if(old('status', $Merchandise->status)=='C') 
							selected 
						@endif					
					>
					{{ trans('shop.merchandise.fields.status.create') }}
					</option>
				
					<option value="S"
						@if(old('status', $Merchandise->status)=='S') 
							selected 
						@endif					
					>
					{{ trans('shop.merchandise.fields.status.sell') }}
					</option>
				</select>		
			</label>
		
			<label >
				{{ trans('shop.merchandise.fields.name') }}：
				<input type="text" name="name" placeholder="{{ trans('shop.merchandise.fields.name') }}" 
				value="{{ old('name', $Merchandise->name) }}"
				>
			</label>

			<label >
				{{ trans('shop.merchandise.fields.name-en') }}：
				<input type="text" name="name_en" placeholder="{{ trans('shop.merchandise.fields.name-en') }}" 
				value="{{ old('name_en', $Merchandise->name_en) }}"
				>
			</label>

			<label >
				{{ trans('shop.merchandise.fields.introduction') }}：
				<input type="text" name="introduction" placeholder="{{ trans('shop.merchandise.fields.introduction') }}" 
				value="{{ old('introduction', $Merchandise->introduction) }}"
				>
			</label>

			<label >
				{{ trans('shop.merchandise.fields.introduction-en') }}：
				<input type="text" name="introduction_en" placeholder="{{ trans('shop.merchandise.fields.introduction-en') }}" 
				value="{{ old('introduction_en', $Merchandise->introduction_en) }}"
				>
			</label>

			<label >
				{{ trans('shop.merchandise.fields.photo') }}：
				<input type="file" name="photo" placeholder="{{ trans('shop.merchandise.fields.photo') }}" 
				>
				@if (!is_null($Merchandise->photo))
					<img src="{{ $Merchandise->photo }}" />
				@else
					<img src="{{ '/assets/images/default-merchandise.png' }}" />
				@endif
						<!-- {{ var_dump($Merchandise) }} -->
		<!-- {{ var_dump($Merchandise->photo) }} -->
			</label>

			<label >
				{{ trans('shop.merchandise.fields.price') }}：
				<input type="text" name="price"" placeholder="{{ trans('shop.merchandise.fields.price') }}" 
				value="{{ old('price', $Merchandise->price) }}"
				>
			</label>

			<label >
				{{ trans('shop.merchandise.fields.remain-count') }}：
				<input type="text" name="remain_count" placeholder="{{ trans('shop.merchandise.fields.remain-count') }}" 
				value="{{ old('remain_count', $Merchandise->remain_count) }}"
				>
			</label>

			<button type="submit" class="btn btn-default">{{ trans('shop.merchandise.update') }}</button>

			{{ csrf_field() }}
		</form>
	</div>
@endsection
