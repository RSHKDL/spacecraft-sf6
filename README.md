### Database
🤕 When installing/updating the database , if you have an error like this
`SQLSTATE[HY000] [1045] Access denied for user 'symfony'@'172.24.0.3' (using password: YES)`
make a backup of the data, remove everything under data/mysql the rebuild the project.