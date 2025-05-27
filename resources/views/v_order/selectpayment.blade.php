<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Keranjang Belanja
  </title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
  <style>
   * {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    color: #222222;
    background: #fff;
  }
  .container {
    max-width: 900px;
    margin: 20px auto;
    padding: 0 15px;
    border: 1px solid #000;
  }
  h2 {
    font-weight: 700;
    font-size: 18px;
    margin: 20px 0 10px 0;
    border-bottom: 1px solid #ccc;
    padding-bottom: 6px;
    position: relative;
    display: inline-block;
  }
  h2::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 2px;
    background: #f26a43;
  }
  table {
    width: 100%;
    border-collapse: collapse;
  }
  thead tr {
    border-bottom: 1px solid #ccc;
  }
  thead th {
    font-weight: 700;
    text-align: left;
    padding: 10px 0;
    font-size: 13px;
    color: #222222;
  }
  thead th:nth-child(2),
  thead th:nth-child(3),
  thead th:nth-child(4) {
    text-align: center;
  }
  tbody tr {
    border-bottom: 1px solid #eee;
  }
  tbody td {
    vertical-align: top;
    padding: 10px 0;
  }
  .product-info {
    display: flex;
    gap: 10px;
    align-items: flex-start;
  }
  .product-info img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    flex-shrink: 0;
  }
  .product-text {
    flex: 1;
  }
  .product-text strong {
    font-weight: 700;
    font-size: 15px;
    color: #222222;
    display: block;
    margin-bottom: 4px;
  }
  .product-text .weight,
  .product-text .stock {
    font-weight: 400;
    font-size: 12px;
    color: #222222;
    line-height: 1.3;
  }
  .price,
  .total {
    font-weight: 700;
    font-size: 15px;
    color: #222222;
  }
  .price {
    text-align: center;
  }
  .quantity {
    text-align: center;
    font-weight: 400;
    font-size: 14px;
    color: #222222;
  }
  .total {
    text-align: center;
    color: #f26a43;
  }
  .summary-container {
    display: flex;
    justify-content: flex-end;
    margin-top: 10px;
  }
  .summary-table {
    border: 1px solid #eee;
    border-left: none;
    width: 320px;
    border-collapse: collapse;
  }
  .summary-table td {
    border-left: 1px solid #eee;
    padding: 10px 15px;
    font-size: 14px;
    vertical-align: top;
  }
  .summary-table tr:first-child td {
    border-top: none;
  }
  .summary-table tr td:first-child {
    font-weight: 700;
    font-size: 14px;
    color: #222222;
    width: 120px;
  }
  .summary-table tr:nth-child(1) td:last-child {
    font-weight: 700;
    font-size: 16px;
    color: #222222;
    text-align: right;
  }
  .summary-table tr:nth-child(2) td:last-child {
    font-weight: 400;
    font-size: 13px;
    color: #222222;
    text-align: right;
    line-height: 1.3;
  }
  .summary-table tr:nth-child(2) td:last-child small {
    display: block;
    font-weight: 400;
    font-size: 12px;
    color: #222222;
    margin-top: 4px;
  }
  .summary-table tr:nth-child(3) td:last-child {
    font-weight: 700;
    font-size: 18px;
    color: #f26a43;
    text-align: right;
  }
  .btn-pay {
    background-color: #f26a43;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    margin: 15px 0 20px 20px;
    align-self: flex-end;
    text-transform: uppercase;
  }
  @media (max-width: 600px) {
    .container {
      margin: 10px;
      border: none;
    }
    h2 {
      font-size: 16px;
      margin: 15px 0 8px 0;
    }
    .product-info {
      flex-direction: row;
      gap: 10px;
    }
    .product-info img {
      width: 50px;
      height: 50px;
    }
    .product-text strong {
      font-size: 14px;
    }
    .price,
    .total {
      font-size: 14px;
    }
    .summary-container {
      justify-content: center;
    }
    .summary-table {
      width: 100%;
      font-size: 13px;
    }
    .btn-pay {
      width: 100%;
      margin: 10px 0 20px 0;
    }
  }
  </style>
 </head>
 <body>
  <div aria-label="Keranjang Belanja" class="container" role="main">
   <h2>
    KERANJANG BELANJA
   </h2>
   <table aria-describedby="shopping-cart">
    <thead>
     <tr>
      <th scope="col">
       PRODUK
      </th>
      <th scope="col">
       HARGA
      </th>
      <th scope="col">
       QUANTITY
      </th>
      <th scope="col">
       TOTAL
      </th>
     </tr>
    </thead>
    <tbody>
    @forelse($order->orderItems as $item)
     <tr>
      <td>
       <div class="product-info">
        <img 
          alt="{{ $item->produk->nama_produk }}" 
          height="60" 
          src="{{ $item->produk->foto ? asset('storage/img-produk/' . $item->produk->foto) : 'https://via.placeholder.com/60' }}" 
          width="60"
        />
        <div class="product-text">
         <strong>
          {{ $item->produk->nama_produk }}
         </strong>
         <div class="weight">
          Berat: {{ $item->produk->berat }} Gram
         </div>
         <div class="stock">
          Stok: {{ $item->produk->stok }} Gram
         </div>
        </div>
       </div>
      </td>
      <td aria-label="Harga" class="price">
       Rp. {{ number_format($item->harga, 0, ',', '.') }}
      </td>
      <td aria-label="Quantity" class="quantity">
       {{ $item->quantity }}
      </td>
      <td aria-label="Total harga produk" class="total">
       Rp. {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}
      </td>
     </tr>
    @empty
     <tr>
      <td colspan="4" style="text-align:center;">Tidak ada produk dalam pesanan.</td>
     </tr>
    @endforelse
    </tbody>
   </table>
   <div aria-label="Ringkasan pembayaran" class="summary-container" role="region">
    <table aria-hidden="true" class="summary-table">
     <tbody>
      <tr>
       <td>
        SUBTOTAL
       </td>
       <td style="text-align:right; font-weight:700; font-size:16px; color:#222222;">
        Rp. {{ number_format($order->total_harga ?? 0, 0, ',', '.') }}
       </td>
      </tr>
      <tr>
       <td>
        Ongkos Kirim
       </td>
       <td style="text-align:right; font-weight:400; font-size:13px; color:#222222;">
        Rp. {{ number_format($order->biaya_ongkir ?? 0, 0, ',', '.') }}
        <br/>
        <small>
         {{ $order->kurir ?? '-' }}{{ $order->layanan_ongkir ? '.' . $order->layanan_ongkir : '' }} 
         {{ $order->estimasi_ongkir ? '*estimasi ' . $order->estimasi_ongkir : '' }}
        </small>
       </td>
      </tr>
      <tr>
       <td>
        TOTAL BAYAR
       </td>
       <td style="text-align:right; font-weight:700; font-size:18px; color:#f26a43;">
        Rp. {{ number_format(($order->total_harga ?? 0) + ($order->biaya_ongkir ?? 0), 0, ',', '.') }}
       </td>
      </tr>
     </tbody>
    </table>
    <button aria-label="Bayar Sekarang" class="btn-pay" type="button" onclick="window.location.href='{{ route('order.selectpayment') }}'">
     BAYAR SEKARANG
    </button>
   </div>
  </div>
 </body>
</html>
