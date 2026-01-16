<?php

namespace App\Http\Controllers;

use App\Models\IncomingLetter;
use App\Models\OutgoingLetter;
use App\Models\Disposition;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // --- 1. STATISTIK KARTU UTAMA ---
        $stats = [
            'incoming' => IncomingLetter::count(),
            'outgoing' => OutgoingLetter::count(),
            'disposition' => Disposition::count(),
            'users' => User::count(),
        ];

        if (Auth::user()->role == 'karyawan') {
            $stats['my_pending'] = Disposition::where('user_id', Auth::id())
                ->where('status', 'pending')->count();
        } else {
            $stats['pending_global'] = Disposition::where('status', 'pending')->count();
        }

        // --- 2. DATA UNTUK GRAFIK TREN (TAHUN INI) ---
        // Kita butuh array [0, 0, 5, 10, ...] untuk 12 bulan
        $currentYear = date('Y');
        $incomingPerMonth = [];
        $outgoingPerMonth = [];

        for ($m = 1; $m <= 12; $m++) {
            $incomingPerMonth[] = IncomingLetter::whereYear('letter_date', $currentYear)
                ->whereMonth('letter_date', $m)->count();

            $outgoingPerMonth[] = OutgoingLetter::whereYear('letter_date', $currentYear)
                ->whereMonth('letter_date', $m)->count();
        }

        // --- 3. DATA UNTUK GRAFIK KATEGORI (TOP 5) ---
        // Menggabungkan hitungan dari surat masuk & keluar berdasarkan kategori
        $categories = Category::withCount(['incomingLetters', 'outgoingLetters'])->get();
        $chartCategories = [];
        $chartSeries = [];

        foreach ($categories as $cat) {
            $total = $cat->incoming_letters_count + $cat->outgoing_letters_count;
            if ($total > 0) {
                $chartCategories[] = $cat->name;
                $chartSeries[] = $total;
            }
        }

        // --- 4. WIDGET DEADLINE (Disposisi yg akan jatuh tempo 7 hari ke depan) ---
        $upcomingDeadlines = Disposition::with(['incomingLetter', 'user'])
            ->where('status', '!=', 'completed')
            ->whereBetween('due_date', [now(), now()->addDays(7)])
            ->orderBy('due_date', 'asc')
            ->take(5)
            ->get();

        // --- 5. AKTIVITAS TERBARU ---
        $recentIncoming = IncomingLetter::with('category')->latest('created_at')->take(4)->get();
        $recentOutgoing = OutgoingLetter::with('category')->latest('created_at')->take(4)->get();

        return view('dashboard', compact(
            'stats',
            'incomingPerMonth',
            'outgoingPerMonth',
            'chartCategories',
            'chartSeries',
            'upcomingDeadlines',
            'recentIncoming',
            'recentOutgoing'
        ));
    }
}
