<?php

namespace App\Filament\Resources\SaleResource\Widgets;

use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Sale;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget;

class SalesOverview extends StatsOverviewWidget
{
    //protected static ?string $heading = 'Chart';

    protected function getCards(): array
    {
        $startDate = Carbon::now()->subMonth();
        $endDate = Carbon::now();

        $totalSales = Sale::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalPurchases = Purchase::whereBetween('created_at', [$startDate, $endDate])->count();
        $saleAmount = Payment::whereBetween('created_at', [$startDate, $endDate])->where('sale_or_purchase','sale')->sum('amount');
        $purchaseAmount = Payment::whereBetween('created_at', [$startDate, $endDate])->where('sale_or_purchase','purchase')->sum('amount');

        return [
            Card::make('Son 1 Aylık Satışlar', $totalSales)
                ->description('Toplam satış sayısı')
                ->color('success'),
            Card::make('Son 1 Aylık Alımlar', $totalPurchases)
                ->description('Toplam alım sayısı')
                ->color('warning'),
            Card::make('Son 1 Aylık Miktar', number_format($saleAmount) . ' AZN')
                ->description('Toplam satış tutarı')
                ->color('info'),
            Card::make('Son 1 Aylık Miktar', number_format($purchaseAmount) . ' AZN')
                ->description('Toplam alış tutarı')
                ->color('info'),
            Card::make('Son 1 Aylıq Gəlir', number_format(($saleAmount-$purchaseAmount)) . ' AZN')
                ->description('Gəlir')
                ->color('info'),
        ];
    }
}


