<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CalculateActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * 供我们调用命令
     */
    protected $signature = 'larabbs:calculate-active-user';

    /**
     * The console command description.
     *
     * @var string
     * 命令的描述
     */
    protected $description = '生成活跃用户';

    /**
     * Execute the console command.
     *
     * @return mixed
     * 最终执行的方法
     */
    public function handle(User $user)
    {
        // 在命令行打印一行信息
        $this->info('开始计算...');

        $user->calulateAndCacheActiveUsers();

        $this->info('成功生成！');
    }
}
