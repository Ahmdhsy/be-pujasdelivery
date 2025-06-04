<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Models\Menu;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data statistik dari database
        $totalTenant = Tenant::count();
        $totalMenu = Menu::count();
        
        // Statistik tenant berdasarkan status
        $activeTenants = Tenant::where('status', 'active')->count();
        $inactiveTenants = Tenant::where('status', 'inactive')->count();
        
        // Statistik menu berdasarkan kategori
        $menusByCategory = Menu::selectRaw('categories.name as category, COUNT(menus.id) as count')
                               ->leftJoin('categories', 'menus.category_id', '=', 'categories.id')
                               ->groupBy('categories.name')
                               ->get();
        
        // Menu dengan harga tertinggi dan terendah
        $highestPriceMenu = Menu::orderBy('harga', 'desc')->first();
        $lowestPriceMenu = Menu::orderBy('harga', 'asc')->first();
        
        // Rata-rata harga menu
        $averagePrice = Menu::avg('harga');
        
        // Menu terbaru (5 terakhir)
        $recentMenus = Menu::with('tenant')
                           ->orderBy('created_at', 'desc')
                           ->limit(5)
                           ->get();
        
        // Tenant dengan menu terbanyak
        $tenantWithMostMenus = Tenant::withCount('menus')
                                     ->orderBy('menus_count', 'desc')
                                     ->first();
        
        // Persentase tenant aktif
        $tenantActivePercentage = $totalTenant > 0 ? round(($activeTenants / $totalTenant) * 100) : 0;
        
        // Data untuk notifikasi
        $newMenusThisWeek = Menu::where('created_at', '>=', now()->subWeek())->count();
        
        // Mengirim data ke view
        return view('dashboard', compact(
            'totalTenant',
            'totalMenu',
            'activeTenants',
            'inactiveTenants',
            'tenantActivePercentage',
            'menusByCategory',
            'highestPriceMenu',
            'lowestPriceMenu',
            'averagePrice',
            'recentMenus',
            'tenantWithMostMenus',
            'newMenusThisWeek'
        ));
    }
}