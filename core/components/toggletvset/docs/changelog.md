# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.4] - 2023-03-10

### Fixed

- Fix some timing issue in the resource form [#13]

## [2.0.3] - 2022-11-30

### Fixed

- Fix Toggle TV returns label when value is blank [#14]

## [2.0.2] - 2022-09-28

### Fixed

- Remove PHP 7.4 syntax to fit PHP 7.2 requirements

## [2.0.1] - 2022-01-18

### Fixed

- Fix some timing issues in the resource form
- Fix a MySQL query issue, when only Toggle TVs are used

## [2.0.0] - 2022-01-18

### Changed

- Code refactoring
- Full MODX 3 compatibility

### Added

- Toggle TV custom template variable

### Removed

- System setting `toggletvs` deprecated

## [1.2.6] - 2019-10-20

### Added

- MODX parsing on the input options values 

## [1.2.5] - 2019-08-23

### Changed

- PHP/MODX version check
- Normalized/refactored code 

## [1.2.4] - 2018-05-14

### Changed

- Normalized/refactored code

## [1.2.3] - 2016-04-07

### Fixed

- Fixing javascript issues with not valid hide/show tv values
- Fixing issue with the getTVLabel output filter and not found placeholder name
- Fixing issue with the getTVNames output filter and not found TV ID

## [1.2.2] - 2016-02-10

### Fixed

- Fixing toggling more than one set

## [1.2.1] - 2016-02-01

### Fixed

- Fixing wrong visibility state shown after resource save

### Added

- Compressed javascript

## [1.2.0] - 2015-11-24

### Added

- Clear hidden TVs on toggle

## [1.1.0] - 2015-09-06

### Changed

- The toggling TV does not have to be assigned to the template or accessible in the template.
  That way an admin could hide template variables on resource base without form customization.

## [1.0.0] - 2015-08-25

### Added

- Initial release for MODX Revolution
