<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Pilih Pengiriman</title>
<link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
<style>
  * {
    box-sizing: border-box;
  }
  body {
    margin: 0;
    font-family: 'Inter', sans-serif;
    background: #fff;
    color: #222;
  }
  .container {
    max-width: 720px;
    margin: 20px auto;
    border: 1px solid #222;
    padding: 16px 20px 20px 20px;
  }
  h2 {
    font-weight: 700;
    font-size: 18px;
    margin: 0 0 8px 0;
    border-bottom: 1px solid #ccc;
    padding-bottom: 6px;
    position: relative;
  }
  h2::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 0;
    width: 48px;
    height: 2px;
    background-color: #f15a29;
  }
  label {
    font-weight: 600;
    font-size: 13px;
    display: block;
    margin: 12px 0 4px 0;
  }
  select, input[type="text"], textarea {
    width: 100%;
    font-family: 'Inter', sans-serif;
    font-size: 13px;
    padding: 6px 8px;
    border: 1px solid #ccc;
    border-radius: 0;
    resize: vertical;
    color: #222;
  }
  select {
    height: 32px;
  }
  textarea {
    min-height: 40px;
  }
  input[type="text"] {
    height: 28px;
  }
  button {
    margin-top: 12px;
    background-color: #222222;
    color: #fff;
    font-weight: 700;
    font-size: 13px;
    border: none;
    padding: 8px 14px;
    cursor: pointer;
    text-transform: uppercase;
  }
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 12px;
    color: #222;
  }
  thead tr {
    border-bottom: 1px solid #ccc;
  }
  thead th {
    font-weight: 700;
    padding: 6px 4px 6px 4px;
    text-align: left;
  }
  tbody tr {
    border-bottom: 1px solid #ccc;
  }
  tbody td {
    padding: 8px 4px 8px 4px;
    vertical-align: middle;
  }
  tbody td:nth-child(1) {
    width: 10%;
  }
  tbody td:nth-child(2) {
    width: 20%;
  }
  tbody td:nth-child(3) {
    width: 20%;
  }
  tbody td:nth-child(4) {
    width: 15%;
  }
  tbody td:nth-child(5) {
    width: 15%;
  }
  tbody td:nth-child(6) {
    width: 20%;
  }
  .btn-pilih {
    background-color: #f15a29;
    border: none;
    color: #fff;
    font-weight: 700;
    font-size: 12px;
    padding: 8px 14px;
    cursor: pointer;
    text-transform: uppercase;
  }
  @media (max-width: 480px) {
    .container {
      margin: 10px;
      padding: 12px 14px 14px 14px;
    }
    h2 {
      font-size: 16px;
    }
    label {
      font-size: 12px;
    }
    select, input[type="text"], textarea {
      font-size: 12px;
    }
    button, .btn-pilih {
      font-size: 11px;
      padding: 6px 10px;
    }
    table, thead, tbody, th, td, tr {
      display: block;
    }
    thead tr {
      display: none;
    }
    tbody tr {
      margin-bottom: 12px;
      border-bottom: 1px solid #ccc;
      padding-bottom: 8px;
    }
    tbody td {
      padding-left: 50%;
      position: relative;
      text-align: left;
      border: none;
      padding-top: 4px;
      padding-bottom: 4px;
    }
    tbody td::before {
      position: absolute;
      top: 50%;
      left: 8px;
      width: 45%;
      white-space: nowrap;
      transform: translateY(-50%);
      font-weight: 700;
      font-size: 11px;
      color: #222;
    }
    tbody td:nth-child(1)::before { content: "Layanan"; }
    tbody td:nth-child(2)::before { content: "Biaya"; }
    tbody td:nth-child(3)::before { content: "Estimasi Pengiriman"; }
    tbody td:nth-child(4)::before { content: "Total Berat"; }
    tbody td:nth-child(5)::before { content: "Total Harga"; }
    tbody td:nth-child(6)::before { content: "Bayar"; }
    tbody td:nth-child(6) {
      padding-left: 0;
      text-align: right;
    }
  }
</style>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const provinceSelect = document.getElementById('province_id');
    const citySelect = document.getElementById('city_id');
    const courierSelect = document.getElementById('kurir');
    const checkOngkirBtn = document.getElementById('check_ongkir');
    const ongkirTableBody = document.getElementById('ongkir_table_body');
    const totalBeratInput = document.getElementById('total_berat');
    const alamatInput = document.getElementById('alamat');
    const posInput = document.getElementById('pos');
    const provinceNameInput = document.getElementById('province_name');
    const cityNameInput = document.getElementById('city_name');
    const ongkirForm = document.getElementById('ongkir_form');

    // Load provinces on page load
    fetchProvinces();

    provinceSelect.addEventListener('change', function() {
      const provinceId = this.value;
      if(provinceId) {
        fetchCities(provinceId);
      } else {
        citySelect.innerHTML = '<option value="">Pilih Kota</option>';
      }
    });

    checkOngkirBtn.addEventListener('click', function(e) {
      e.preventDefault();
      const origin = '501'; // example origin city id, should be set accordingly
      const destination = citySelect.value;
      const weight = totalBeratInput.value;
      const courier = courierSelect.value;

      if(!destination) {
        alert('Pilih Kota Tujuan terlebih dahulu');
        return;
      }
      if(!courier) {
        alert('Pilih Kurir terlebih dahulu');
        return;
      }

      fetchCost(origin, destination, weight, courier);
    });

    function fetchProvinces() {
      fetch('/provinces')
        .then(res => res.json())
        .then(data => {
          if(data.rajaongkir && data.rajaongkir.results) {
            provinceSelect.innerHTML = '<option value="">Pilih Provinsi</option>';
            data.rajaongkir.results.forEach(province => {
              provinceSelect.innerHTML += `<option value="${province.province_id}">${province.province}</option>`;
            });
          }
        });
    }

    function fetchCities(provinceId) {
      fetch('/cities?province_id=' + provinceId)
        .then(res => res.json())
        .then(data => {
          if(data.rajaongkir && data.rajaongkir.results) {
            citySelect.innerHTML = '<option value="">Pilih Kota</option>';
            data.rajaongkir.results.forEach(city => {
              citySelect.innerHTML += `<option value="${city.city_id}" data-type="${city.type}" data-city-name="${city.city_name}">${city.type} ${city.city_name}</option>`;
            });
          }
        });
    }

    function fetchCost(origin, destination, weight, courier) {
      fetch('/cost', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          origin: origin,
          destination: destination,
          weight: weight,
          courier: courier
        })
      })
      .then(res => res.json())
      .then(data => {
        if(data.rajaongkir && data.rajaongkir.results && data.rajaongkir.results.length > 0) {
          const costs = data.rajaongkir.results[0].costs;
          ongkirTableBody.innerHTML = '';
          costs.forEach(cost => {
            const service = cost.service;
            const costValue = cost.cost[0].value;
            const etd = cost.cost[0].etd;
            const etdText = etd ? etd + ' hari' : '-';
            const totalBeratText = weight + ' Gram';
            const totalHargaText = 'Rp. ' + costValue.toLocaleString('id-ID');
            const biayaRupiah = costValue;

            const tr = document.createElement('tr');
            tr.innerHTML = `
              <td>${service}</td>
              <td>${biayaRupiah.toLocaleString('id-ID')} Rupiah</td>
              <td>${etdText}</td>
              <td>${totalBeratText}</td>
              <td>${totalHargaText}</td>
              <td>
                <button type="button" class="btn-pilih" data-service="${service}" data-biaya="${biayaRupiah}" data-etd="${etdText}">PILIH PENGIRIMAN</button>
              </td>
            `;
            ongkirTableBody.appendChild(tr);
          });

          // Add event listeners to pilih buttons
          document.querySelectorAll('.btn-pilih').forEach(button => {
            button.addEventListener('click', function() {
              const layanan = this.getAttribute('data-service');
              const biaya = this.getAttribute('data-biaya');
              const estimasi = this.getAttribute('data-etd');
              const kurir = courierSelect.value;
              const alamat = alamatInput.value;
              const pos = posInput.value;
              const provinceName = provinceSelect.options[provinceSelect.selectedIndex].text;
              const cityName = citySelect.options[citySelect.selectedIndex].text;

              // Set hidden inputs and submit form
              document.getElementById('layanan_ongkir').value = layanan;
              document.getElementById('biaya_ongkir').value = biaya;
              document.getElementById('estimasi_ongkir').value = estimasi;
              document.getElementById('kurir').value = kurir;
              document.getElementById('total_berat').value = weight;
              document.getElementById('alamat_full').value = alamat;
              document.getElementById('pos').value = pos;
              document.getElementById('province_name').value = provinceName;
              document.getElementById('city_name').value = cityName;

              ongkirForm.submit();
            });
          });
        } else {
          ongkirTableBody.innerHTML = '<tr><td colspan="6">Tidak ada data ongkir</td></tr>';
        }
      });
    }
  });
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div class="container" role="main">
    <h2>PILIH PENGIRIMAN</h2>
    <form id="ongkir_form" method="POST" action="{{ route('order.updateongkir') }}">
      @csrf
      <label for="province_id">Provinsi Tujuan:</label>
      <select id="province_id" name="province_id" required aria-label="Provinsi Tujuan">
        <option value="">Pilih Provinsi</option>
      </select>

      <label for="city_id">Kota Tujuan:</label>
      <select id="city_id" name="city_id" required aria-label="Kota Tujuan">
        <option value="">Pilih Kota</option>
      </select>

      <label for="kurir">Kurir:</label>
      <select id="kurir" name="kurir" required aria-label="Kurir">
        <option value="">Pilih Kurir</option>
        <option value="jne">JNE</option>
        <option value="pos">POS</option>
        <option value="tiki">TIKI</option>
      </select>

      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat" required aria-label="Alamat">Jl. Sawo No. 4 RT/RW 09/10</textarea>

      <label for="pos">Kode Pos</label>
      <input type="text" id="pos" name="pos" required aria-label="Kode Pos" value="52114" />

      <input type="hidden" id="layanan_ongkir" name="layanan_ongkir" />
      <input type="hidden" id="biaya_ongkir" name="biaya_ongkir" />
      <input type="hidden" id="estimasi_ongkir" name="estimasi_ongkir" />
      <input type="hidden" id="total_berat" name="total_berat" value="{{ $order->total_berat ?? 2480 }}" />
      <input type="hidden" id="alamat_full" name="alamat_full" />
      <input type="hidden" id="province_name" name="province_name" />
      <input type="hidden" id="city_name" name="city_name" />

      <button id="check_ongkir" type="button" aria-label="Cek Ongkir">CEK ONGKIR</button>
    </form>

    <table role="table" aria-label="Daftar pilihan pengiriman">
      <thead>
        <tr>
          <th scope="col">LAYANAN</th>
          <th scope="col">BIAYA</th>
          <th scope="col">ESTIMASI PENGIRIMAN</th>
          <th scope="col">TOTAL BERAT</th>
          <th scope="col">TOTAL HARGA</th>
          <th scope="col">BAYAR</th>
        </tr>
      </thead>
      <tbody id="ongkir_table_body">
        <tr>
          <td colspan="6" style="text-align:center; font-style: italic;">Silakan klik CEK ONGKIR untuk melihat pilihan pengiriman</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>