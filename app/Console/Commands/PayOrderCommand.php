<?php

namespace App\Console\Commands;

use App\Contracts\Services\PayOrdersServiceContract;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Predis\Command\Redis\COMMAND as RedisCOMMAND;

class PayOrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pay-order-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(PayOrdersServiceContract $payOrdersService)
    {
        $payOrdersService->payOrders();
        return Command::SUCCESS;
    }
}
