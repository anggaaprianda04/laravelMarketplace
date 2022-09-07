<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Markettani</title>
</head>

<body>
    <h2>Laporan</h2>
    <div>
        <table align="left" rules="all" border="1px" style="width: 35%;margin-right: 20px;text-align: left">
            <thead class="bg-gray-50">
                <tr>
                    <th style="padding: 10px" scope="col">Total
                        Produk Terjual</th>
                    <td scope="col" style="text-align: left;padding: 10px">
                        {{ $totalQuantity }} Produk
                    </td>
                </tr>
            </thead>
            <thead class="bg-gray-50">
                <tr class="text-gray-500">
                    <th scope="col" style="padding: 10px">Total Produk
                    </th>
                    <td scope="col" style="text-align: left;padding: 10px">
                        {{ $totalProduct }} Produk
                </tr>
            </thead>
            <thead class="bg-gray-50">
                <tr class="text-gray-500">
                    <th scope="col" style="padding: 10px">Total User
                    </th>
                    <td scope="col" style="text-align: left;padding: 10px">
                        {{ $totalUser }} User
                </tr>
            </thead>
            <thead class="bg-gray-50">
                <tr class="text-gray-500">
                    <th scope="col" style="padding: 10px">Total Toko
                    </th>
                    <td scope="col" style="text-align: left;padding: 10px">
                        {{ $totalMarket }} Toko
                </tr>
            </thead>
            <thead class="bg-gray-50">
                <tr class="text-gray-500">
                    <th scope="col" style="padding: 10px">Total
                        Kategori</th>
                    <td scope="col"style="text-align: left;padding: 10px">
                        {{ $totalCategory }} Kategori
                </tr>
            </thead>
            <thead class="bg-gray-50">
                <tr class="text-gray-500">
                    <th scope="col" style="padding: 10px">Total Harga
                        Semua Produk Terjual</th>
                    <td scope="col" style="text-align: left;padding: 10px">
                        Rp. {{ $totalPrice }}
                </tr>
            </thead>

        </table>
        <div class="shadow overflow-hidden  border-gray-200 sm:rounded-lg">
            <table rules="all" border="1px" style="width: 40%">
                <thead class="bg-gray-500">
                    <tr>
                        <th scope="col" style="padding: 10px">No</th>
                        <th scope="col" style="padding: 10px">Alamat</th>
                        <th scope="col" style="padding: 10px">Status</th>
                        <th scope="col" style="padding: 10px">Total Harga</th>
                        <th scope="col" style="padding: 10px">Waktu Transaksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php
                        $num = 1;
                    @endphp
                    @forelse ($order as $item)
                        <tr>
                            <td style="text-align: center;padding: 10px">
                                {{ $num++ }}</td>

                            <td style="text-align: left;padding: 10px">
                                {{ $item->address }}
                            </td>
                            <td style="text-align: left;padding: 10px">
                                {{ $item->status }}
                            </td>
                            <td style="text-align: left;padding: 10px">
                                {{ $item->total_price }}</td>
                            <td style="text-align: left;padding: 10px">
                                {{ $item->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border text-center p-5">
                                Data Tidak Ditemukan
                            </td>
                        </tr>
                    @endforelse

                    <!-- More people... -->
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>
