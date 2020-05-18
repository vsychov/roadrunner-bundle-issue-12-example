# Example of problems dicribed at https://github.com/Baldinof/roadrunner-bundle/pull/12

### run example:
1. `docker-compose up --build`

### 1st problem case:
1. open `http://localhost:8080/` - all good
2. `docker-compose restart db`
3. http://localhost:8080/ will produce PDO DriverException "SQLSTATE[HY000]: General error: 7 no connection to the server"

###  2nd problem test case:
1. open `http://localhost:8080/` - all good
2. open `http://localhost:8080/rollback` - this will close EM
3. `http://localhost:8080/` will produce error "The EntityManager is closed."

