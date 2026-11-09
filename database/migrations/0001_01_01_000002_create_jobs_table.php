<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration {
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 20)->unique();
            $table->string('nama_barang', 100);
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            $table->integer('stok_tersedia')->default(0);
            $table->decimal('harga', 15, 2)->default(0);
            $table->enum('status', ['tersedia', 'habis', 'discontinue'])->default('tersedia');
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};