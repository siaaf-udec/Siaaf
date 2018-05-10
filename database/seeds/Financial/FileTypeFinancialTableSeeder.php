<?php

use App\Container\Financial\src\FileType;
use Illuminate\Database\Seeder;

class FileTypeFinancialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $files = [
            [ file_types() => icetex_string() ],
            [ file_types() => fraction_string() ],
            [ file_types() => invoice_string() ],
            [ file_types() => check_string() ],
        ];

        foreach ($files as $file) {
            FileType::create( $file );
        }
    }
}