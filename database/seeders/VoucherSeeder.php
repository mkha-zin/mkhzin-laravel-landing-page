<?php

namespace Database\Seeders;

use App\Models\Header;
use App\Models\Voucher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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

    public function generateUniqueVoucher() {
        do {
            $voucher = Random::generate(10, 'abcdefghijklmnopqrstuvwxyz0123456789');
        } while (DB::table('vouchers')->where('voucher', $voucher)->exists());

        return $voucher;
    }
}
