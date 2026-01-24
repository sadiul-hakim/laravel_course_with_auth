<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("test", function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            // $table->bigInteger("likes");
            // $table->decimal("amount1", 8, 2);
            // $table->float("amount2");
            // $table->string("title");
            // $table->text("summery");
            // $table->longText("content");
            // $table->morphs("taggable");
            // $table->string("email")->unique();
            // $table->index("name");
            // $table->index(["name", "email"]);
            // $table->unsignedBigInteger("user_id");
            // $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            // $table->boolean("confirmed");
            // $table->dateTime("created_at2", 0);
            // $table->enum("difficulty", ['easy', 'hard']);
            // $table->json("metadata")->nullable();

            // $table->string("email", 100)->nullable()->default("example@gmail.com");
            // $table->integer("num")->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
