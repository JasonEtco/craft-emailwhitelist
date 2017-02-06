<?php
namespace Craft;

class EmailWhitelist_GetEmailsService extends BaseApplicationComponent
{
    public function getEmails()
		{
				$plugin = craft()->plugins->getPlugin('emailWhitelist');
				$settings = $plugin->getSettings();

				return $settings->emails;
		}
}