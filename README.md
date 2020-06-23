# PotCoders

>A Laravel 7 (PHP Framework) blog application utilizing various core features of the framework.

## Usage
Create a database, mailtrap account (or any) and populate .env copy file with the credentials. Rename it to .env

#### Migration
First perform the migration for the tables in the database

```
php artisan migrate
```
#### To run server
```
php artisan serve
```

#### Admin Account
To make any account an admin account, manually set 'isAdmin' column in the user table to 1.
***
## Basic Features
* Complete Login and Registration System
* Roles : unregistered, publisher and admin
* Unregistered user can
  * create an account
  * view all blog posts
  * contact using a form in website which sends email (markdown system used) to the admin (address defined in .env file)
  * donate to site (payment not integrated)
  * click on a tag below a blog to view all the blogs with the tag
* Registered Users can
  * reset their password
  * create tags (which they own but can be used by all users)
  * crate blog posts with tags
  * View/Edit/Delete their blog posts and their tags
  * donate to site
***
## Point system
* Each user have some points (0 when they register)
* For each blog post a user makes, he/she will receive 5 points
* If a user donates Nrs X then X point will be added
* To implement point system, concept of **Laravel Events and Listeners** have been used
***
## Notifications
Upon donation, besides point increment via listeners, two notification will be sent
  * **Email Notification**
    *  An email with a thank you message will be send using markdown
  * **Database Notification**
    *  In the dashboard, user can see the unread ntifications. 
    * The user can mark each notification as read or mark all notifications as read at once
***
## Authorization
* A publisher can modify and delete his/her own blogs and tags only.
* An admin has previlege to modify and delete any publisher's tags and blogs
* **Gate and Policies** feature of Laravel has been used for authorization.

***
## UI
A very simple user interface using Bootstrap 4.0 which makes the site fully responsive.

***
## What can be added?
* Soft Deletes
* PUblish/Save Drafts
* ckeditor for blog content
* Like and Comment Feature to blog posts
* Image upload for blog and user profile

*Send me a pull request.*
*** 
## Demo
Website is live at 
* Version **1.0**
* Author **Suroj Maharjan**

