# Members post type #

## Description ##

Manage members on WordPress as post type. Implement: post type, authentification, role, clone from WordPress.

## Important to know ##

### 0.7.2
Compatibility : 4.6

If you have implemented custom views before 0.7.2, you might update them. Find an exemple [here](https://github.com/BeAPI/members-post-type/commit/2562b7e79feebf09967a2f964f3144e8f6d10930#diff-fac5c1b7350b8f3af605e75406b9c751).

### 0.7.0
Compatibility : 4.4

If you use the roles and capabilities you have to migrate all data from meta for taxonomies to WordPress native functions.
To do so, download the meta for taxonomies plugin and let the plugin migrate the data for you.

## Changelog ##

### 1.0.1
* 5 Dec 2016
* Fix wrong default register notification.

### 1.0.0
* 28 Nov 2016
* Add for email notifications the available replacements values which are automatically replaced before email send.
* Update the .pot and French po/mo.

### 0.7.2
* 5 Oct 2016
* `mpt_nonce_field()` method for nounce generating has been integrated to decorrelate members and WordPress users on one hand, and to not share the same cookie for all connected members, as before, in other hand.

### 0.7.1
* 10 Mar 2016
* Fix missing `mpt_verify_nonce`.

### 0.7.0
* 10 Fev 2016
* Update the way roles and capabilities works with members.