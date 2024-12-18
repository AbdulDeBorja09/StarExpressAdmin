<?

$startDate = $currentDate->copy()->subMonths(12)->startOfMonth();
        $endDate = $currentDate->copy()->endOfMonth();

        $visitCounts = DB::table('website_visits')
            ->selectRaw('YEAR(visited_at) as year, MONTH(visited_at) as month, COUNT(*) as count')
            ->whereBetween('visited_at', [$startDate, $endDate])
            ->groupBy(DB::raw('YEAR(visited_at), MONTH(visited_at)'))
            ->orderBy(DB::raw('YEAR(visited_at), MONTH(visited_at)'))
            ->get();

        $months = [];
        $data = [];

        for ($month = $startDate; $month->lte($endDate); $month->addMonth()) {

            $months[] = $month->format('M Y');
            $data[] = 0;
        }


        foreach ($visitCounts as $visit) {
            $visitMonth = Carbon::create($visit->year, $visit->month, 1);
            $index = array_search($visitMonth->format('M Y'), $months);
            if ($index !== false) {
                $data[$index] = $visit->count;
            }
        }