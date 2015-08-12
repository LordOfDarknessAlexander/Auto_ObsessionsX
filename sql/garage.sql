-- 
--Created by Tyler R. Drury, (C) 8.5:1 Entertainment
--Auto Obsessions sql utility functions, for dev use ONLY
--This file is for documentation purposes and should NOT be executed directly
--Replace (tableName) with the user you wish to reset
--
UPDATE `tableName` SET `drivetrain`=0,`body`=0,`interior`=0,`docs`=0,`repairs`=0;
--Individual
UPDATE `tableName` SET `drivetrain`=0;
UPDATE `tableName` SET `body`=0;
UPDATE `tableName` SET `interior`=0;
UPDATE `tableName` SET `docs`=0;
UPDATE `tableName` SET `repairs`=0;
--Compound operations
UPDATE `tableName` SET `drivetrain`=0,`body`=0;
UPDATE `tableName` SET `drivetrain`=0,`body`=0,`repairs`=0;
UPDATE `tableName` SET `drivetrain`=0,`interior`=0;
UPDATE `tableName` SET `drivetrain`=0,`interior`=0,`repairs`=0;
UPDATE `tableName` SET `drivetrain`=0,`docs`=0;
UPDATE `tableName` SET `drivetrain`=0,`docs`=0,`repairs`=0;
UPDATE `tableName` SET `body`=0,`interior`=0;
UPDATE `tableName` SET `body`=0,`interior`=0,`repairs`=0;
UPDATE `tableName` SET `body`=0,`docs`=0;
UPDATE `tableName` SET `body`=0,`docs`=0,`repairs`=0;
UPDATE `tableName` SET `interior`=0,`docs`=0;
UPDATE `tableName` SET `interior`=0,`docs`=0,`repairs`=0;