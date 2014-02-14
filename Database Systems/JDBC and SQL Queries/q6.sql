use resulttracker;


select tag, game_race from players,

(select distinct player from earnings,players,tournaments where region='EU' and tournament=tournament_id and player=player_id and position =1 and major='true' ) as uw,

(select distinct player from earnings,players,tournaments where region = 'AM' and tournament=tournament_id and player=player_id and position =1 and major='true') as aw,

(select distinct player from earnings,players,tournaments where region = 'KR' and tournament=tournament_id and player=player_id and position =1 and major='true')as kw

where kw.player=aw.player and aw.player=uw.player and players.player_id=uw.player; 
 

