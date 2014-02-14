use resulttracker;


	select tag,real_name 
	from players
	,(select player from members,players where team = 'ROOT Gaming' and end_date is not null and player NOT IN
	(select player from members where team ='ROOT Gaming' and end_date is null)) as t1

	where t1.player=player_id;



