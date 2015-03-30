LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/movies_formatted.txt' INTO TABLE Movies FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/professional_formatted.txt' INTO TABLE Professionals_Temp FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/keywords_formatted.txt' INTO TABLE Has_Key_Word_Temp FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/genres_formatted.txt' INTO TABLE Has_Genre_Temp FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/actsIn_formatted.txt' INTO TABLE Acts_in_Temp FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/directs_formatted.txt' INTO TABLE Directs_Temp FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/produces_formatted.txt' INTO TABLE Produces_Temp FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/edits_formatted.txt' INTO TABLE Edits_Temp FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/rel_data/mpaa_formatted.txt' INTO TABLE Has_Mpaa_Rating_Temp FIELDS TERMINATED BY '\t';

LOAD DATA INFILE '/nfs/elsrv4/users4/grad/rcgordon/cs445/project/cs445-project/data/orig_data/ratings.txt' INTO TABLE Rates_Temp FIELDS TERMINATED BY '\t';