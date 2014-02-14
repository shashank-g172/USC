use resulttracker;


select distinct name,founded,count(*),count(*),count(*) from members,
(select player_id,team_id,name,founded from players,teams where year(founded)<2011) as b42011
where team=b42011.team_id and b42011.player_id=player group by name;

select count(*) from players where game_race='P';
select count(*) from players where game_race='T';
select count(*) from players where game_race='Z';


