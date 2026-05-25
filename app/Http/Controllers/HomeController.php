<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use App\Models\Partner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua kategori untuk filter
        $categories = Category::all();

        // 2. Query dasar event
        $query = Event::with('category')
            ->where('date', '>=', now())
            ->orderBy('date', 'asc');

        // 3. Filter berdasarkan kategori (jika ada di URL ?category=...)
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // 4. Ambil data event
        $events = $query->get();

        // 5. Ambil data partner untuk ditampilkan di homepage
        $partners = Partner::all();

        // 6. Kirim ke view
        return view('welcome', compact('events', 'categories', 'partners'));
    }
}