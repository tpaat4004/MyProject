<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
</head>
<body>
    <h1>Cảm ơn bạn đã thanh toán!</h1>
    <p>Xin chào {{ $name }},</p>
    <p>Cảm ơn bạn đã đặt hàng và hoàn tất thanh toán qua VNPay tại cửa hàng chúng tôi. Dưới đây là thông tin đơn hàng của bạn:</p>
    <ul>
        <li>Số điện thoại: {{ $phone }}</li>
        <li>Địa chỉ: {{ $address }}</li>
        <li>Mã giao dịch VNPay: {{ $vnp_TxnRef }}</li>
        <li>Tổng tiền: {{ number_format($total, 0, ',', '.') }} VND</li>
        <li>Trạng thái thanh toán: <strong>{{ $payment_status }}</strong></li>
    </ul>
    <p>Chúng tôi sẽ sớm giao hàng đến địa chỉ bạn đã cung cấp.</p>
    <p>Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ với chúng tôi qua số điện thoại hoặc email hỗ trợ.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ của chúng tôi</p>
</body>
</html>
