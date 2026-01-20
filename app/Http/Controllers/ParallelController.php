<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ParallelController extends Controller
{
    private function getUsersFromDB(): Collection
    {
        return User::all();
    }

    public function getUsersFromApi()
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
        return $response->json();
    }
}
