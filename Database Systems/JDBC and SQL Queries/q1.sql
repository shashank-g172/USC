use ResultTracker;

Select real_name,birthday

From players

WHERE year(birthday)=1985 and nationality != 'KR';