@component('mail::message')
# Your Yearbook Order is Ready for Claim

Dear {{ $order->user->first_name }},

Your yearbook order (#{{ $order->order_number }}) is now ready for claim. Please bring a valid ID when claiming your order.

## Order Details:
@foreach($order->items as $item)
- {{ $item->yearbookPlatform->name }} ({{ $item->quantity }}x)
@endforeach

Total Amount: ₱{{ number_format($order->total_amount, 2) }}

@if($order->admin_notes)
**Admin Notes:**
{{ $order->admin_notes }}
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent 