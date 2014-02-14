use resulttracker;

select region, name, t1.total_amount
from tournaments,
	(select tournament , sum(prize_money) as total_amount
		from earnings
		group by tournament
		having sum(prize_money) > 10000 order by total_amount desc) as t1
where tournament_id=t1.tournament;
