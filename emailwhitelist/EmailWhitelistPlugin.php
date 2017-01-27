<?php
namespace Craft;

class EmailWhitelistPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Email Validator');
	}

	public function getVersion()
	{
		return '1.0';
	}

	public function getDeveloper()
	{
		return 'Jason Etcovitch';
	}

	public function getDeveloperUrl()
	{
		return 'https://jasonet.co';
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('EmailWhitelist/_settings', array(
				'settings' => $this->getSettings()
		));
  }

	public function prepSettings($settings)
	{

			return $settings;
	}

	protected function defineSettings()
	{
		return array(
			'allowedEmails' => array(
				AttributeType::String,
				'label' => 'Allowed Emails'
			)
		);
	}

	public function init()
	{
		craft()->on('users.beforeSaveUser', function(Event $event)
		{
			// Retrieve the userModel from the event
			$user = $event->params['user'];
			$email = $user->email;
			$isNewUser = $event->params['isNewUser'];

			// Check if this is a front end request and that we are dealing with a new user
			if (craft()->request->isSiteRequest() && $isNewUser)
			{
				$email = $user->email;

				$allowedEmails = craft()->plugins->getPlugin('EmailWhitelist')->getSettings()->allowedEmails;

				foreach ($allowedEmails as $e) {
						if (strpos($email, $e[0]) !== false) {
								$event->performAction = true;
								return true;
						}
				}

				craft()->userSession->setFlash('allowedEmails', 'You need to use a Harvard Law School email.');
				// Cancel user save
				$event->performAction = false;
				return false;
			}
		});
	}
}