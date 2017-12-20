# Changelog

All Notable changes to `ntlm-soap-client` will be documented in this file.

## Unreleased 

### Added
- added support for HTTPS streams
- added support for passing arbitrary CURL options


## Version 1.1.0 - 2016-11-16

### Added
- NTLMConfig - Client now accepts this class instead of an array.
- NTLMStream - Implemented NTLM Authenticated http stream for initial connection.

### Security
- Throws a RequiredConfigMissingException if not all required items are present.
