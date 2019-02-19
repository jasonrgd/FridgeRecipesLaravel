Usage
-----
Start your Docker container:

    docker-compose up -d

See documentation running  on http://localhost/api/documentation
Alternatively you can view use swagger editor by grabbing the file located at storage/api-docs/api-docs.json

Bash into your Docker container

    docker-compose exec app /bin/sh
    
Use postman to query endpoint at 
    
    http://localhost/api/lunch
