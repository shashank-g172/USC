drop database resulttracker;

create database resulttracker;

use resulttracker;

create table if not exists players(player_id int(7) NOT NULL, tag varchar(20) NOT NULL, real_name varchar(50), nationality char(7), birthday date, game_race char(3), primary key(player_id));

create table if not exists teams(team_id int(10) NOT NULL, name varchar(50) not null, founded date not null , disbanded date, primary key(team_id));

create table if not exists members( player  int(7) NOT NULL,  team  int(10) NOT NULL, start_date date not null, end_date varchar(20), primary key( player ,start_date), foreign key( player ) references players(player_id), foreign key( team ) references teams(team_id));

create table if not exists tournaments(tournament_id int(10) not null, name varchar(100) not null, region char(6), major varchar(6), primary key(tournament_id));

create table if not exists Matches(match_id int(10) not null, date date, tournament int(10) not null,  playerA  int(10),  playerB  int(10), scoreA int(6), scoreB int(6), offline varchar(6), primary key(match_id), foreign key( playerA ) references players(player_id), foreign key( playerB ) references players(player_id));

create table if not exists earnings( tournament  int(10) not null,  player  int(10) not null, prize_money int(10), position int(3), primary key( tournament ,  player ), foreign key( tournament ) references tournaments(tournament_id), foreign key( player ) references players(player_id));