# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
