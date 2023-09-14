# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased] - 2023-09-14

### Added
 - Add `layout` array in `wrender` method for `WComponent` class for support data in layout of livewire component.

### Changed
 - Update composer dependencies to latest versions. 

## [Unreleased] - 2023-09-08

### Added
 - Add `WComponent` class as Livewire component with support of `WAccount`. 

## [Unreleased] - 2023-09-07

### Added
 - Add `url` in `initializeIndex` as parameter for custom usages.
 - Add `index_route` in `waccount.php` config file for `initializeIndex` function.

### Fixed
 - Fix `initializeIndex` bug for return URL as string, now redirect directly. 
 - Fix `initializeIndex` bug for `url()->previous()` as latest user closed url(browser tab).

## [Unreleased] - 2023-09-04

### Added
 - Add `WApi` middleware for api usage, You can use `wapi` as middleware, that`s it.

### Changed
 - Change `WAuth` middleware class name from `Auth.php` to `WAuth.php`.


## [Unreleased] - 2023-08-23

### Added
 - Add `WAccount` class for general methods and helpers.
 - Add `initializeIndex` method in `WAccount` class for initialize index page with support of language based on user location.

## [Unreleased] - 2023-08-22

### Added
 - Add `locale` and `darkMode` methods into `Profile` module as web routes.

## [Unreleased] - 2023-08-22

### Added
 - Add `me` and `update` methods into `Profile` module.

### Removed
 - Remove `me` method from `Auth` module.

## [Unreleased]

### Added
 - Add `WController` class extends from `Illuminate\Routing\Controller` with `user` and `userId` object properties.

## [Unreleased]

### Fixed
 - Fix `logout` job constructor method to get user token from session variable.

### Added
 - Add `session.view_variable` to config file, set `true` to set view variable with user object schema.

### Fixed
 - Fix session variable schema with access token.

### Fixed
 - Fix `logout` method in `auth:classic` module.
 - Cookies replaced with session for logic.

### Added 
 - Add `wauth` as middleware with auto register in package service provider.

### Added
 - Add name to routes and update config file.

### Added
 - Add `logout` method for web on `auth:classic` module.
 - Add `start` and `check` methods for web on `authorize:classic` module.
 - Add `logout_route`, `routes.api`, and `routes.web` to config file.

### Added
 - Add `start` and `check` methods in `authorize:classic` module.

### Added
 - Add `logout` method in `auth:classic` module.

### Added
 - Add `me` method in `auth:classic` module.

### Added
 - Add `WAuthServiceProvider` and `WAuthGuard` for custom auth driver.

### Added
 - Structure and base classes of package
 - Add `login` and `register` methods in `auth:classic` module.
