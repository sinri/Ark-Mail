# Ark-Mail

![GitHub Version](https://img.shields.io/github/release/sinri/Ark-Mail.svg)
![Packagist Version](https://img.shields.io/packagist/v/sinri/Ark-Mail.svg)

The Email Component for Ark 2

## Upgrade Design

Since version 1.2.0, class `ArkSMTPMailerConfig` defined to standardise the configuration instead of common array,
the old codes might be incompatible.
Now the charset of email is set to utf-8 by default.