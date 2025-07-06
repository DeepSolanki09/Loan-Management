<?php

namespace App\Imports;

use App\Models\LoanDetails;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class LoanDetailsImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $logoPath = null;

        if (!empty($row['bank_logo']) && Str::startsWith($row['bank_logo'], ['http://', 'https://'])) {

            try {
                $response = Http::timeout(10)->get($row['bank_logo']);

                if ($response->successful()) {
                    $imageContents = $response->body();

                    $extension = pathinfo(parse_url($row['bank_logo'], PHP_URL_PATH), PATHINFO_EXTENSION);
                    if (!in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'webp'])) {
                        $extension = 'png';
                    }

                    $fileName = 'bank_logoes/' . Str::slug($row['bank_name']) . '-' . uniqid() . '.' . $extension;

                    if (!Storage::disk('public')->exists('bank_logoes')) {
                        Storage::disk('public')->makeDirectory('bank_logoes');
                        // \Log::info('📁 Created directory: bank_logoes');
                    }

                    Storage::disk('public')->put($fileName, $imageContents);

                    $logoPath = $fileName;
                } 
            } catch (\Exception $e) {
                \Log::error('❌ Exception downloading logo: ' . $e->getMessage());
            }
        } else {
            \Log::info('⚠️ No logo URL or not valid: ' . ($row['bank_logo'] ?? 'null'));
        }

        return new LoanDetails([
            'loan_id'       => $row['loan_id'],
            'bank_name'     => $row['bank_name'],
            'loan_type'     => $row['loan_type'],
            'interest_rate' => $row['interest_rate'],
            'loan_tenure'   => $row['loan_tenure'],
            'bank_logo' =>   $logoPath ?? null
        ]);
    }
    public function rules(): array
    {
        return [
            '*.loan_id'       => ['required'],
            '*.bank_name'     => ['required', 'string'],
            '*.loan_type'     => ['required', 'string'],
            '*.interest_rate' => ['required', 'numeric'],
            '*.loan_tenure'   => ['required', 'numeric'],
            '*.bank_logo'     => ['nullable', 'string'],
        ];
    }
}
