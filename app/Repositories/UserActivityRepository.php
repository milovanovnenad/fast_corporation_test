<?php

namespace App\Repositories;

use App\Models\UserActivity;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class UserActivityRepository
{
    public static function store(int $userId, string $action): bool
    {
        /**
         * Livewire click provides ambiguous update action, which should be logged from component action logic
         * Also, skipping dashboard, reports and statistics view log
         */
        if (in_array($action, ['update', 'dashboard', 'reports', 'statistics']) || empty($action)) {
            return true;
        }

        $activity = new UserActivity;
        $activity->setUserId($userId);
        $activity->setAction($activity->alterActionMessage($action));

        return $activity->save();
    }

    public static function fetch(string $date, string $name, string $action): LengthAwarePaginator
    {
        $query = UserActivity::query()
            ->with('user:id,name');

        if (! empty($date) && Carbon::parse($date)) {
            $query->whereDate('created_at', '>=', Carbon::parse($date)->startOfDay()->toDateString());
            $query->whereDate('created_at', '<=', Carbon::parse($date)->endOfDay()->toDateString());
        }

        if (! empty($name)) {
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%'.$name.'%'));
        }

        if (! empty($action)) {
            $query->where('action', $action);
        }

//        var_dump($date);
//        var_dump($name);
//        var_dump($action);
//        var_dump($query->getQuery()->toRawSql());

        return $query->orderBy('id', 'desc')
            ->paginate(25);
    }

    public static function fetchSumByDays(): Paginator
    {
        return DB::table('user_activities')
            ->selectRaw('DATE(created_at) AS date')
            ->selectRaw('SUM(action = ?) AS `view_page_a`', ['View-page A'])
            ->selectRaw('SUM(action = ?) AS `view_page_b`', ['View-page B'])
            ->selectRaw('SUM(action = ?) AS `buy_a_cow_click`', ['Buy a cow button-click'])
            ->selectRaw('SUM(action = ?) AS `download_click`', ['Download button-click'])
            ->groupByRaw('DATE(created_at)')
            ->orderByRaw('DATE(created_at) DESC')
            ->simplePaginate(10);
    }
}
