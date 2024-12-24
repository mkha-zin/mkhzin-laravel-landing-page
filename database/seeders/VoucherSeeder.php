<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Voucher::factory()->create(
                [
                    'voucher' => $this->generateUniqueVoucher(),
                ]
            );
        }
    }

    public function generateUniqueVoucher(): string
    {
        do {
            $voucher = Random::generate(10, '0123456789');
        } while (DB::table('vouchers')->where('voucher', $voucher)->exists());

        return $voucher;
    }
}
