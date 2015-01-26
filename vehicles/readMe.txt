Contains PHP for connecting to the SQL vehicle database and manipulating its contents

0x{00(make), 0000(year), 00(model)}

Manufacturers:

Names are alphabetically generated

0 is a reserved value and is not used
01-Audi
02-Bentley
03-BMW
04-Chevrolet
05-Ferrari
06-Ford
07-
08-
09-Lamborghini
0A-Porsche
0B-Shelby
0C-
0D-
0E-
0F-
//
10-
11-
12-
...

Year:
A year value of 0 represents the year of the first production car,
the Ford Model T at 1908, any other value is added to that date.
Possible values between 0x0-0xFFFF(65025)

Model:
Named alphabetically between 0x0-0xFF