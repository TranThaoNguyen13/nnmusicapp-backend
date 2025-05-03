<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Types\Type;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') === 'production') {
            \URL::forceScheme('https');
        }
        try {
            // Chỉ gọi khi kết nối database sẵn sàng
            $connection = DB::connection();
            $connection->getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping('enum', 'string');
        } catch (\Exception $e) {
            // Bỏ qua lỗi kết nối database trong giai đoạn build
            \Log::error('Failed to register Doctrine type mapping: ' . $e->getMessage());
        }
    }
}
