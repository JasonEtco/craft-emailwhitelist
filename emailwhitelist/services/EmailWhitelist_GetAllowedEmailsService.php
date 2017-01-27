<?php
namespace Craft;

class EmailWhitelist_GetAllowedEmailsService extends BaseApplicationComponent
{
    public function getAllowedEmails()
		{
				$plugin = craft()->plugins->getPlugin('EmailWhitelist');
				$settings = $plugin->getSettings();

				return $settings->allowedEmails;
		}
}