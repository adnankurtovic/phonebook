# phonebookapi

[![CircleCI](https://circleci.com/gh/adnankurtovic/phonebook.svg?style=shield)](https://circleci.com/gh/adnankurtovic/phonebook)


TODO

   - Complete CircleCI integration (setup mysql)
   - Write more tests
   - Handle file upload for photo
   - Make more endpoints for easier usage


INFO

    - Project is built using Symfony 6 and Api platform. MySql is used as database. Tests are written in PHPUnit
    - All default Api platform endpoints are exposed. To view documentation go to http://SITE/api (replace SITE with actual name, for example http://phonebook/api)
    - It is possible to search contacts by first name or last name (partial match). Example http://phonebook/api/contacts?FirstName=ada
    - Tests are located in /tests folder