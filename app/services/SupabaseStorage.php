<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class SupabaseStorage
{
    protected $client;
    protected $url;
    protected $key;
    protected $bucket;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = env('SUPABASE_URL');
        $this->key = env('SUPABASE_KEY');
        $this->bucket = env('SUPABASE_BUCKET');
    }

    public function uploadImage($file, $path)
    {
        $fileName = time() . '-' . $file->getClientOriginalName();
        $filePath = $path . '/' . $fileName;

        $response = $this->client->request('POST', "{$this->url}/storage/v1/object/{$this->bucket}/{$filePath}", [
            'headers' => [
                'Authorization' => "Bearer {$this->key}",
                'Content-Type'  => $file->getMimeType(),
                'x-upsert'      => 'true',
            ],
            'body' => fopen($file->getPathname(), 'r'),
        ]);

        if ($response->getStatusCode() === 200) {
            return "{$this->url}/storage/v1/object/public/{$this->bucket}/{$filePath}";
        }

        return null;
    }
}