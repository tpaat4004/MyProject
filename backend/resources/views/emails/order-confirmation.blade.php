<h1>Cảm ơn bạn đã mua hàng!</h1>
<p>Xin chào {{ $name }},</p>
<p>Cảm ơn bạn đã đặt hàng tại cửa hàng chúng tôi. Dưới đây là thông tin đơn hàng của bạn:</p>
<ul>
    <li>Số điện thoại: {{ $phone }}</li>
    <li>Địa chỉ: {{ $address }}</li>
    <li>Tổng tiền: {{ number_format($total, 0, ',', '.') }} VND</li>
</ul>
<p>Chúng tôi sẽ sớm giao hàng đến địa chỉ bạn đã cung cấp.</p>
<p>Trân trọng,</p>
<p>Đội ngũ của chúng tôi</p>
