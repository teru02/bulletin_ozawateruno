<?php

namespace App\Http\Middleware;


use Closure;
use App\Models\ActionLogs\ActionLog;
use Auth;
use Carbon\Carbon;

class TraceLog
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
        // ログインidとポストidの組み合わせをaction_logに記録。post_idの数をカウントして閲覧数に表示
        $user_id=Auth::id();
        $post_id=$request->route()->parameter('id');
        $event_at=Carbon::now('Asia/Tokyo');

        ActionLog::create([
        'user_id'=>$user_id,
        'post_id'=>$post_id,
        'event_at'=>$event_at
        ]);

        return $next($request);
    }
}
