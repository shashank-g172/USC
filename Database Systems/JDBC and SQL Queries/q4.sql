use resulttracker;

select name, date, CONCAT(playA.tag,' (',playA.game_race,') ',playA.scoreA,'-',playB.scoreB,' ',playB.tag,' (',playB.game_race,')') as match_result from 

(select tag,game_race,scoreA, match_id,name, date from players,
(select playerA,playerB,scoreA,name,date,match_id from tournaments,
(select * from matches where (scoreA=4 and scoreB=0) or (scoreB=4 and scoreA=0)) as t1 
where t1.tournament=tournament_id) as t2
where player_id=t2.playerA) as playA,

(select tag,game_race,scoreB,match_id from players,
(select playerA,playerB,scoreB,name,date,match_id from tournaments,
(select * from matches where (scoreA=4 and scoreB=0) or (scoreB=4 and scoreA=0)) as t1 
where t1.tournament=tournament_id) as t2
where player_id=t2.playerB) as playB

where playA.match_id=playB.match_id;


 
