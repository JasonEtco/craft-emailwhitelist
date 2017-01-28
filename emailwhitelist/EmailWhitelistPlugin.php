<?php
namespace Craft;

class EmailWhitelistPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Email Whitelist');
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

	public function getPluginUrl()
	{
			return 'https://github.com/JasonEtco/craft-emailwhitelist';
	}

	public function getDocumentationUrl()
	{
			return $this->getPluginUrl() . '/blob/master/README.md';
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
			),
			'errorMessage' => 'There was an error, sorry!'
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
				$domain = explode('@', $email)[1];

				$allowedEmails = craft()->plugins->getPlugin('EmailWhitelist')->getSettings()->allowedEmails;
				$errorMessage = craft()->plugins->getPlugin('EmailWhitelist')->getSettings()->errorMessage;

				foreach ($allowedEmails as $e) {
						if ($domain === $e[0]) {
								$event->performAction = true;
								return true;
						}
				}

				craft()->userSession->setFlash('allowedEmails', $errorMessage);
				// Cancel user save
				$event->performAction = false;
				return false;
			}
		});
	}
}