<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('signup', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('carte_nationale');
            $table->string('numero_telephone');
            $table->string('email')->unique();
            $table->date('date_naissance');
            $table->string('mot_de_passe');
            $table->string('verification_mot_de_passe');
            $table->enum('filiere', [
                'Atelier de cuisine',
                'Atelier de coiffeur',
                'Atelier de tailleur moderne( الفصالة والخياطةالعصرية)',
                'Atelier de tailleur traditionnelle( الفصالة والخياطةالتقليدية)',
                'Atelier de broderie machine(ورشة الطرز بالالة)',
                'Atelier de broderie à la main(ورشة الطرز باليد)'
            ])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signup');
    }
};
