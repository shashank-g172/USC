use resulttracker;


Select players.tag, players.real_name, players.nationality, teams.name

From teams, players, members

where players.game_race='Z'  AND members.player=players.player_id And members.team=teams.team_id and members.end_date is null and teams.disbanded is null;