<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenStreetMapService
{
    public function searchDestination(string $destination): ?array
    {
        $destination = trim($destination);

        if ($destination === '') {
            return null;
        }

        /*
        |--------------------------------------------------------------------------
        | Beberapa variasi pencarian
        |--------------------------------------------------------------------------
        | Supaya input seperti:
        | - Bulukumba
        | - Kabupaten Bulukumba
        | - Bulukumba, Sulawesi Selatan
        | tetap bisa ditemukan.
        |--------------------------------------------------------------------------
        */

        $queries = [
            $destination . ', Indonesia',
            $destination,
            'Kabupaten ' . $destination . ', Sulawesi Selatan, Indonesia',
            $destination . ', Sulawesi Selatan, Indonesia',
        ];

        foreach ($queries as $query) {

            try {

                $response = Http::withHeaders([
                    'User-Agent' => 'TripMate-AI-Travel-Planner/1.0',
                    'Accept' => 'application/json',
                ])
                ->timeout(30)
                ->connectTimeout(10)
                ->get(
                    'https://nominatim.openstreetmap.org/search',
                    [
                        'q' => $query,
                        'format' => 'json',
                        'limit' => 5,
                        'addressdetails' => 1,
                        'countrycodes' => 'id',
                    ]
                );

                if (!$response->successful()) {
                    continue;
                }

                $data = $response->json();

                if (empty($data) || !is_array($data)) {
                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | Ambil hasil pertama yang memiliki koordinat
                |--------------------------------------------------------------------------
                */

                foreach ($data as $place) {

                    if (
                        !isset($place['lat']) ||
                        !isset($place['lon'])
                    ) {
                        continue;
                    }

                    return [
                        'display_name' =>
                            $place['display_name']
                            ?? $destination,

                        'lat' =>
                            $place['lat'],

                        'lon' =>
                            $place['lon'],
                    ];
                }

            } catch (\Exception $e) {

                /*
                | Jika satu pencarian gagal,
                | lanjutkan ke variasi pencarian berikutnya.
                */

                continue;
            }
        }

        return null;
    }
}