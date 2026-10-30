<?php

namespace App\Http\Controllers;


use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
    $title = "Manajemen Pengaturan - PPKD Sticker";
    $setting = Setting::all()->keyBy('key');
    return view('admin.setting.index', compact('title', 'setting'));
    }
    
    public function update(Request $request) 
    {
    $validated = $request->validate([
        'site_name' => 'nullable|string|max:255',
        'site_tagline' => 'nullable|string|max:255',
        'site_description' => 'nullable|string|max:255',
        'site_logo' => 'nullable|image:mimes:png,jpg,jpeg,webp|max:2048',

        'phone' => 'nullable|string|max:100',
        'email_upload' => 'nullable|email|max:255',
        'email_order' => 'nullable|email|max:255',
        'address' => 'nullable|string|max:1000',

        'url_shopee' => 'nullable|string|max:255',
        'url_facebook' => 'nullable|string|max:255',
        'url_instagram' => 'nullable|string|max:255',
        'url_youtube' => 'nullable|string|max:255',
        'url_tiktok' => 'nullable|string|max:255',

    ]);

    // 2. Ambil data setting logo lama dengan benar (.first())
    if ($request->hasfile('site_logo')) {
        $settingOld = Setting::where('key', 'site_logo') -> first();

  // 3. Hapus file lama jika ada di storage
            if ($settingOld && $settingOld->value) {
                Storage::disk('public')->delete($settingOld->value); // Perbaikan: menggunakan ->bukan .
            }

            // 4. Simpan file baru ke storage
        $path = $request->file('site_logo') -> store('setting','public');

        // 5. Simpan/update ke database dengan key 'site_logo' yang konsisten
        Setting::updateOrCreate(
                ['key' => 'site_logo'], // Argumen 1: Kondisi pencarian
                                 // Argumen 2: Data nilai yang diupdate
                [
                    'value' => $path,
                    'label' => "Site Logo",
                    'group' => 'general',
                    'type'  => 'image'             
                ]);
    }

    $ignoreKeys = ['site_logo'];

    foreach ($validated as $key => $value)
        {
                
            if(in_array($key, $ignoreKeys)) 
                {
                    continue;
                }
            Setting::updateOrCreate(
                ['key' => $key], // Argumen 1: Kondisi pencarian
                                 // Argumen 2: Data nilai yang diupdate
                [
                    'value' => $value,
                    'label' => ucwords(str_replace('_',' ',$key)),
                    'group' => 'general',
                    'type'  => 'text'             
                ]);
                }
                return redirect()->route('admin.settings')->with('success','Pengaturan website PPKD Sticker berhasil disimpan');

    }

}
