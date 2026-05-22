<?php
// app/Http/Controllers/Api/MenuController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Get menu items by menu name
     *
     * @param string $menuName
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
{
    // Get all menus with their top-level items and children
    $menus = Menu::with(['items' => function($query) {
        $query->whereNull('parent_id')
              ->with('children')
              ->orderBy('_lft');
    }])->get();
    
    if ($menus->isEmpty()) {
        return response()->json([
            'success' => false,
            'message' => 'No menus found'
        ], 404);
    }

    return response()->json([
        'data' => $menus
    ]);
}
    public function getMenuItems($menuName)
    {
        // Find the menu by name
        $menu = Menu::where('name', $menuName)->first();
        
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu not found'
            ], 404);
        }

        // Get menu items with parent-child hierarchy
        $menuItems = MenuItem::where('menu_id', $menu->id)
            ->with('children')
            ->whereNull('parent_id')
            ->orderBy('_lft')
            ->get();

        return response()->json([
            'data' => $menuItems
        ]);
    }
}