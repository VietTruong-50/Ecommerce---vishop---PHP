<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menu;

    public function __construct(Menu $menu){
        $this->menu = $menu;
    }

    public function index()
    {
        $menus = $this->menu->latest()->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $optionSelect = $this->getMenu('');
        return view('admin.menu.add', compact('optionSelect'));
    }

    public function store(Request $request){
        $this->menu->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect()->route('menus.index');
    }

    public function getMenu($parent_id): string
    {
        $data = $this->menu->all();
        $recursive = new MenuRecursive($data);
        return $recursive->menuRecursive($parent_id);
    }


    public function edit($id){
        $menu = $this->menu->find($id);
        $htmlOption = $this->getMenu($menu->parent_id);
        return view('admin.menu.edit', compact('menu', 'htmlOption'));
    }

    public function update($id, Request $request){
        $this->menu->find($id)->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name, '-')
        ]);
        return redirect()->route('menus.index');
    }

    public function delete($id){
        $this->menu->findOrFail($id)->delete();
        return redirect()->route('menus.index');
    }
}
