<p>Hello {{ $order->client->name }},</p>
<p>Your order has been created successfully!</p>

<p>See your order's details below:</p>

<p>
    <b>Order ID:</b> #{{ $order->id }}<br><br>
    <b>Itens:</b><br>

    <?php $total = 0; ?>
    @foreach ($order->products as $product)
        {{ $product->name }}&emsp;-&emsp;R$ {{ number_format($product->price, 2, ',', '.') }}<br>
        <?php $total += $product->price; ?>
    @endforeach

    <br>
    <b>Total: </b>R$ {{ number_format($total, 2, ',', '.') }}
    <br>

    <b>Delivery Address:</b> {{ $order->client->address }} @if($order->client->address_complement) {{ ' - ' . $order->client->address_complement }} @endif
</p>