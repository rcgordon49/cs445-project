insert into Professionals(pro_name)
select distinct pro_name
from Professionals_Temp;