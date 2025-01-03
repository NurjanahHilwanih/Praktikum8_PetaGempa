<?php

namespace App\Filament\Pages;

use Illuminate\Support\Facades\File;
use Filament\Pages\Page;

class MapPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.map-page';

    public $geojsonData = [];

    public function mount()
    {
        $files = [
            public_path('storage/31-Jakarta.geojson'),
            public_path('storage/32-Jawa Barat.geojson'),
            public_path('storage/33-Jawa Tengah.geojson'),
            public_path('storage/34-Yogyakarta.geojson'),
            public_path('storage/35-Jawa Timur.geojson'),
            public_path('storage/36-Banten.geojson'),
        ];

        // Membaca semua file GeoJSON
        foreach ($files as $file) {
            if (File::exists($file)) {
                $this->geojsonData[] = json_decode(File::get($file)); // Mengambil data dan mengdecode JSON
            }
        }
    }
}
