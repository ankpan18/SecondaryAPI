## About
This project is made on Codeigniter 3 Framework with MySQL database support. I have also included the bonus task in the bonus folder of this repositiory.


## How to use this project

1. Download this project using Github.
2. Save this folder in the htdocs folder of XAMPP. Install XAMPP if not done.
3. Open Xampp and start both Apache and MySQL Server.
4. Run db.sql in your mysql shell using this command: mysql -u root -p db_name < "C:\xampp\htdocs\SecondaryAPI\db_name.sql"
5. Go to "C:\xampp\htdocs\php\php.ini" and open it in notepad.
6. Here we need to change the maximum execution time and database size for phpmyadmin.
 Search for line with "max_execution_time" and replace this line with the below one


         max_execution_time = 3600

Similarly search for line with "upload_max_filesize" and replace this line with the below one

      memory_limit=512M

8. Now restart Apache and MySQL server in XAMPP.
9. Add API Key in config table with id=1 using PHPMyAdmin.
10. Open localhost/SecondaryAPI/Catalog in your browser for loading all data in your database.
11. Don't refresh or close this page till it stops loading. It will return the number of seconds taken to insert all record after the execution is completed.
	It took me about 27 minutes based on internet connection and server response time. The time might vary accordingly due to these conditions.
12. Get categories API <b>Link:"localhost/SecondaryAPI/shop/categories/5/1" </b>
where 5 is the limit-number of items to be returned and 1 is the page number for pagination. You can change these numbers are per your requirement.

<b>Get products API Link:"localhost/SecondaryAPI/shop/products/5/1/catid"</b>
where 5 is the limit-number of items to be returned, 1 is the page number for pagination and catid is the category Id. You can change these numbers and string as per your requirement.

You can test these two REST API Endpoint on thunderclient, postman and even your browser. I have not included API Key as required parameter for these API since we are only using it locally in our system.
 
13. You can also access bonus page by going in bonus folder and opening demo.html in your browser to displays the list of categories and clicking the category shows the list of products with name, price, images and reviews.

## Screenshots for Bonus Page

![image](https://github.com/ankpan18/SecondaryAPI/assets/79756942/acd2f9df-b36c-4ef7-a887-70cdcad85060)


![image](https://github.com/ankpan18/SecondaryAPI/assets/79756942/a7f4c62a-e71f-466f-a26d-61673bce4658)


## My Approach

I first set up the basic template using CodeIgniter. I created a database named ecom in db.sql with four tables: Categories, Products, Images, and Config(For API Key). To ensure a well-organized project structure, I followed the MVC pattern. The Controller handles the flow of routes to models or views as required. The Models are responsible for handling communication with the database, while the Views display web pages or page fragments.

To store all the data from the provided ecommerce API, I created a controller named Catalog. Our database size is approximately 185 MB. After optimization, I was able to reduce the execution time for storing data in our database from over an hour to just 27 minutes. Initially, I was inserting records one by one, which was inefficient and time-consuming. Now, records are added in batches, resulting in fewer queries and reduced execution time.

To read the catalog data from the database, I utilized a REST Controller library. This approach is beneficial as it accounts for potential issues such as slow API response times, rate limiting, or service outages. I implemented two REST API endpoints with support for pagination and record limits. Additionally, the categories are ordered based on the number of products in the response for these endpoints.

To display the list of categories, I created an HTML, CSS, and JavaScript page. I leveraged the REST API endpoint to fetch data for this page. If you choose a category, you will receive information about associated products, including their names, prices, images, and reviews. For simplicity, I have currently limited the number of categories to 100. If you find this project helpful, please show your support by giving it a star.




### What is CodeIgniter


CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
### Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
### Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
### Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
### Installation
************

Please see the `installation section <https://codeigniter.com/userguide3/installation/index.html>`_
of the CodeIgniter User Guide.

*******
### License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
### Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Contributing Guide <https://github.com/bcit-ci/CodeIgniter/blob/develop/contributing.md>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
