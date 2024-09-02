@if($finances->count())
    @foreach ($finances as $finance)
    <input type="hidden" name="price_type_id[]" value="{{ $finance->price_type_id }}">
    <div class="col-md-12 col-12">
        <div class="form-group">
            <label for="first-name-column">{{ $finance->priceType->name??''}} - {{ __('admin.still_amount') }} ({{str_replace(',','',$finance->required_amount) - str_replace(',','',$finance->paid_amount)}})</label>
            <div class="controls">
                <input type="text" name="amount[]" class="form-control" placeholder="{{ __('admin.amount') }}">
            </div>
        </div>
    </div>
    @endforeach
@else
<div class="d-flex flex-column w-100 align-center mt-4">
    <span class="mt-2" style="font-family: cairo">{{__('admin.no_still_amounts')}}</span>
</div>
@endif