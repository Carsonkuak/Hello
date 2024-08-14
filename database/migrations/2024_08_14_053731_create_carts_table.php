<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('vege_product_id')->constrained("vege_product")->onDelete('cascade');
            $table->decimal('mass', 8, 2);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
        
    }

    public function down()
    {   
        
        Schema::dropIfExists('carts');
    }
}

