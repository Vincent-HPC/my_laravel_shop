<?php

namespace App\Console\Commands;

use App\Jobs\SendMerchandiseNewsletterJob;
use App\Shop\Entity\Merchandise;
use App\Shop\Entity\User;
use DB;
use Illuminate\Console\Command;
use Log;

class SendLatesMerchandiseNewsletterCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:sendLatestMerchandiseNewsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '[EDM] Send the news Merchandise EDM';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // *****************
        $this->info('寄送最新商品電子報(Start)');
        $this->info('撈取最新商品');
        // *****************

        // get the latest update 10 selling merchandise from DB
        $total_row = 10;
        $MerchandiseCollection = Merchandise::OrderBy('created_at', 'desc')
            ->where('status', 'S')
            ->take($total_row)
            ->get();

        // SQL:
        //     select *
        //     from `merchandise`
        //     where `status` = 'S'
        //     order by `created_at` desc
        //     linit 10

        // Send EDM to ALL member, each time get 100 member data
        $row_per_page = 100;
        $page = 1;
        while(true) {
            // 略過資料筆數
            $skip = ($page - 1) * $row_per_page;

            // *****************
            $this->comment('取得使用者資料，第' . $page . '頁，每頁 ' . $row_per_page . ' 筆');
            // *****************

            // 取得分頁會員資料
            $UserCollection = User::orderBy('id', 'asc')
                ->skip($skip)
                ->take($row_per_page)
                ->get();


            if(!$UserCollection->count()){
                // No User data anymore, stopping send EDM

                // *****************
                $this->question('沒有使用者資料了，停止派送電子報');
                // *****************

                break;
            }

            // *****************
            $this->comment('派送會員電子報(Start) ');
            // *****************

            // dispatch User EDM jobs
            foreach( $UserCollection as $User){
                SendMerchandiseNewsletterJob::dispatch($User, $MerchandiseCollection)
                    ->onQueue('low');
            }
            // *****************
            $this->comment('派送會員電子報(End) ');
            // *****************

            // 繼續找看看還有沒有需要寄送電子信的使用者
            $page++;
        }

        // *****************
        $this->info('寄送最新商品電子報(End) ');
        // *****************
    }
}
