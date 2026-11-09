use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

public function store(Request $request)
{
    $barang = Barang::find($request->id_barang);

    // ❗ CEK STOK cukup atau tidak
    if ($barang->stok < $request->jumlah) {
        return redirect()->back()->with('error', 'Stok tidak cukup');
    }

    // simpan transaksi keluar
    BarangKeluar::create([
        'id_barang' => $request->id_barang,
        'jumlah'    => $request->jumlah,
        'tanggal'   => $request->tanggal,
    ]);

    // 🔥 update stok (KURANG)
    $barang->stok -= $request->jumlah;
    $barang->save();

    return redirect()->back()->with('success', 'Barang keluar berhasil');
}