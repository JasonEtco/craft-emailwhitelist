# Email Whitelist

A plugin for [Craft CMS](https://craftcms.com/) that prevents new users from signing up unless their email is from a specific domain.

## Installation

1. Move `emailwhitelist` directory to `craft/plugins` directory
2. Install **Email Whitelist** under **Craft Admin &rsaquo; Settings &rsaquo; Plugins**

## Usage

In the settings page for **Email Whitelist**, simply add a new row and type the text that any new user's email must have. The plugin will check each item in the list.

SCREENSHOT COMING SOON

Do you also have client-side validation? Great! In a template, you can get the list of allowed emails to throw into a `<script>` tag:
```
{% for email in craft.emailWhitelist.getAllowedEmails() %}
  {{ email[0] }}
{% endfor %}
```

On error, the plugin sets a flash message which you can see in a template:
```
{% if craft.session.hasFlash('allowedEmails') %}
  <h1>{{ craft.session.getFlash('allowedEmails') }}</h1>
{% endif %}
```

That's all there is to it!

## Feedback?

Please submit an issue or reach out to me on Twitter: [@jasonetco](https://twitter.com/jasonetco)