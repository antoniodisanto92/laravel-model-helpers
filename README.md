# Laravel Models Helpers
A package for adding methods to Laravel models on the fly and adding basic useful helpers 🕊

This is an upgrade of [Laravel Macroable Models](https://github.com/javoscript/laravel-macroable-models) with a couple of fixes over string concat and it add some extra traits and utilities.

## Installation
Just install the package with `composer`
> composer require antoniodisanto92/laravel-model-helpers

**(Only necessary for Laravel <5.5, or if you want to be explicit)** - Add the Service Provider to the `providers` array in the `config/app.php` file
```php
// config/app.php

$providers = [
    // ...
    \Antoniodisanto92\ModelHelpers\ModelHelpersServiceProvider::class,
    // ...
];

```

## Find by setup
The main purpose of this Repo is to explain the utility set in it. If someone ever used RoR, knows the power of ActiveRecord and here you can find some utilities that emulate the find method.
Adding the `HasSearchableFields` trait will make the trick. By default, the trait return - via `getSearchableFields` - the array of Model's fillable fields.
Let's say we have a model `Post` with some attributes and, one of them, is the `permalink`. Permalink is our `title` but parameterized, so lowercase and with dash instead of spaces and so on (ex: This is a test => this-is-a-test).
Let's say we know the permalink of a post but not his ID. Then we would have to do, to be able to get the Model:

```php
Post::where('permalink', 'this-is-a-test')->first();
```

What does this trait is exactly emulating this behaviour, giving a quick way to do it without using the `where` and the `first` methods. We will just have to do:

```php
Post::find_by_permalink('this-is-a-test');
```

And here is the magic!

### Defining the searchable fields

As mentioned before, the trait - by default - create a set of Macros for the model based on the list of all fillable fields. What if we want to change this behaviour?
For doing this, we can implement the `SearchableFieldsInterface` that has a `getSearchableFields` method that will override the default one of the trait. In this way, we can define the array of the fields that we want to search.

Do not forget that the trait will not change or convert your field name in your database. So, if we have a column called `is_admin` or `isAdmin`, the two methods will looks different:

```php
User::find_by_is_admin(true); // in case of is_admin
User::find_by_isAdmin(true); // in case of isAdmin
```

## Having roles

One of the most implemented features in every application are Roles. We all knows we have different ways to handle roles. This repo helps you easily setup 2 of them.

We have the utility for a `field` based role or a `relationship` based role. Both works in similar way.

In the first case we will have to add the `HasRoleField` trait. This trait, as default, use an internal set of Constants called `Role`. A `list()` method is exposed that return a list of strings of all constants in the class.
You can change this set of roles implementing `ListOfRolesInterface` with the `getListOfRoles` method returning an array of strings with the NAMES of the roles.

What exactly does this trait behind the scene? Just create the most common methods used everywhere. It creates a set of macros like `is{:role}` in a camel-case set up. Lets say we have roles as `super_admin`, `admin` and `user`, those are the methods coming out:

```php
User::first()->isSuperAdmin();
User::first()->isAdmin();
User::first()->isUser();
```

All methods return a `bool` value.

But what if we decided to have a list of roles for the user? We can do the same just using the `HasRoleRelationship` trait.
In this case, we will have first to provide the correct set of role names like before, and after tell the trait how we have to act:

```php
// First override the method that tell us which method in the user we have to call
public function getRoleMethod() : string {
    return "roles";
}

// After override the method that tell us which FIELD in the relationship of the Role gives us the Name
public function getRoleNameField() : string {
    return "title";
}
```

Under the box the trait will do EXACTLY the same thing as before, just will act and act based on the relationship we defined in it.
