<?php

namespace App\Console\Commands;

use App\Contracts\Services\StatisticsServiceContract;
use App\Http\Requests\TagsRequest;
use App\Models\Article;
use App\Models\Car;
use App\Models\Tag;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\TableSeparator;

class StatisticsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:statistics';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display statistics';

    /**
     * Execute the console command.
     */
    public function handle(StatisticsServiceContract $statisticsService)
    {
        $statistics = $statisticsService->getStatistics();

        $this->table(['name', 'value'], collect($statistics));

        return Command::SUCCESS;
    }
}
