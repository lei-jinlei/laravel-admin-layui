<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use App\Models\OperationLog as OperationLogModel;
use Illuminate\Support\Facades\Log;

class OperationLog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->shouldLogOperation($request)) {
            $log = [
                'user_id' => Auth::user()->id,
                'path'    => substr($request->path(), 0, 255),
                'method'  => $request->method(),
                'ip'      => $request->getClientIp(),
                'input'   => json_encode($request->input(), JSON_UNESCAPED_UNICODE),
            ];

            try {
                OperationLogModel::create($log);
            } catch (\Exception $exception) {
                Log::error('operation log error' . json_encode($log));
            }
        }

        return $next($request);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    protected function shouldLogOperation(Request $request)
    {
        if (in_array($request->method(), config('admin.operation_log.method'))) {
            return false;
        }

        foreach (config('admin.operation_log.except') as $route) {
            if ($request->routeIs($route)) {
                return false;
            }
        }

        return true;
    }
}
