@component('mail::message')
# @lang('Order Placed')

@component('mail::table')
    | @lang('Item')       | @lang('Qty')         | @lang('Price')  |
    | :------------- |:-------------:| --------:|
    @foreach($items as $item)
        | {{$item->name}}      | {{$item->pivot->qty}} | {{$item->price}} zł     |
        @endforeach
    |               | <span style="color:#000; font-weight: bold">@lang('Total') </span> | <span style="color:#000; font-weight: bold">{{$order->value}} zł</span>  |
@endcomponent

{{--@component('mail::button', ['url' => '', 'color' => 'success'])--}}
{{--    @lang('View your order')--}}
{{--@endcomponent--}}

@lang('Have a nice day'),<br>
{{ config('app.name') }}
@endcomponent
