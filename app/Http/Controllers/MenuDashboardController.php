<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::latest();
        
        if(request('search')){
            $menu->where('status', 'like', '%' . request('search') . '%');
        }

        return view('Admin.menu.menu',[
            'menus' => $menu->get()
            // 'pesanans' => Pesanan::latest()->filter(request(['search', 'status']))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validateData = $request->validate([
            'nama' => 'required|min:3',
            'harga' => 'required',
            'jumlah' => 'required',
            'image' => 'image|file|max:1024'
        ]);

        if($request->file('image')){
            $validateData['image'] = $request->file('image')->store('menu-images');
        }

        if($validateData['jumlah'] != 0){
            $validateData['status'] = 'Belum Habis';
        }else{
            $validateData['status'] = 'Empty';
        }

        Menu::create($validateData);
        
        //proses redirect ketika berhasil memasukkan inputan
        return redirect('/dashboard/menu')->with('success', 'Menu Baru Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('Admin.menu.edit', [
            'menu' => $menu
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validateData = $request->validate([
            'nama' => 'required|min:3',
            'harga' => 'required',
            'jumlah' => 'required',
            'image' => 'image|file|max:1024'
        ]);
        
        if($validateData['jumlah'] != 0){
            $validateData['status'] = 'Belum Habis';
        }else{
            $validateData['status'] = 'Empty';
        }

        //mengecek apakah ada image baru
        if($request->file('image')){
            // mengecek apakah ada gambar lama, jika ada maka gambar lama akan dihapus dari directory
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validateData['image'] = $request->file('image')->store('menu-images');
        }

        //proses meng-update data setelah divalidasi
        Menu::where('id', $menu->id)->update($validateData);

        //proses redirect ketika berhasil memasukkan inputan
        return redirect('/dashboard/menu')->with('success', 'Menu Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        // mengecek apakah ada gambar, jika ada maka gambar akan dihapus dari directory
        if($menu->image){
            Storage::delete($menu->image);
        }
        
        Menu::destroy($menu->id);
        return redirect('/dashboard/menu')->with('success', 'Menu Berhasil Dihapus!');
    }
}
