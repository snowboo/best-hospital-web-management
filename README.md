# Best Hospital

## Set up
### Load Data
1. $> mysql -u root (-p if you have a password for root)
2. mysql> create user 'testuser'@'localhost' IDENTIFIED BY 'password'
3. mysql> GRANT ALL PRIVILEGES ON * . * TO 'testuser'@'localhost';
4. mysql> exit;
3. $> mysql -u testuser -p
4. $> password
2. mysql> source \<location of git repo\>/data/hospital.sql
