# Email Whitelist

A plugin for [Craft CMS](https://craftcms.com/) that prevents new users from signing up unless their email is from a specific domain.

## Installation

1. Move `emailwhitelist` directory to `craft/plugins` directory
2. Install **Email Whitelist** under **Craft Admin &rsaquo; Settings &rsaquo; Plugins**

## Usage

In the settings page for **Email Whitelist**, simply add a new row and type the text that any new user's email must have. The plugin will check each item in the list.

There is also a toggle to enable **Blacklist Mode**, which disallows whatever emails you've put in the list.

![Screenshot of EmailWhitelist](screenshot.png)

Do you also have client-side validation? Great! In a template, you can get the list of allowed emails to throw into a `<script>` tag:
```
{% for email in craft.emailWhitelist.getEmails() %}
  {{ email[0] }}
{% endfor %}
```

On error, the plugin sets a flash message which you can see in a template:
```
{% if craft.session.hasFlash('emailwhitelist') %}
  <h1>{{ craft.session.getFlash('emailwhitelist') }}</h1>
{% endif %}
```

That's all there is to it!

## Changelog

1.1.0 : Add Blacklist mode, with a toggle on the plugin's Settings page, changed variable names
1.0.0 : Initial Version

## Feedback?

Please submit an issue or reach out to me on Twitter: [@jasonetco](https://twitter.com/jasonetco)

## License

MIT © [Jason Etcovitch](https://jasonet.co)